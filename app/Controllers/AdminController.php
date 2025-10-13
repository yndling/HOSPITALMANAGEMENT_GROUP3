<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StaffModel;
use App\Models\BillModel;
use App\Models\InvoiceModel;
use App\Models\PaymentModel;
use App\Models\PatientModel;
use App\Models\AppointmentModel;

class AdminController extends BaseController
{
    protected $staffModel;
    protected $billModel;
    protected $invoiceModel;
    protected $paymentModel;
    protected $patientModel;
    protected $appointmentModel;
    protected $session;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = session();
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $this->staffModel = new StaffModel();
        $this->billModel = new BillModel();
        $this->invoiceModel = new InvoiceModel();
        $this->paymentModel = new PaymentModel();
        $this->patientModel = new PatientModel();
        $this->appointmentModel = new AppointmentModel();
    }

    public function index()
    {
        return redirect()->to('/admin/dashboard');
    }

    public function dashboard()
    {
        $data['totalStaff'] = $this->staffModel->getTotalStaff();
        $data['totalPatients'] = $this->patientModel->getTotalPatients();
        $data['totalBills'] = $this->billModel->getTotalBills();
        $data['pendingPayments'] = $this->billModel->getPendingPaymentsCount();
        $data['totalRevenue'] = $this->billModel->getTotalRevenue();

        return view('auth/dashboard', $data);
    }

    // ==================== STAFF MANAGEMENT ====================

    /**
     * Display staff list
     */
    public function staff()
    {
        $data['staff'] = $this->staffModel->getStaff();
        $data['total'] = $this->staffModel->getTotalStaff();
        return view('auth/admin/staff', $data);
    }

    /**
     * Show create staff form
     */
    public function createStaff()
    {
        return view('auth/admin/staff_form', ['staff' => null]);
    }

    /**
     * Store new staff
     */
    public function storeStaff()
    {
        $data = [
            'name'           => $this->request->getPost('name'),
            'email'          => $this->request->getPost('email'),
            'role'           => $this->request->getPost('role'),
            'department'     => $this->request->getPost('department'),
            'specialization' => $this->request->getPost('specialization'),
            'contact'        => $this->request->getPost('contact'),
            'address'        => $this->request->getPost('address'),
            'salary'         => $this->request->getPost('salary'),
            'status'         => $this->request->getPost('status') ?: 'active'
        ];

        if ($this->staffModel->createStaff($data)) {
            $this->session->setFlashdata('success', 'Staff member registered successfully!');
            return redirect()->to('/admin/staff');
        } else {
            $this->session->setFlashdata('errors', $this->staffModel->errors());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show edit staff form
     */
    public function editStaff($id)
    {
        $data['staff'] = $this->staffModel->getStaffById($id);

        if (!$data['staff']) {
            $this->session->setFlashdata('error', 'Staff member not found');
            return redirect()->to('/admin/staff');
        }

        return view('auth/admin/staff_form', $data);
    }

    /**
     * Update staff
     */
    public function updateStaff($id)
    {
        $data = [
            'name'           => $this->request->getPost('name'),
            'email'          => $this->request->getPost('email'),
            'role'           => $this->request->getPost('role'),
            'department'     => $this->request->getPost('department'),
            'specialization' => $this->request->getPost('specialization'),
            'contact'        => $this->request->getPost('contact'),
            'address'        => $this->request->getPost('address'),
            'salary'         => $this->request->getPost('salary'),
            'status'         => $this->request->getPost('status')
        ];

        if ($this->staffModel->updateStaff($id, $data)) {
            $this->session->setFlashdata('success', 'Staff member updated successfully!');
            return redirect()->to('/admin/staff');
        } else {
            $this->session->setFlashdata('errors', $this->staffModel->errors());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete staff
     */
    public function deleteStaff($id)
    {
        if ($this->staffModel->deleteStaff($id)) {
            $this->session->setFlashdata('success', 'Staff member deleted successfully!');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete staff member');
        }

        return redirect()->to('/admin/staff');
    }

    /**
     * Search staff
     */
    public function searchStaff()
    {
        $keyword = $this->request->getGet('keyword');
        $data['staff'] = $this->staffModel->searchStaff($keyword);
        $data['keyword'] = $keyword;
        return view('auth/admin/staff', $data);
    }

    // ==================== BILLING MANAGEMENT ====================

    /**
     * Display bills list
     */
    public function bills()
    {
        $data['bills'] = $this->billModel->getBills();
        $data['total'] = $this->billModel->getTotalBills();
        return view('auth/admin/bills', $data);
    }

    /**
     * Show create bill form
     */
    public function createBill()
    {
        $data['patients'] = $this->patientModel->getPatients(1000);
        $data['bill'] = null;
        return view('auth/admin/bill_form', $data);
    }

    /**
     * Store new bill
     */
    public function storeBill()
    {
        $data = [
            'patient_id' => $this->request->getPost('patient_id'),
            'amount'     => $this->request->getPost('amount'),
            'status'     => $this->request->getPost('status') ?: 'unpaid',
            'due_date'   => $this->request->getPost('due_date')
        ];

        if ($this->billModel->createBill($data)) {
            $this->session->setFlashdata('success', 'Bill created successfully!');
            return redirect()->to('/admin/bills');
        } else {
            $this->session->setFlashdata('errors', $this->billModel->errors());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show edit bill form
     */
    public function editBill($id)
    {
        $data['bill'] = $this->billModel->getBill($id);
        $data['patients'] = $this->patientModel->getPatients(1000);

        if (!$data['bill']) {
            $this->session->setFlashdata('error', 'Bill not found');
            return redirect()->to('/admin/bills');
        }

        return view('auth/admin/bill_form', $data);
    }

    /**
     * Update bill
     */
    public function updateBill($id)
    {
        $data = [
            'patient_id' => $this->request->getPost('patient_id'),
            'amount'     => $this->request->getPost('amount'),
            'status'     => $this->request->getPost('status'),
            'due_date'   => $this->request->getPost('due_date')
        ];

        if ($this->billModel->updateBill($id, $data)) {
            $this->session->setFlashdata('success', 'Bill updated successfully!');
            return redirect()->to('/admin/bills');
        } else {
            $this->session->setFlashdata('errors', $this->billModel->errors());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete bill
     */
    public function deleteBill($id)
    {
        if ($this->billModel->deleteBill($id)) {
            $this->session->setFlashdata('success', 'Bill deleted successfully!');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete bill');
        }

        return redirect()->to('/admin/bills');
    }

    /**
     * Create invoice for bill
     */
    public function createInvoice($bill_id)
    {
        $data['bill'] = $this->billModel->getBill($bill_id);
        if (!$data['bill']) {
            $this->session->setFlashdata('error', 'Bill not found');
            return redirect()->to('/admin/bills');
        }

        $data['payments'] = $this->paymentModel->getPaymentsByBill($bill_id);

        return view('auth/admin/invoice', $data);
    }

    /**
     * Record payment
     */
    public function recordPayment($bill_id)
    {
        $bill = $this->billModel->getBill($bill_id);
        if (!$bill) {
            $this->session->setFlashdata('error', 'Bill not found');
            return redirect()->to('/admin/bills');
        }

        $data['bill'] = $bill;
        return view('auth/admin/payment_form', $data);
    }

    /**
     * Store payment
     */
    public function storePayment()
    {
        $data = [
            'bill_id'      => $this->request->getPost('bill_id'),
            'amount_paid'  => $this->request->getPost('amount_paid'),
            'payment_date' => $this->request->getPost('payment_date'),
            'method'       => $this->request->getPost('method')
        ];

        if ($this->paymentModel->createPayment($data)) {
            // Update bill status if fully paid
            $totalPaid = $this->paymentModel->getTotalPaidForBill($data['bill_id']);
            $bill = $this->billModel->getBill($data['bill_id']);

            if ($totalPaid >= $bill['amount']) {
                $this->billModel->updateStatus($data['bill_id'], 'paid');
                // Update related invoices
                $invoices = $this->invoiceModel->getInvoicesByBill($data['bill_id']);
                foreach ($invoices as $invoice) {
                    $this->invoiceModel->updateStatus($invoice['id'], 'paid');
                }
            }

            $this->session->setFlashdata('success', 'Payment recorded successfully!');
            return redirect()->to('/admin/billing');
        } else {
            $this->session->setFlashdata('errors', $this->paymentModel->errors());
            return redirect()->back()->withInput();
        }
    }

    // ==================== PATIENT MANAGEMENT ====================

    /**
     * Display patients list
     */
    public function patients()
    {
        $data['patients'] = $this->patientModel->getPatients();
        $data['total'] = $this->patientModel->getTotalPatients();
        return view('auth/admin/patients', $data);
    }

    /**
     * Show create patient form
     */
    public function createPatient()
    {
        return view('auth/admin/patient_form', ['patient' => null]);
    }

    /**
     * Store new patient
     */
    public function storePatient()
    {
        $data = [
            'name'    => $this->request->getPost('name'),
            'age'     => $this->request->getPost('age'),
            'gender'  => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'contact' => $this->request->getPost('contact')
        ];

        if ($this->patientModel->createPatient($data)) {
            $this->session->setFlashdata('success', 'Patient registered successfully!');
            return redirect()->to('/admin/patients');
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
            return redirect()->to('/admin/patients');
        }

        return view('auth/admin/patient_form', $data);
    }

    /**
     * Update patient
     */
    public function updatePatient($id)
    {
        $data = [
            'name'    => $this->request->getPost('name'),
            'age'     => $this->request->getPost('age'),
            'gender'  => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'contact' => $this->request->getPost('contact')
        ];

        if ($this->patientModel->updatePatient($id, $data)) {
            $this->session->setFlashdata('success', 'Patient updated successfully!');
            return redirect()->to('/admin/patients');
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

        return redirect()->to('/admin/patients');
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
            return redirect()->to('/admin/patients');
        }

        return view('auth/admin/patient_view', $data);
    }

    /**
     * Search patients
     */
    public function searchPatients()
    {
        $keyword = $this->request->getGet('keyword');
        $data['patients'] = $this->patientModel->searchPatients($keyword);
        $data['keyword'] = $keyword;
        return view('auth/admin/patients', $data);
    }

    // ==================== APPOINTMENT MANAGEMENT ====================

    /**
     * Display appointments list
     */
    public function appointments()
    {
        $data['appointments'] = $this->appointmentModel->getAppointments();
        $data['total'] = $this->appointmentModel->getTotalAppointments();
        return view('auth/admin/appointments', $data);
    }

    /**
     * Show create appointment form
     */
    public function createAppointment()
    {
        $data['patients'] = $this->patientModel->getPatients(1000); // Get all patients for dropdown
        $data['appointment'] = null;
        return view('auth/admin/appointment_form', $data);
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
            return redirect()->to('/admin/appointments');
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
            return redirect()->to('/admin/appointments');
        }

        return view('auth/admin/appointment_form', $data);
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
            return redirect()->to('/admin/appointments');
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

        return redirect()->to('/admin/appointments');
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

        return redirect()->to('/admin/appointments');
    }

    /**
     * View appointment details
     */
    public function viewAppointment($id)
    {
        $data['appointment'] = $this->appointmentModel->getAppointment($id);

        if (!$data['appointment']) {
            $this->session->setFlashdata('error', 'Appointment not found');
            return redirect()->to('/admin/appointments');
        }

        return view('auth/admin/appointment_view', $data);
    }

    /**
     * Search appointments
     */
    public function searchAppointments()
    {
        $keyword = $this->request->getGet('keyword');
        $data['appointments'] = $this->appointmentModel->searchAppointments($keyword);
        $data['keyword'] = $keyword;
        return view('auth/admin/appointments', $data);
    }

    public function billing()
    {
        $data['bills'] = $this->billModel->getBills();
        $data['totalBills'] = $this->billModel->getTotalBills();
        $data['pendingPayments'] = $this->billModel->getPendingPaymentsCount();
        $data['totalRevenue'] = $this->billModel->getTotalRevenue();
        return view('auth/admin/billing', $data);
    }

    public function pharmacy()
    {
        return view('auth/admin/pharmacy');
    }

    public function reports()
    {
        return view('auth/admin/reports');
    }

    public function users()
    {
        return view('auth/admin/users');
    }

    public function settings()
    {
        return view('auth/admin/settings');
    }
}
