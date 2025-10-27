<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\AppointmentModel;
use App\Models\PrescriptionModel;

class NurseController extends BaseController
{
    protected $patientModel;
    protected $appointmentModel;
    protected $prescriptionModel;
    protected $session;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = session();
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'nurse') {
            return redirect()->to('/dashboard');
        }

        $this->patientModel = new PatientModel();
        $this->appointmentModel = new AppointmentModel();
        $this->prescriptionModel = new PrescriptionModel();
    }

    public function index()
    {
        return redirect()->to('/nurse/patients');
    }

    // ==================== PATIENT MANAGEMENT ====================

    public function patients()
    {
        $data['patients'] = $this->patientModel->getPatients();
        $data['total'] = $this->patientModel->getTotalPatients();
        return view('auth/nurse/patients', $data);
    }

    public function viewPatient($id)
    {
        $data['patient'] = $this->patientModel->getPatient($id);
        $data['appointments'] = $this->appointmentModel->getAppointmentsByPatient($id);

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
        $data['appointments'] = $this->appointmentModel->getAppointments();
        $data['total'] = $this->appointmentModel->getTotalAppointments();
        return view('auth/nurse/appointments', $data);
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
        $prescription = $this->prescriptionModel
            ->select('prescriptions.*, patients.name as patient_name, patients.age, patients.gender')
            ->join('patients', 'patients.id = prescriptions.patient_id')
            ->find($id);

        if (!$prescription) {
            $this->session->setFlashdata('error', 'Prescription not found');
            return redirect()->to('/nurse/medications');
        }

        // Get prescription items with medicine details
        $prescriptionItemModel = new \App\Models\PrescriptionItemModel();
        $items = $prescriptionItemModel
            ->select('prescription_items.*, medicines.name as medicine_name, medicines.strength')
            ->join('medicines', 'medicines.id = prescription_items.medicine_id')
            ->where('prescription_items.prescription_id', $id)
            ->findAll();

        $data['prescription'] = $prescription;
        $data['items'] = $items;
        
        return view('auth/nurse/medication_view', $data);
    }
}
