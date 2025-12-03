<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'role' => 'required',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ]);

        if (! $validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $userModel = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $userModel->insert($data);

        return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
    }

    public function authenticate()
    {
        $session   = session();
        $userModel = new UserModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role     = $this->request->getPost('role');

    
        $normalizedRole = str_replace(' ', '_', strtolower($role));

        $user = $userModel->where('email', $email)->first();

        if (! $user) {
            return redirect()->back()->with('error', 'Email not found');
        }

        // Use password_verify to check hashed password
        if (!password_verify($password, $user['password_hash'])) {
            return redirect()->back()->with('error', 'Invalid password');
        }

       
        if ($normalizedRole !== strtolower($user['role'])) {
            return redirect()->back()->with('error', 'Invalid role selected');
        }

        // Save to session
        $session->set([
            'id'         => $user['id'],
            'name'       => $user['name'],
            'email'      => $user['email'],
            'role'       => $user['role'],
            'isLoggedIn' => true,
        ]);

        // Redirect to role-specific dashboard
        $roleRoutes = [
            'admin' => '/admin/dashboard',
            'doctor' => '/doctor/dashboard',
            'nurse' => '/dashboard', // nurse uses the general dashboard
            'receptionist' => '/dashboard', // receptionist uses the general dashboard
            'laboratory_staff' => '/dashboard', // lab staff uses the general dashboard
            'pharmacist' => '/dashboard', // pharmacist uses the general dashboard
            'accountant' => '/dashboard', // accountant uses the general dashboard
            'it_staff' => '/dashboard', // it staff uses the general dashboard
            'itstaff' => '/dashboard', // it staff uses the general dashboard
        ];

        $redirectUrl = $roleRoutes[$user['role']] ?? '/dashboard';
        return redirect()->to($redirectUrl);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully');
    }

    public function dashboard()
    {
        $session = session();
        $role = str_replace(' ', '_', strtolower($session->get('role')));
        $data = [];

        switch ($role) {
            case 'doctor':
                $data = [
                    'totalPatients' => 120,
                    'upcomingAppointments' => 15,
                    'pendingPrescriptions' => 5,
                    'labTestsInProgress' => 3,
                ];
                break;
            case 'pharmacist':
                $data = [
                    'totalMedicines' => 200,
                    'pendingPrescriptions' => 10,
                    'dispensedPrescriptions' => 50,
                ];
                break;
            case 'laboratory_staff':
                $data = [
                    'totalRequests' => 100,
                    'pendingTests' => 20,
                    'completedTests' => 70,
                    'criticalAlerts' => 5,
                ];
                break;
            case 'accountant':
                $data = [
                    'totalBills' => 150,
                    'pendingPayments' => 25,
                    'totalRevenue' => 50000,
                ];
                break;
            case 'it_staff':
            case 'itstaff':
                $data = [
                    'totalTickets' => 30,
                    'openTickets' => 5,
                    'resolvedTickets' => 25,
                ];
                break;
            case 'receptionist':
                $data = [
                    // Add receptionist specific data here if needed
                ];
                break;
            case 'nurse':
                $data = [
                    // Add nurse specific data here if needed
                ];
                break;
            case 'admin':
            default:
                $data = [
                    // Add admin specific data here if needed
                ];
                break;
        }

        return view('auth/dashboard', $data);
    }
}
