<?php

namespace App\Controllers;

class DoctorController extends BaseController
{
    public function dashboard()
    {
        if (!$this->session->get('isLoggedIn') || ($this->session->get('role') !== 'doctor')) {
            return redirect()->to('/login');
        }

        // Sample statistics data
        $data = [
            'totalPatients' => 120,
            'upcomingAppointments' => 15,
            'pendingPrescriptions' => 8,
            'labTestsInProgress' => 5,
        ];

        return view('doctor/dashboard', $data);
    }

    public function patients()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'doctor') {
            return redirect()->to('/login');
        }

        // Sample patients data
        $data = [
            'patients' => [
                ['id' => 'P001', 'name' => 'John Doe', 'contact' => '123-456-7890', 'status' => 'Active'],
                ['id' => 'P002', 'name' => 'Jane Smith', 'contact' => '987-654-3210', 'status' => 'Inactive'],
                ['id' => 'P003', 'name' => 'Bob Johnson', 'contact' => '555-123-4567', 'status' => 'Active'],
            ],
        ];

        return view('doctor/patients', $data);
    }

    public function appointments()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'doctor') {
            return redirect()->to('/login');
        }

        return view('doctor/appointments');
    }

    public function prescriptions()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'doctor') {
            return redirect()->to('/login');
        }

        return view('doctor/prescriptions');
    }

    public function lab()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'doctor') {
            return redirect()->to('/login');
        }

        return view('doctor/lab');
    }
}
