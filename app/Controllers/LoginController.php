<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginController extends Controller
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function index()
    {
      
        if ($this->session->get('isLoggedIn')) {
            $role = $this->session->get('role');
            if ($role === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/home');
            }
        }
        return view('login');
    }

    public function register()
    {
        // If user is already logged in, redirect to home
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/home');
        }
        return view('register');
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'role' => 'required',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $role = strtolower($this->request->getPost('role'));

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $role,
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        try {
            $this->userModel->insert($data);

            // After registration, automatically log in the user and redirect to dashboard or home
            $user = $this->userModel->findByEmail($data['email']);
            $this->session->set([
                'user_id' => $user['id'],
                'email' => $user['email'],
                'role' => strtolower($user['role']),
                'name' => $user['name'],
                'isLoggedIn' => true,
            ]);
            if ($user['role'] === 'admin' || strtolower($user['role']) === 'hospital administrator') {
                return redirect()->to('/admin/dashboard');
            } elseif (strtolower($user['role']) === 'doctor') {
                return redirect()->to('/doctor/dashboard');
            } elseif (strtolower($user['role']) === 'nurse') {
                return redirect()->to('/nurse/dashboard');
            } else {
                return redirect()->to('/login')->with('error', 'Dashboard not available for your role.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        $user = $this->userModel->findByEmail($email);

        if ($user) {
            if (strtolower($user['role']) !== strtolower($role)) {
                return redirect()->back()->with('error', 'Selected role does not match user role');
            }
            if (password_verify($password, $user['password_hash'])) {
                $this->session->set([
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'role' => strtolower($user['role']),
                    'name' => $user['name'],
                    'isLoggedIn' => true,
                ]);
            if (strtolower($user['role']) === 'admin' || strtolower($user['role']) === 'hospital administrator') {
                return redirect()->to('/admin/dashboard');
            } elseif (strtolower($user['role']) === 'doctor') {
                return redirect()->to('/doctor/dashboard');
            } elseif (strtolower($user['role']) === 'nurse') {
                return redirect()->to('/nurse/dashboard');
            } else {
                return redirect()->to('/login')->with('error', 'Dashboard not available for your role.');
            }
            } else {
                return redirect()->back()->with('error', 'Invalid password');
            }
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
