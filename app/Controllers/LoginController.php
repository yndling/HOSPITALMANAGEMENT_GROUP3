<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
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

        $user = $userModel->where('email', $email)->first();

        if (! $user) {
            return redirect()->back()->with('error', 'Email not found');
        }

        // Use password_verify to check hashed password
        if (!password_verify($password, $user['password_hash'])) {
            return redirect()->back()->with('error', 'Invalid password');
        }

        // Normalize role to lowercase for comparison
        if (strtolower($role) !== strtolower($user['role'])) {
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

        // Redirect based on role (normalize to lowercase)
        switch (strtolower($user['role'])) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'doctor':
                return redirect()->to('/doctor/dashboard');
            case 'nurse':
                return redirect()->to('/nurse/dashboard');
            case 'laboratory_staff': // use underscore to match registration form
                return redirect()->to('/lab/dashboard');
            case 'receptionist':
                return redirect()->to('/receptionist/dashboard');
            case 'pharmacist':
                return redirect()->to('/pharmacy/dashboard');
            case 'accountant':
                return redirect()->to('/accounting/dashboard');
            case 'it_staff':
                return redirect()->to('/it/dashboard');
            default:
                return redirect()->to('/login')->with('error', 'Unknown role');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully');
    }
}
