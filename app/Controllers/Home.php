<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            $role = session()->get('role');
            if ($role === 'admin' || $role === 'Hospital Administrator') {
                return redirect()->to('/admin/dashboard');
            } elseif ($role === 'doctor') {
                return redirect()->to('/doctor/dashboard');
            } elseif ($role === 'nurse') {
                return redirect()->to('/nurse/dashboard');
            } else {
                return redirect()->to('/login')->with('error', 'Not your role');
            }
        }
        return view('login');
    }
}
