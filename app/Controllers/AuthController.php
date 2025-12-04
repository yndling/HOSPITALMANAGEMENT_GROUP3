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

        try {
            $userModel->insert($data);
            return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
        } catch (\Exception $e) {
            log_message('error', 'Database error during user registration: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Registration failed due to a database error. Please try again.');
        }
    }

    public function authenticate()
    {
        $session   = session();
        $userModel = new UserModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role     = $this->request->getPost('role');

        // Normalize input role
        $normalizedInputRole = str_replace(' ', '_', strtolower($role));

        try {
            $user = $userModel->where('email', $email)->first();

            if (! $user) {
                return redirect()->back()->with('error', 'Email not found');
            }

            // Check password
            if (!password_verify($password, $user['password_hash'])) {
                return redirect()->back()->with('error', 'Invalid password');
            }

            // Normalize user role from database
            $normalizedUserRole = str_replace(' ', '_', strtolower($user['role']));

            if ($normalizedInputRole !== $normalizedUserRole) {
                return redirect()->back()->with('error', 'Invalid role selected');
            }

            // Save session
            $session->set([
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'], // keep original for display
                'isLoggedIn' => true,
            ]);

            // Redirect to role-specific dashboard
            $roleRoutes = [
                'admin' => '/admin/dashboard',
                'doctor' => '/doctor/dashboard',
                'nurse' => '/dashboard',
                'receptionist' => '/dashboard',
                'laboratory_staff' => '/dashboard',
                'pharmacist' => '/dashboard',
                'accountant' => '/dashboard',
                'it_staff' => '/dashboard',
                'itstaff' => '/dashboard',
            ];

            $redirectUrl = $roleRoutes[$normalizedUserRole] ?? '/dashboard';
            return redirect()->to($redirectUrl);

        } catch (\Exception $e) {
            log_message('error', 'Database error during authentication: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Authentication failed due to a database error. Please try again.');
        }
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
                    'todayAppointments' => [],
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
                    'todaysPatients' => 24,
                    'upcomingAppointments' => 8,
                    'pendingTasks' => 5,
                ];
                break;
            case 'nurse':
                $data = [
                    // Nurse dashboard data here
                ];
                break;
            case 'admin':
            default:
                $data = [
                    // Admin dashboard data here
                ];
                break;
        }

        return view('auth/dashboard', $data);
    }
}
