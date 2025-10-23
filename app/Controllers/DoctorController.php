<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\AppointmentModel;

class DoctorController extends BaseController
{
    protected $patientModel;
    protected $appointmentModel;
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
    }

    public function index()
    {
        return redirect()->to('/doctor/patients');
    }

    public function dashboard()
    {
        return view('auth/dashboard');
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
            'name'    => $this->request->getPost('name'),
            'age'     => $this->request->getPost('age'),
            'gender'  => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'contact' => $this->request->getPost('contact')
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
            'name'    => $this->request->getPost('name'),
            'age'     => $this->request->getPost('age'),
            'gender'  => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'contact' => $this->request->getPost('contact')
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
        return view('auth/doctor/prescriptions');
    }

    public function lab()
    {
        return view('auth/doctor/lab');
    }
}
