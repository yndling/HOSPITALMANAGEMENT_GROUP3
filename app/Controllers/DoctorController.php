<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\AppointmentModel;
use App\Models\PrescriptionModel;
use App\Models\PrescriptionItemModel;
use App\Models\MedicineModel;

class DoctorController extends BaseController
{
    protected $patientModel;
    protected $appointmentModel;
    protected $prescriptionModel;
    protected $prescriptionItemModel;
    protected $medicineModel;
    protected $session;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = session();
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'doctor') {
            return redirect()->to('/dashboard');
        }

        $this->patientModel = new PatientModel();
        $this->appointmentModel = new AppointmentModel();
        $this->prescriptionModel = new PrescriptionModel();
        $this->prescriptionItemModel = new PrescriptionItemModel();
        $this->medicineModel = new MedicineModel();
    }

    public function index()
    {
        return redirect()->to('/doctor/patients');
    }

    public function dashboard()
    {
        $userId = $this->session->get('id');

        // Get doctor's name to use for filtering appointments
        $doctorName = $this->session->get('name');

        // Get staff ID for prescriptions (prescriptions table uses doctor_id foreign key to staff.id)
        $staffModel = new \App\Models\StaffModel();
        $staff = $staffModel->where('email', $this->session->get('email'))->first();
        $doctorStaffId = $staff ? $staff['id'] : null;

        // Get total unique patients for the doctor by checking appointments
        $totalPatients = $this->appointmentModel
            ->select('COUNT(DISTINCT patient_id) as total_patients')
            ->where('doctor', $doctorName)
            ->get()
            ->getRow()
            ->total_patients ?? 0;

        // Get upcoming appointments (today and future)
        $upcomingAppointments = $this->appointmentModel
            ->where('doctor', $doctorName)
            ->where('date >=', date('Y-m-d'))
            ->where('status', 'scheduled')
            ->countAllResults();

        // Get pending prescriptions
        $pendingPrescriptions = $doctorStaffId ? $this->prescriptionModel
            ->where('doctor_id', $doctorStaffId)
            ->where('status', 'pending')
            ->countAllResults() : 0;

        // Get today's appointments
        $todayAppointments = $this->appointmentModel
            ->where('doctor', $doctorName)
            ->where('date', date('Y-m-d'))
            ->whereIn('status', ['scheduled', 'in-progress'])
            ->orderBy('time', 'ASC')
            ->findAll();
        
        $data = [
            'totalPatients' => $totalPatients,
            'upcomingAppointments' => $upcomingAppointments,
            'pendingPrescriptions' => $pendingPrescriptions,
            'todayAppointments' => $todayAppointments,
            'title' => 'Doctor Dashboard'
        ];
        
        return view('auth/dashboard', $data);
    }

    // ==================== PATIENT MANAGEMENT ====================

    /**
     * Display patients list
     */
    public function patients()
    {
        $data['patients'] = $this->patientModel->getPatients();
        $data['total'] = $this->patientModel->getTotalPatients();
        return view('auth/doctor/patients', $data);
    }

    /**
     * Show create patient form
     */
    public function createPatient()
    {
        return view('auth/doctor/patient_form', ['patient' => null]);
    }

    /**
     * Store new patient
     */
    public function storePatient()
    {
        $data = [
            'patient_id'                => $this->request->getPost('patient_id'),
            'first_name'                => $this->request->getPost('first_name'),
            'middle_name'               => $this->request->getPost('middle_name'),
            'last_name'                 => $this->request->getPost('last_name'),
            'date_of_birth'             => $this->request->getPost('date_of_birth'),
            'age'                       => $this->request->getPost('age'),
            'gender'                    => $this->request->getPost('gender'),
            'blood_type'                => $this->request->getPost('blood_type'),
            'civil_status'              => $this->request->getPost('civil_status'),
            'nationality'               => $this->request->getPost('nationality'),
            'contact_number'            => $this->request->getPost('contact_number'),
            'email_address'             => $this->request->getPost('email_address'),
            'home_address'              => $this->request->getPost('home_address'),
            'emergency_contact_name'    => $this->request->getPost('emergency_contact_name'),
            'emergency_relationship'    => $this->request->getPost('emergency_relationship'),
            'emergency_contact_number'  => $this->request->getPost('emergency_contact_number'),
            'emergency_address'         => $this->request->getPost('emergency_address'),
            'medical_history'           => $this->request->getPost('medical_history'),
            'current_medications'       => $this->request->getPost('current_medications'),
            'allergies'                 => $this->request->getPost('allergies'),
            'past_surgeries'            => $this->request->getPost('past_surgeries'),
            'chronic_conditions'        => $this->request->getPost('chronic_conditions'),
            'family_medical_history'    => $this->request->getPost('family_medical_history')
        ];

        if ($this->patientModel->createPatient($data)) {
            $this->session->setFlashdata('success', 'Patient registered successfully!');
            return redirect()->to('/doctor/patients');
        } else {
            $this->session->setFlashdata('errors', $this->patientModel->errors());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show edit patient form
     */
    public function editPatient($id)
    {
        $data['patient'] = $this->patientModel->getPatient($id);

        if (!$data['patient']) {
            $this->session->setFlashdata('error', 'Patient not found');
            return redirect()->to('/doctor/patients');
        }

        return view('auth/doctor/patient_form', $data);
    }

    /**
     * Update patient
     */
    public function updatePatient($id)
    {
        $data = [
            'id'                        => $id,
            'patient_id'                => $this->request->getPost('patient_id'),
            'first_name'                => $this->request->getPost('first_name'),
            'middle_name'               => $this->request->getPost('middle_name'),
            'last_name'                 => $this->request->getPost('last_name'),
            'date_of_birth'             => $this->request->getPost('date_of_birth'),
            'age'                       => $this->request->getPost('age'),
            'gender'                    => $this->request->getPost('gender'),
            'blood_type'                => $this->request->getPost('blood_type'),
            'civil_status'              => $this->request->getPost('civil_status'),
            'nationality'               => $this->request->getPost('nationality'),
            'contact_number'            => $this->request->getPost('contact_number'),
            'email_address'             => $this->request->getPost('email_address'),
            'home_address'              => $this->request->getPost('home_address'),
            'emergency_contact_name'    => $this->request->getPost('emergency_contact_name'),
            'emergency_relationship'    => $this->request->getPost('emergency_relationship'),
            'emergency_contact_number'  => $this->request->getPost('emergency_contact_number'),
            'emergency_address'         => $this->request->getPost('emergency_address'),
            'medical_history'           => $this->request->getPost('medical_history'),
            'current_medications'       => $this->request->getPost('current_medications'),
            'allergies'                 => $this->request->getPost('allergies'),
            'past_surgeries'            => $this->request->getPost('past_surgeries'),
            'chronic_conditions'        => $this->request->getPost('chronic_conditions'),
            'family_medical_history'    => $this->request->getPost('family_medical_history')
        ];

        if ($this->patientModel->updatePatient($id, $data)) {
            $this->session->setFlashdata('success', 'Patient updated successfully!');
            return redirect()->to('/doctor/patients');
        } else {
            $this->session->setFlashdata('errors', $this->patientModel->errors());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete patient
     */
    public function deletePatient($id)
    {
        if ($this->patientModel->deletePatient($id)) {
            $this->session->setFlashdata('success', 'Patient deleted successfully!');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete patient');
        }

        return redirect()->to('/doctor/patients');
    }

    /**
     * View patient details
     */
    public function viewPatient($id)
    {
        $data['patient'] = $this->patientModel->getPatient($id);
        $data['appointments'] = $this->appointmentModel->getAppointmentsByPatient($id);

        if (!$data['patient']) {
            $this->session->setFlashdata('error', 'Patient not found');
            return redirect()->to('/doctor/patients');
        }

        return view('auth/doctor/patient_view', $data);
    }

    /**
     * Search patients
     */
    public function searchPatients()
    {
        $keyword = $this->request->getGet('keyword');
        $data['patients'] = $this->patientModel->searchPatients($keyword);
        $data['keyword'] = $keyword;
        return view('auth/doctor/patients', $data);
    }

    // ==================== APPOINTMENT MANAGEMENT ====================

    /**
     * Display appointments list
     */
    public function appointments()
    {
        $data['appointments'] = $this->appointmentModel->getAppointments();
        $data['total'] = $this->appointmentModel->getTotalAppointments();
        return view('auth/doctor/appointments', $data);
    }

    /**
     * Show create appointment form
     */
    public function createAppointment()
    {
        $data['patients'] = $this->patientModel->getPatients(1000); // Get all patients for dropdown
        $data['appointment'] = null;
        return view('auth/doctor/appointment_form', $data);
    }

    /**
     * Store new appointment
     */
    public function storeAppointment()
    {
        $data = [
            'patient_id' => $this->request->getPost('patient_id'),
            'doctor'     => $this->request->getPost('doctor'),
            'date'       => $this->request->getPost('date'),
            'time'       => $this->request->getPost('time'),
            'status'     => $this->request->getPost('status') ?: 'Pending'
        ];

        // Debug: Log the data being inserted
        log_message('debug', 'Appointment data: ' . json_encode($data));

        // Ensure status is not empty
        if (empty($data['status'])) {
            $data['status'] = 'Pending';
        }

        if ($this->appointmentModel->createAppointment($data)) {
            $this->session->setFlashdata('success', 'Appointment scheduled successfully!');
            return redirect()->to('/doctor/appointments');
        } else {
            $this->session->setFlashdata('errors', $this->appointmentModel->errors());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show edit appointment form
     */
    public function editAppointment($id)
    {
        $data['appointment'] = $this->appointmentModel->getAppointment($id);
        $data['patients'] = $this->patientModel->getPatients(1000);

        if (!$data['appointment']) {
            $this->session->setFlashdata('error', 'Appointment not found');
            return redirect()->to('/doctor/appointments');
        }

        return view('auth/doctor/appointment_form', $data);
    }

    /**
     * Update appointment
     */
    public function updateAppointment($id)
    {
        $data = [
            'patient_id' => $this->request->getPost('patient_id'),
            'doctor'     => $this->request->getPost('doctor'),
            'date'       => $this->request->getPost('date'),
            'time'       => $this->request->getPost('time'),
            'status'     => $this->request->getPost('status')
        ];

        if ($this->appointmentModel->updateAppointment($id, $data)) {
            $this->session->setFlashdata('success', 'Appointment updated successfully!');
            return redirect()->to('/doctor/appointments');
        } else {
            $this->session->setFlashdata('errors', $this->appointmentModel->errors());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete/Cancel appointment
     */
    public function deleteAppointment($id)
    {
        if ($this->appointmentModel->deleteAppointment($id)) {
            $this->session->setFlashdata('success', 'Appointment cancelled successfully!');
        } else {
            $this->session->setFlashdata('error', 'Failed to cancel appointment');
        }

        return redirect()->to('/doctor/appointments');
    }

    /**
     * Update appointment status
     */
    public function updateAppointmentStatus($id)
    {
        $status = $this->request->getPost('status');

        if ($this->appointmentModel->updateStatus($id, $status)) {
            $this->session->setFlashdata('success', 'Appointment status updated successfully!');
        } else {
            $this->session->setFlashdata('error', 'Failed to update appointment status');
        }

        return redirect()->to('/doctor/appointments');
    }

    /**
     * View appointment details
     */
    public function viewAppointment($id)
    {
        $data['appointment'] = $this->appointmentModel->getAppointment($id);

        if (!$data['appointment']) {
            $this->session->setFlashdata('error', 'Appointment not found');
            return redirect()->to('/doctor/appointments');
        }

        return view('auth/doctor/appointment_view', $data);
    }

    /**
     * Search appointments
     */
    public function searchAppointments()
    {
        $keyword = $this->request->getGet('keyword');
        $data['appointments'] = $this->appointmentModel->searchAppointments($keyword);
        $data['keyword'] = $keyword;
        return view('auth/doctor/appointments', $data);
    }

    public function prescriptions()
    {
        // Get the logged-in user's ID from the session
        $userId = session()->get('id');
        
        if (!$userId) {
            $data['prescriptions'] = [];
            return view('auth/doctor/prescriptions', $data);
        }
        
        // Get prescriptions for the current doctor
        $prescriptions = $this->prescriptionModel
            ->select('prescriptions.*, patients.name as patient_name')
            ->join('patients', 'patients.id = prescriptions.patient_id')
            ->where('prescriptions.doctor_id', $userId)
            ->orderBy('prescriptions.prescription_date', 'DESC')
            ->findAll();
        
        // Debug: Log the number of prescriptions found
        log_message('debug', 'Found ' . count($prescriptions) . ' prescriptions for doctor ID: ' . $userId);
        
        $data['prescriptions'] = $prescriptions;
        return view('auth/doctor/prescriptions', $data);
    }

    public function createPrescription()
    {
        $data['patients'] = $this->patientModel->getPatients(1000);
        $data['appointments'] = $this->appointmentModel->getAppointments();
        $data['medicines'] = $this->medicineModel->where('status', 'active')->findAll();
        return view('auth/doctor/prescription_form', $data);
    }

    public function storePrescription()
    {
        // Get the staff_id for this user
        $staffModel = new \App\Models\StaffModel();
        $email = session()->get('email');
        log_message('info', 'Doctor email: ' . $email);
        
        $staff = $staffModel->where('email', $email)->first();
        
        if (!$staff) {
            log_message('error', 'Staff not found for email: ' . $email);
            $this->session->setFlashdata('error', 'Doctor profile not found. Please ensure your staff record exists in the database.');
            return redirect()->back()->withInput();
        }
        
        log_message('info', 'Found staff ID: ' . $staff['id']);
        
        $data = [
            'patient_id' => $this->request->getPost('patient_id'),
            'doctor_id' => $staff['id'],
            'appointment_id' => $this->request->getPost('appointment_id') ?: null,
            'prescription_date' => date('Y-m-d H:i:s'),
            'diagnosis' => $this->request->getPost('diagnosis'),
            'notes' => $this->request->getPost('notes'),
            'status' => 'pending'
        ];

        log_message('info', 'Prescription data: ' . json_encode($data));
        
        if ($prescriptionId = $this->prescriptionModel->insert($data)) {
            log_message('info', 'Prescription created with ID: ' . $prescriptionId);
            // Add prescription items
            $medicines = $this->request->getPost('medicine_id');
            $quantities = $this->request->getPost('quantity');
            $dosages = $this->request->getPost('dosage');
            $frequencies = $this->request->getPost('frequency');
            $durations = $this->request->getPost('duration');
            $instructions = $this->request->getPost('instructions');

            if ($medicines) {
                foreach ($medicines as $key => $medicineId) {
                    $medicine = $this->medicineModel->find($medicineId);
                    $quantity = $quantities[$key];
                    $unitPrice = $medicine['selling_price'];
                    $totalPrice = $unitPrice * $quantity;

                    $itemData = [
                        'prescription_id' => $prescriptionId,
                        'medicine_id' => $medicineId,
                        'quantity' => $quantity,
                        'dosage' => $dosages[$key],
                        'frequency' => $frequencies[$key],
                        'duration' => $durations[$key],
                        'instructions' => $instructions[$key] ?? '',
                        'unit_price' => $unitPrice,
                        'total_price' => $totalPrice,
                        'status' => 'pending'
                    ];

                    $this->prescriptionItemModel->insert($itemData);
                }
            }

            $this->session->setFlashdata('success', 'Prescription created successfully!');
            return redirect()->to('/doctor/prescriptions');
        } else {
            log_message('error', 'Failed to create prescription. Errors: ' . json_encode($this->prescriptionModel->errors()));
            log_message('error', 'Model errors: ' . print_r($this->prescriptionModel->errors(), true));
            $errors = $this->prescriptionModel->errors();
            $errorMessage = is_array($errors) ? implode(', ', $errors) : 'Unknown error occurred';
            $this->session->setFlashdata('error', 'Failed to create prescription: ' . $errorMessage);
            return redirect()->back()->withInput();
        }
    }

    public function viewPrescription($id)
    {
        $prescription = $this->prescriptionModel
            ->select('prescriptions.*, patients.name as patient_name, patients.age, patients.gender')
            ->join('patients', 'patients.id = prescriptions.patient_id')
            ->find($id);

        if (!$prescription) {
            $this->session->setFlashdata('error', 'Prescription not found');
            return redirect()->to('/doctor/prescriptions');
        }

        $items = $this->prescriptionItemModel
            ->select('prescription_items.*, medicines.name as medicine_name')
            ->join('medicines', 'medicines.id = prescription_items.medicine_id')
            ->where('prescription_items.prescription_id', $id)
            ->findAll();

        $data['prescription'] = $prescription;
        $data['items'] = $items;
        
        return view('auth/doctor/prescription_view', $data);
    }

    public function editPrescription($id)
    {
        // Get staff_id for this doctor
        $staffModel = new \App\Models\StaffModel();
        $staff = $staffModel->where('email', session()->get('email'))->first();
        
        if (!$staff) {
            $this->session->setFlashdata('error', 'Doctor profile not found. Please contact administrator.');
            return redirect()->to('/doctor/prescriptions');
        }
        
        $prescription = $this->prescriptionModel->find($id);
        
        if (!$prescription || $prescription['doctor_id'] != $staff['id']) {
            $this->session->setFlashdata('error', 'Prescription not found or access denied');
            return redirect()->to('/doctor/prescriptions');
        }

        $items = $this->prescriptionItemModel
            ->select('prescription_items.*, medicines.name as medicine_name')
            ->join('medicines', 'medicines.id = prescription_items.medicine_id')
            ->where('prescription_items.prescription_id', $id)
            ->findAll();

        $data['prescription'] = $prescription;
        $data['items'] = $items;
        $data['patients'] = $this->patientModel->getPatients(1000);
        $data['appointments'] = $this->appointmentModel->getAppointments();
        $data['medicines'] = $this->medicineModel->where('status', 'active')->findAll();
        
        return view('auth/doctor/prescription_form', $data);
    }

    public function updatePrescription($id)
    {
        // Get staff_id for this doctor
        $staffModel = new \App\Models\StaffModel();
        $staff = $staffModel->where('email', session()->get('email'))->first();
        
        if (!$staff) {
            $this->session->setFlashdata('error', 'Doctor profile not found. Please contact administrator.');
            return redirect()->to('/doctor/prescriptions');
        }
        
        $prescription = $this->prescriptionModel->find($id);
        
        if (!$prescription || $prescription['doctor_id'] != $staff['id']) {
            $this->session->setFlashdata('error', 'Prescription not found or access denied');
            return redirect()->to('/doctor/prescriptions');
        }

        $data = [
            'patient_id' => $this->request->getPost('patient_id'),
            'appointment_id' => $this->request->getPost('appointment_id') ?: null,
            'diagnosis' => $this->request->getPost('diagnosis'),
            'notes' => $this->request->getPost('notes')
        ];

        if ($this->prescriptionModel->update($id, $data)) {
            // Update items if provided
            $itemIds = $this->request->getPost('item_id');
            if ($itemIds) {
                foreach ($itemIds as $key => $itemId) {
                    if ($itemId) {
                        $updateData = [
                            'quantity' => $this->request->getPost('quantity')[$key],
                            'dosage' => $this->request->getPost('dosage')[$key],
                            'frequency' => $this->request->getPost('frequency')[$key],
                            'duration' => $this->request->getPost('duration')[$key],
                            'instructions' => $this->request->getPost('instructions')[$key] ?? ''
                        ];
                        $this->prescriptionItemModel->update($itemId, $updateData);
                    }
                }
            }

            $this->session->setFlashdata('success', 'Prescription updated successfully!');
            return redirect()->to('/doctor/prescriptions');
        } else {
            $this->session->setFlashdata('errors', $this->prescriptionModel->errors());
            return redirect()->back()->withInput();
        }
    }

    public function deletePrescription($id)
    {
        // Get staff_id for this doctor
        $staffModel = new \App\Models\StaffModel();
        $staff = $staffModel->where('email', session()->get('email'))->first();
        
        if (!$staff) {
            $this->session->setFlashdata('error', 'Doctor profile not found. Please contact administrator.');
            return redirect()->to('/doctor/prescriptions');
        }
        
        $prescription = $this->prescriptionModel->find($id);
        
        if (!$prescription || $prescription['doctor_id'] != $staff['id']) {
            $this->session->setFlashdata('error', 'Prescription not found or access denied');
            return redirect()->to('/doctor/prescriptions');
        }

        // Delete prescription items first
        $this->prescriptionItemModel->where('prescription_id', $id)->delete();
        // Delete prescription
        $this->prescriptionModel->delete($id);
        
        $this->session->setFlashdata('success', 'Prescription deleted successfully!');
        return redirect()->to('/doctor/prescriptions');
    }

    public function lab()
    {
        $userRole = session()->get('role');
        $labRequestModel = new \App\Models\LabRequestModel();

        if ($userRole === 'lab_technician' || $userRole === 'laboratory_staff') {
            // Lab staff see all requests
            $labSupplyModel = new \App\Models\LabSupplyModel();
            $labResultModel = new \App\Models\LabResultModel();

            // Get all requests (simple query since lab_requests table only has patient and test as varchar)
            $data['requests'] = $labRequestModel
                ->orderBy('created_at', 'DESC')
                ->findAll();
            
            $data['supplies'] = $labSupplyModel->findAll();
            $data['results'] = $labResultModel->findAll();
        } else {
            // For doctors, show all requests (the table doesn't have doctor_id or patient_id foreign keys)
            $data['requests'] = $labRequestModel
                ->orderBy('created_at', 'DESC')
                ->findAll();
            // Add empty arrays for supplies and results since doctors don't use them
            $data['supplies'] = [];
            $data['results'] = [];
        }

        return view('auth/doctor/lab', $data);
    }

    public function createLabRequest()
    {
        $data['patients'] = $this->patientModel->getPatients(1000);
        return view('auth/doctor/lab_request_form', $data);
    }

    public function storeLabRequest()
    {
        $labRequestModel = new \App\Models\LabRequestModel();

        // Get patient name
        $patientId = $this->request->getPost('patient_id');
        $patient = $this->patientModel->find($patientId);
        $patientName = $patient ? $patient['name'] : 'Unknown Patient';

        // Get test type
        $testType = $this->request->getPost('test_type') ?: 'General Test';

        // The lab_requests table uses simple varchar fields
        $data = [
            'patient' => $patientName,
            'test' => $testType,
            'status' => 'pending'
        ];

        if ($labRequestModel->insert($data)) {
            $this->session->setFlashdata('success', 'Lab test request submitted successfully!');
            return redirect()->to('/doctor/lab');
        } else {
            $this->session->setFlashdata('error', 'Failed to submit lab test request');
            return redirect()->back()->withInput();
        }
    }
}
