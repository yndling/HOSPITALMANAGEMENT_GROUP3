<?php

namespace App\Controllers;

use App\Models\ReceptionistModel;

class ReceptionistController extends BaseController
{
    /**
     * Dashboard
     */
    public function dashboard()
    {
        return view('receptionist/dashboard');
    }

    // ---------------------------
    // Patients Management
    // ---------------------------

    public function patients()
    {
        $model = new ReceptionistModel();
        $data['patients'] = $model->getPatients();

        return view('receptionist/patients', $data);
    }

    public function createPatient()
    {
        return view('receptionist/create_patient');
    }

    public function storePatient()
    {
        $model = new ReceptionistModel();
        $model->addPatient([
            'name'    => $this->request->getPost('name'),
            'age'     => $this->request->getPost('age'),
            'gender'  => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'contact' => $this->request->getPost('contact'),
        ]);

        return redirect()->to('/receptionist/patients')
                         ->with('message', 'Patient added successfully!');
    }

    public function editPatient($id)
    {
        $model = new ReceptionistModel();
        $data['patient'] = $model->getPatientById($id);

        return view('receptionist/edit_patient', $data);
    }

    public function updatePatient($id)
    {
        $model = new ReceptionistModel();
        $model->updatePatient($id, [
            'name'    => $this->request->getPost('name'),
            'age'     => $this->request->getPost('age'),
            'gender'  => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'contact' => $this->request->getPost('contact'),
        ]);

        return redirect()->to('/receptionist/patients')
                         ->with('message', 'Patient updated successfully!');
    }

    public function deletePatient($id)
    {
        $model = new ReceptionistModel();
        $model->deletePatient($id);

        return redirect()->to('/receptionist/patients')
                         ->with('message', 'Patient deleted successfully!');
    }

    // ---------------------------
    // Appointments Management
    // ---------------------------

    public function appointments()
    {
        $model = new ReceptionistModel();
        $data['appointments'] = $model->getAppointments();

        return view('receptionist/appointments', $data);
    }

    public function createAppointment()
    {
        $model = new ReceptionistModel();
        $data['patients'] = $model->getPatients();

        return view('receptionist/create_appointment', $data);
    }

    public function storeAppointment()
    {
        $model = new ReceptionistModel();
        $model->addAppointment([
            'patient_id' => $this->request->getPost('patient_id'),
            'doctor'     => $this->request->getPost('doctor'),
            'date'       => $this->request->getPost('date'),
            'time'       => $this->request->getPost('time'),
            'status'     => 'Pending',
        ]);

        return redirect()->to('/receptionist/appointments')
                         ->with('message', 'Appointment scheduled successfully!');
    }

    public function editAppointment($id)
    {
        $model = new ReceptionistModel();
        $data['appointment'] = $model->getAppointmentById($id);
        $data['patients'] = $model->getPatients();

        return view('receptionist/edit_appointment', $data);
    }

    public function updateAppointment($id)
    {
        $model = new ReceptionistModel();
        $model->updateAppointment($id, [
            'patient_id' => $this->request->getPost('patient_id'),
            'doctor'     => $this->request->getPost('doctor'),
            'date'       => $this->request->getPost('date'),
            'time'       => $this->request->getPost('time'),
            'status'     => $this->request->getPost('status'),
        ]);

        return redirect()->to('/receptionist/appointments')
                         ->with('message', 'Appointment updated successfully!');
    }

    public function deleteAppointment($id)
    {
        $model = new ReceptionistModel();
        $model->deleteAppointment($id);

        return redirect()->to('/receptionist/appointments')
                         ->with('message', 'Appointment deleted successfully!');
    }
}
