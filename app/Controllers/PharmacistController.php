<?php

namespace App\Controllers;

class PharmacistController extends BaseController
{
    public function dashboard()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'pharmacist') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample statistics data
        $data = [
            'totalMedicines' => 50,
            'pendingPrescriptions' => 12,
            'dispensedPrescriptions' => 30,
        ];

        // Use pharmacist layout
        return view('pharmacist/dashboard', $data);
    }

    public function medicines()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'pharmacist') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample medicines data
        $data = [
            'medicines' => [
                ['id' => 'M001', 'name' => 'Paracetamol', 'quantity' => 100, 'expiry' => '2024-12-31'],
                ['id' => 'M002', 'name' => 'Amoxicillin', 'quantity' => 50, 'expiry' => '2025-06-30'],
                ['id' => 'M003', 'name' => 'Ibuprofen', 'quantity' => 75, 'expiry' => '2024-09-15'],
            ],
        ];

        return view('pharmacist/medicines', $data);
    }

    public function createMedicine()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'pharmacist') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        return view('pharmacist/create_medicine');
    }

    public function storeMedicine()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'pharmacist') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Logic to store medicine (to be implemented)
        // For now, redirect back to medicines list
        return redirect()->to('/pharmacist/medicines');
    }

    public function editMedicine($id)
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'pharmacist') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample medicine data for editing
        $data = [
            'medicine' => ['id' => $id, 'name' => 'Sample Medicine', 'quantity' => 100, 'expiry' => '2024-12-31'],
        ];

        return view('pharmacist/edit_medicine', $data);
    }

    public function updateMedicine($id)
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'pharmacist') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Logic to update medicine (to be implemented)
        // For now, redirect back to medicines list
        return redirect()->to('/pharmacist/medicines');
    }

    public function deleteMedicine($id)
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'pharmacist') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Logic to delete medicine (to be implemented)
        // For now, redirect back to medicines list
        return redirect()->to('/pharmacist/medicines');
    }

    public function prescriptions()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'pharmacist') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample prescriptions data
        $data = [
            'prescriptions' => [
                ['id' => 'PR001', 'patient' => 'John Doe', 'medicine' => 'Paracetamol', 'status' => 'Pending'],
                ['id' => 'PR002', 'patient' => 'Jane Smith', 'medicine' => 'Amoxicillin', 'status' => 'Dispensed'],
            ],
        ];

        return view('pharmacist/prescriptions', $data);
    }

    public function dispensePrescription($id)
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'pharmacist') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Logic to dispense prescription (to be implemented)
        // For now, redirect back to prescriptions list
        return redirect()->to('/pharmacist/prescriptions');
    }
}
