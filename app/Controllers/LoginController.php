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

        // ✅ Plain password check (replace with password_hash in production)
        if ($password !== $user['password']) {
            return redirect()->back()->with('error', 'Invalid password');
        }

        if ($role !== $user['role']) {
            return redirect()->back()->with('error', 'Invalid role selected');
        }

        // ✅ Save to session
        $session->set([
            'id'         => $user['id'],
            'name'       => $user['name'],
            'email'      => $user['email'],
            'role'       => $user['role'],
            'isLoggedIn' => true,
        ]);

        // ✅ Redirect depende sa role
        switch ($user['role']) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'doctor':
                return redirect()->to('/doctor/dashboard');
            case 'nurse':
                return redirect()->to('/nurse/dashboard');
            case 'laboratory_staff': // use underscore para consistent
                return redirect()->to('/lab/dashboard');
            case 'receptionist': // FIXED
                return redirect()->to('/receptionist/dashboard');
            case 'pharmacy':
                return redirect()->to('/pharmacy/dashboard');
            case 'accounting':
                return redirect()->to('/accounting/dashboard');
            case 'it':
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
