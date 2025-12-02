<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\AppointmentModel;
use App\Models\PrescriptionModel;
use App\Models\PrescriptionItemModel;
use App\Models\NurseTaskModel;
use App\Models\PrescriptionStatusLogModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class NurseController extends BaseController
{
    protected $patientModel;
    protected $appointmentModel;
    protected $prescriptionModel;
    protected $prescriptionItemModel;
    protected $nurseTaskModel;
    protected $session;
    protected $validation;

    use ResponseTrait;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = session();
        $this->validation = \Config\Services::validation();
        
        // Check if user is logged in and has nurse role
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'nurse') {
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(401)->setJSON(['error' => 'Unauthorized']);
            }
            return redirect()->to('/dashboard');
        }

        // Initialize models
        $this->patientModel = new PatientModel();
        $this->appointmentModel = new AppointmentModel();
        $this->prescriptionModel = new PrescriptionModel();
        $this->prescriptionItemModel = new PrescriptionItemModel();
        $this->nurseTaskModel = new NurseTaskModel();
    }

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $data = [
            'totalPatients' => $this->patientModel->countAllResults(),
            'totalAppointments' => $this->appointmentModel->countAllResults(),
            'todayAppointments' => $this->appointmentModel->where('date', date('Y-m-d'))->countAllResults(),
            'pendingPrescriptions' => $this->prescriptionModel->where('status', 'pending')->countAllResults()
        ];
        return view('auth/nurse/dashboard', $data);
    }

    /**
     * Update medication status
     * 
     * Handles both AJAX and regular form submissions
     * If called with GET, shows the status update form
     * If called with POST, processes the status update
     */
    /**
     * Update medication status
     * 
     * @param int|null $id Prescription ID
     * @return mixed
     */
    public function updateMedicationStatus($id = null)
    {
        try {
            // If no ID is provided in the URL, try to get it from POST data
            if ($id === null) {
                $id = $this->request->getPost('prescription_id');
                if (empty($id)) {
                    throw new \RuntimeException('No prescription ID provided');
                }
            }
            
            // Validate ID
            if (!is_numeric($id)) {
                throw new \InvalidArgumentException('Invalid prescription ID');
            }
            
            // Get prescription with validation
            $prescription = $this->prescriptionModel->find($id);
            
            if (!$prescription) {
                throw new \RuntimeException('Prescription not found');
            }
            
            // Handle form submission (POST request)
            if ($this->request->getMethod() === 'post') {
                // Validate input
                $rules = [
                    'status' => 'required|in_list[pending,administered,cancelled]',
                    'notes' => 'permit_empty|string|max_length[1000]'
                ];
                
                if (!$this->validate($rules)) {
                    throw new \RuntimeException(implode(' ', $this->validator->getErrors()));
                }
                
                $status = $this->request->getPost('status');
                $notes = $this->request->getPost('notes', FILTER_SANITIZE_STRING);
                $userId = $this->session->get('user_id');
                $currentTime = date('Y-m-d H:i:s');
                
                // Start transaction
                $db = \Config\Database::connect();
                $db->transStart();
                
                try {
                    // Update prescription status in database
                    $updated = $this->prescriptionModel->update($id, [
                        'status' => $status,
                        'administered_by' => $userId,
                        'administered_at' => $currentTime,
                        'notes' => $notes,
                        'updated_at' => $currentTime
                    ]);
                    
                    if (!$updated) {
                        throw new \RuntimeException('Failed to update prescription status');
                    }
                    
                    // Log the status change
                    if (class_exists('\App\Models\PrescriptionStatusLogModel')) {
                        $logData = [
                            'prescription_id' => $id,
                            'status' => $status,
                            'notes' => $notes,
                            'changed_by' => $userId,
                            'changed_at' => $currentTime
                        ];
                        
                        $statusLogModel = new \App\Models\PrescriptionStatusLogModel();
                        if (!$statusLogModel->insert($logData)) {
                            log_message('warning', 'Failed to log status change for prescription ID: ' . $id);
                        }
                    }
                    
                    $db->transCommit();
                    
                    // Prepare success response
                    $response = [
                        'success' => true,
                        'message' => 'Medication status updated successfully',
                        'data' => [
                            'status' => $status,
                            'administered_at' => $currentTime,
                            'administered_by' => $this->session->get('name') ?? 'Nurse',
                            'notes' => $notes
                        ]
                    ];
                    
                } catch (\Exception $e) {
                    $db->transRollback();
                    throw $e;
                }
                
                // Handle AJAX response
                if ($this->request->isAJAX()) {
                    return $this->respond($response);
                }
                
                // Handle regular form submission
                $this->session->setFlashdata('success', $response['message']);
                return redirect()->back();
            }
            
            // If it's a GET request, show the status update form
            $data['prescription'] = $prescription;
            $data['title'] = 'Update Medication Status';
            
            return view('auth/nurse/update_medication_status', $data);
            
        } catch (\Exception $e) {
            log_message('error', 'Error in updateMedicationStatus: ' . $e->getMessage());
            
            $errorMessage = 'An error occurred while updating medication status';
            
            if ($this->request->isAJAX()) {
                return $this->fail($errorMessage . ': ' . $e->getMessage());
            }
            
            $this->session->setFlashdata('error', $errorMessage);
            return redirect()->back()->withInput();
        }
    }

    // ==================== PATIENT MANAGEMENT ====================

    public function patients()
    {
        $perPage = 10;
        $page = $this->request->getVar('page') ?? 1;
        
        $data = [
            'patients' => $this->patientModel->orderBy('name', 'ASC')->paginate($perPage),
            'pager' => $this->patientModel->pager,
            'currentPage' => $page,
            'perPage' => $perPage,
            'total' => $this->patientModel->countAllResults()
        ];
        
        return view('auth/nurse/patients', $data);
    }
    
    public function createPatient()
    {
        return view('auth/nurse/patient_form');
    }
    
    public function storePatient()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'age' => $this->request->getPost('age'),
            'gender' => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'contact' => $this->request->getPost('contact'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->patientModel->save($data)) {
            $this->session->setFlashdata('success', 'Patient added successfully!');
            return redirect()->to('/nurse/patients');
        } else {
            $this->session->setFlashdata('errors', $this->patientModel->errors());
            return redirect()->back()->withInput();
        }
    }
    
    public function editPatient($id)
    {
        $data['patient'] = $this->patientModel->find($id);
        if (!$data['patient']) {
            $this->session->setFlashdata('error', 'Patient not found');
            return redirect()->to('/nurse/patients');
        }
        return view('auth/nurse/patient_form', $data);
    }
    
    public function updatePatient($id)
    {
        $data = [
            'id' => $id,
            'name' => $this->request->getPost('name'),
            'age' => $this->request->getPost('age'),
            'gender' => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'contact' => $this->request->getPost('contact'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->patientModel->save($data)) {
            $this->session->setFlashdata('success', 'Patient updated successfully!');
            return redirect()->to('/nurse/patients');
        } else {
            $this->session->setFlashdata('errors', $this->patientModel->errors());
            return redirect()->back()->withInput();
        }
    }

    public function viewPatient($id)
    {
        $data['patient'] = $this->patientModel->find($id);
        $data['appointments'] = $this->appointmentModel->where('patient_id', $id)->findAll();

        if (!$data['patient']) {
            $this->session->setFlashdata('error', 'Patient not found');
            return redirect()->to('/nurse/patients');
        }

        return view('auth/nurse/patient_view', $data);
    }

    public function searchPatients()
    {
        $keyword = $this->request->getGet('keyword');
        $data['patients'] = $this->patientModel->searchPatients($keyword);
        $data['keyword'] = $keyword;
        return view('auth/nurse/patients', $data);
    }

    // ==================== APPOINTMENT MANAGEMENT ====================

    public function appointments()
    {
        $perPage = 10;
        $page = $this->request->getVar('page') ?? 1;
        
        $data = [
            'appointments' => $this->appointmentModel
                ->select('appointments.*, patients.name as patient_name')
                ->join('patients', 'patients.id = appointments.patient_id')
                ->orderBy('appointments.date', 'DESC')
                ->orderBy('appointments.time', 'DESC')
                ->paginate($perPage),
            'pager' => $this->appointmentModel->pager,
            'currentPage' => $page,
            'perPage' => $perPage,
            'total' => $this->appointmentModel->countAllResults()
        ];
        
        return view('auth/nurse/appointments', $data);
    }
    
    public function createAppointment()
    {
        $data['patients'] = $this->patientModel->findAll();
        return view('auth/nurse/appointment_form', $data);
    }
    
    public function storeAppointment()
    {
        $data = [
            'patient_id' => $this->request->getPost('patient_id'),
            'date' => $this->request->getPost('date'),
            'time' => $this->request->getPost('time'),
            'reason' => $this->request->getPost('reason'),
            'status' => 'Scheduled',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->appointmentModel->save($data)) {
            $this->session->setFlashdata('success', 'Appointment scheduled successfully!');
            return redirect()->to('/nurse/appointments');
        } else {
            $this->session->setFlashdata('errors', $this->appointmentModel->errors());
            return redirect()->back()->withInput();
        }
    }
    
    public function editAppointment($id)
    {
        $data['appointment'] = $this->appointmentModel->find($id);
        $data['patients'] = $this->patientModel->findAll();
        
        if (!$data['appointment']) {
            $this->session->setFlashdata('error', 'Appointment not found');
            return redirect()->to('/nurse/appointments');
        }
        
        return view('auth/nurse/appointment_form', $data);
    }
    
    public function updateAppointment($id)
    {
        $data = [
            'id' => $id,
            'patient_id' => $this->request->getPost('patient_id'),
            'date' => $this->request->getPost('date'),
            'time' => $this->request->getPost('time'),
            'reason' => $this->request->getPost('reason'),
            'status' => $this->request->getPost('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->appointmentModel->save($data)) {
            $this->session->setFlashdata('success', 'Appointment updated successfully!');
            return redirect()->to('/nurse/appointments');
        } else {
            $this->session->setFlashdata('errors', $this->appointmentModel->errors());
            return redirect()->back()->withInput();
        }
    }

    public function viewAppointment($id)
    {
        $data['appointment'] = $this->appointmentModel->getAppointment($id);

        if (!$data['appointment']) {
            $this->session->setFlashdata('error', 'Appointment not found');
            return redirect()->to('/nurse/appointments');
        }

        return view('auth/nurse/appointment_view', $data);
    }

    public function updateAppointmentStatus($id)
    {
        $status = $this->request->getPost('status');

        if ($this->appointmentModel->updateStatus($id, $status)) {
            $this->session->setFlashdata('success', 'Appointment status updated successfully!');
        } else {
            $this->session->setFlashdata('error', 'Failed to update appointment status');
        }

        return redirect()->to('/nurse/appointments');
    }

    public function searchAppointments()
    {
        $keyword = $this->request->getGet('keyword');
        $data['appointments'] = $this->appointmentModel->searchAppointments($keyword);
        $data['keyword'] = $keyword;
        return view('auth/nurse/appointments', $data);
    }

    /**
     * Show form to update patient vitals
     */
    public function updateVitals($id)
    {
        $data['patient'] = $this->patientModel->find($id);
        
        if (!$data['patient']) {
            $this->session->setFlashdata('error', 'Patient not found');
            return redirect()->to('/nurse/patients');
        }
        
        return view('auth/nurse/update_vitals', $data);
    }

    /**
     * Process vitals update
     */
    /**
     * Save patient vitals
     * 
     * @param int $id Patient ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function saveVitals($id)
    {
        try {
            // Validate ID
            if (!is_numeric($id)) {
                throw new \InvalidArgumentException('Invalid patient ID');
            }
            
            // Get patient with validation
            $patient = $this->patientModel->find($id);
            if (!$patient) {
                throw new \RuntimeException('Patient not found');
            }
            
            // Define validation rules
            $rules = [
                'blood_pressure' => 'permit_empty|string|max_length[20]',
                'temperature' => 'permit_empty|numeric',
                'pulse' => 'permit_empty|integer|greater_than[0]',
                'respiratory_rate' => 'permit_empty|integer|greater_than[0]',
                'oxygen_level' => 'permit_empty|numeric|greater_than[0]|less_than_equal_to[100]',
                'weight' => 'permit_empty|numeric|greater_than[0]',
                'height' => 'permit_empty|numeric|greater_than[0]',
                'notes' => 'permit_empty|string|max_length[1000]'
            ];
            
            if (!$this->validate($rules)) {
                throw new \RuntimeException(implode(' ', $this->validator->getErrors()));
            }
            
            // Prepare data with sanitization
            $data = [
                'id' => $id,
                'blood_pressure' => $this->request->getPost('blood_pressure', FILTER_SANITIZE_STRING),
                'temperature' => $this->request->getPost('temperature', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'pulse' => $this->request->getPost('pulse', FILTER_SANITIZE_NUMBER_INT),
                'respiratory_rate' => $this->request->getPost('respiratory_rate', FILTER_SANITIZE_NUMBER_INT),
                'oxygen_level' => $this->request->getPost('oxygen_level', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'weight' => $this->request->getPost('weight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'height' => $this->request->getPost('height', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'notes' => $this->request->getPost('notes', FILTER_SANITIZE_STRING),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            // Save data
            if (!$this->patientModel->save($data)) {
                throw new \RuntimeException('Failed to save patient vitals');
            }
            
            // Log the vitals update
            log_message('info', "Vitals updated for patient ID: {$id} by user ID: " . $this->session->get('user_id'));
            
            $this->session->setFlashdata('success', 'Vitals updated successfully!');
            
        } catch (\Exception $e) {
            log_message('error', 'Error in saveVitals: ' . $e->getMessage());
            $this->session->setFlashdata('error', 'Failed to save vitals: ' . $e->getMessage());
        }
        
        return redirect()->to('/nurse/patients/view/' . $id);
    }

    /**
     * Mark patient task as complete
     */
    public function completeTask($id = null)
    {
        // Check if this is an AJAX request
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request']);
        }

        // Verify CSRF token
        if (!$this->request->getHeader('X-CSRF-TOKEN') || 
            !hash_equals($this->request->getHeader('X-CSRF-TOKEN')->getValue(), csrf_hash())) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid CSRF token']);
        }

        $patient = $this->patientModel->find($id);
        if (!$patient) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Patient not found']);
        }

        try {
            // First, check if we have a NurseTaskModel
            if (class_exists('\App\Models\NurseTaskModel')) {
                $taskModel = new \App\Models\NurseTaskModel();
                $updated = $taskModel->where('patient_id', $id)
                                  ->where('status', 'pending')
                                  ->set(['status' => 'completed', 'completed_at' => date('Y-m-d H:i:s')])
                                  ->update();
            } else {
                // Fallback to updating a tasks table directly if NurseTaskModel doesn't exist
                $db = \Config\Database::connect();
                $updated = $db->table('nurse_tasks')
                            ->where('patient_id', $id)
                            ->where('status', 'pending')
                            ->set([
                                'status' => 'completed', 
                                'completed_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ])
                            ->update();
            }

            if ($updated) {
                return $this->response->setJSON([
                    'status' => 'success', 
                    'message' => 'Task marked as complete',
                    'patient_id' => $id
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error', 
                    'message' => 'No pending tasks found for this patient or already completed',
                    'patient_id' => $id
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error completing task: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error', 
                'message' => 'An error occurred while updating the task: ' . $e->getMessage()
            ]);
        }
    }

    // ==================== MEDICATION MANAGEMENT ====================

    public function medications()
    {
        $prescriptions = $this->prescriptionModel
            ->select('prescriptions.*, patients.name as patient_name, patients.age')
            ->join('patients', 'patients.id = prescriptions.patient_id')
            ->orderBy('prescriptions.prescription_date', 'DESC')
            ->findAll();
        
        $data['prescriptions'] = $prescriptions;
        return view('auth/nurse/medications', $data);
    }

    public function viewMedication($id)
    {
        $prescription = $this->getPrescriptionWithDetails($id);
        
        if (!$prescription) {
            $this->session->setFlashdata('error', 'Prescription not found');
            return redirect()->to('/nurse/medications');
        }

        $data['prescription'] = $prescription;
        $data['items'] = $this->getPrescriptionItems($id);
        
        return view('auth/nurse/medication_view', $data);
    }
    
    /**
     * Search medications by patient name, prescription ID, or status
     */
    public function searchMedications()
    {
        $search = $this->request->getGet('search');
        $status = $this->request->getGet('status');
        
        $builder = $this->prescriptionModel
            ->select('prescriptions.*, patients.name as patient_name, patients.age')
            ->join('patients', 'patients.id = prescriptions.patient_id')
            ->orderBy('prescriptions.prescription_date', 'DESC');
        
        if (!empty($search)) {
            $builder->groupStart()
                ->like('patients.name', $search)
                ->orLike('prescriptions.id', $search)
                ->orLike('prescriptions.prescription_number', $search)
                ->groupEnd();
        }
        
        if (!empty($status) && $status !== 'all') {
            $builder->where('prescriptions.status', $status);
        }
        
        $data['prescriptions'] = $builder->findAll();
        $data['search'] = $search;
        $data['status'] = $status;
        
        return view('auth/nurse/medications', $data);
    }
    
    /**
     * Show form to administer medication
     */
    public function administerMedication($id)
    {
        $prescription = $this->getPrescriptionWithDetails($id);
            
        if (!$prescription) {
            $this->session->setFlashdata('error', 'Prescription not found');
            return redirect()->to('/nurse/medications');
        }
        
        $data['prescription'] = $prescription;
        $data['items'] = $this->getPrescriptionItems($id);
        
        return view('auth/nurse/administer_medication', $data);
    }
    
    /**
     * Process medication administration
     */
    public function processAdministerMedication($id)
    {
        $prescription = $this->prescriptionModel->find($id);
        
        if (!$prescription) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Prescription not found'
                ]);
            }
            $this->session->setFlashdata('error', 'Prescription not found');
            return redirect()->back();
        }
        
        // Update prescription status to 'administered'
        $updated = $this->prescriptionModel->update($id, [
            'status' => 'administered',
            'administered_by' => $this->session->get('user_id'),
            'administered_at' => date('Y-m-d H:i:s'),
            'notes' => $this->request->getPost('notes'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        if ($updated) {
            $this->session->setFlashdata('success', 'Medication administered successfully');
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Medication administered successfully',
                    'redirect' => site_url('nurse/medications/view/' . $id)
                ]);
            }
            
            return redirect()->to('nurse/medications/view/' . $id);
        }
        
        $this->session->setFlashdata('error', 'Failed to update medication status');
        return redirect()->back()->withInput();
    }
    
    /**
     * Print prescription
     */
    public function printPrescription($id)
    {
        $prescription = $this->getPrescriptionWithDetails($id);
        
        if (!$prescription) {
            $this->session->setFlashdata('error', 'Prescription not found');
            return redirect()->to('/nurse/medications');
        }
        
        $data['prescription'] = $prescription;
        $data['items'] = $this->getPrescriptionItems($id);
        
        // Return the view for printing
        return view('auth/nurse/print_prescription', $data);
    }
    
    /**
     * Download prescription as PDF
     */
    public function downloadPrescription($id)
    {
        $prescription = $this->getPrescriptionWithDetails($id);
        
        if (!$prescription) {
            $this->session->setFlashdata('error', 'Prescription not found');
            return redirect()->to('/nurse/medications');
        }
        
        $data['prescription'] = $prescription;
        $data['items'] = $this->getPrescriptionItems($id);
        
        // Load the dompdf library
        $dompdf = new \Dompdf\Dompdf();
        $html = view('auth/nurse/print_prescription', $data);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Output the generated PDF (force download)
        return $this->response->download(
            'prescription-' . $id . '.pdf',
            $dompdf->output(),
            true
        );
    }
    
    /**
     * Helper method to get prescription with patient and doctor details
     */
    /**
     * Get prescription details with patient and doctor information
     * 
     * @param int $id Prescription ID
     * @return array|null Prescription data or null if not found
     */
    private function getPrescriptionWithDetails($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            return null;
        }
        
        try {
            return $this->prescriptionModel
                ->select('prescriptions.*, patients.name as patient_name, patients.age, patients.gender, users.name as doctor_name')
                ->join('patients', 'patients.id = prescriptions.patient_id')
                ->join('users', 'users.id = prescriptions.doctor_id', 'left')
                ->where('prescriptions.id', $id)
                ->first();
        } catch (\Exception $e) {
            log_message('error', 'Error fetching prescription details: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Helper method to get prescription items with medicine details
     */
    /**
     * Get prescription items with medicine details
     * 
     * @param int $prescriptionId Prescription ID
     * @return array Array of prescription items
     */
    private function getPrescriptionItems($prescriptionId)
    {
        if (!is_numeric($prescriptionId) || $prescriptionId <= 0) {
            return [];
        }
        
        try {
            return $this->prescriptionItemModel
                ->select('prescription_items.*, medicines.name as medicine_name, medicines.strength')
                ->join('medicines', 'medicines.id = prescription_items.medicine_id')
                ->where('prescription_items.prescription_id', $prescriptionId)
                ->findAll();
        } catch (\Exception $e) {
            log_message('error', 'Error fetching prescription items: ' . $e->getMessage());
            return [];
        }
    }

}
