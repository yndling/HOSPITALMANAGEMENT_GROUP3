<?php

namespace App\Controllers;

class AccountantController extends BaseController
{
    public function dashboard()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'accountant') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample statistics data
        $data = [
            'totalBills' => 150,
            'pendingPayments' => 25,
            'totalRevenue' => 50000,
        ];

        // Use accountant layout
        return view('accountant/dashboard', $data);
    }

    public function bills()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'accountant') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample bills data
        $data = [
            'bills' => [
                ['id' => 'B001', 'patient' => 'John Doe', 'amount' => 500, 'status' => 'Paid'],
                ['id' => 'B002', 'patient' => 'Jane Smith', 'amount' => 750, 'status' => 'Pending'],
                ['id' => 'B003', 'patient' => 'Bob Johnson', 'amount' => 300, 'status' => 'Paid'],
            ],
        ];

        return view('accountant/bills', $data);
    }

    public function reports()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'accountant') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample reports data
        $data = [
            'reports' => [
                ['id' => 'R001', 'type' => 'Monthly Revenue', 'date' => '2024-01-31'],
                ['id' => 'R002', 'type' => 'Expense Report', 'date' => '2024-01-31'],
            ],
        ];

        return view('accountant/reports', $data);
    }

    public function payments()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'accountant') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample payments data
        $data = [
            'payments' => [
                ['id' => 'P001', 'patient' => 'John Doe', 'amount' => 500, 'date' => '2024-01-15'],
                ['id' => 'P002', 'patient' => 'Jane Smith', 'amount' => 750, 'date' => '2024-01-20'],
            ],
        ];

        return view('accountant/payments', $data);
    }
}
