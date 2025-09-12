<?php

namespace App\Controllers;

class ITStaffController extends BaseController
{
    public function dashboard()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'it_staff') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample statistics data
        $data = [
            'totalTickets' => 40,
            'openTickets' => 10,
            'resolvedTickets' => 30,
        ];

        return view('itstaff/dashboard', $data);
    }

    public function userAccounts()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'it_staff') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample user accounts data
        $data = [
            'users' => [
                ['username' => 'user1', 'roles' => 'Admin', 'status' => 'Active'],
                ['username' => 'user2', 'roles' => 'User', 'status' => 'Inactive'],
                ['username' => 'user3', 'roles' => 'User', 'status' => 'Active'],
            ],
        ];

        return view('itstaff/user_accounts', $data);
    }

    public function logs()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'it_staff') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample logs data
        $data = [
            'logs' => [
                ['date' => '2024-01-01', 'user' => 'admin', 'action' => 'Login successful'],
                ['date' => '2024-01-02', 'user' => 'user1', 'action' => 'Failed login attempt'],
                ['date' => '2024-01-03', 'user' => 'user2', 'action' => 'Password changed'],
            ],
        ];

        return view('itstaff/logs', $data);
    }

    public function backups()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'it_staff') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample backups data
        $data = [
            'backups' => [
                ['date' => '2024-01-01', 'type' => 'Full', 'status' => 'Completed'],
                ['date' => '2024-01-15', 'type' => 'Incremental', 'status' => 'Completed'],
                ['date' => '2024-02-01', 'type' => 'Full', 'status' => 'Failed'],
            ],
        ];

        return view('itstaff/backups', $data);
    }

    public function settings()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'it_staff') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        return view('itstaff/settings');
    }
}
