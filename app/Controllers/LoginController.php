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
        // If user is already logged in, redirect to dashboard or home
        if ($this->session->get('isLoggedIn')) {
            $role = $this->session->get('role');
            if ($role === 'Hospital Administrator') {
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

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        try {
            $this->userModel->insert($data);

            // After registration, automatically log in the user and redirect to dashboard or home
            $user = $this->userModel->findByEmail($data['email']);
            $this->session->set([
                'user_id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role'],
                'name' => $user['name'],
                'isLoggedIn' => true,
            ]);
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/login');
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
            if ($user['role'] !== $role) {
                return redirect()->back()->with('error', 'Selected role does not match user role');
            }
            if (password_verify($password, $user['password_hash'])) {
                $this->session->set([
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'name' => $user['name'],
                    'isLoggedIn' => true,
                ]);
                if ($user['role'] === 'Hospital Administrator') {
                    return redirect()->to('/admin/dashboard');
                } else {
                    return redirect()->to('/home');
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
