<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function dashboard()
    {
        // Add role check for Hospital Administrator
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'Hospital Administrator') {
            return redirect()->to('/login');
        }

        return view('admin/dashboard');
    }

    public function patients()
    {
        return view('admin/patients');
    }

    public function appointments()
    {
        return view('admin/appointments');
    }

    public function billing()
    {
        return view('admin/billing');
    }

    public function pharmacy()
    {
        return view('admin/pharmacy');
    }

    public function reports()
    {
        return view('admin/reports');
    }

    public function settings()
    {
        return view('admin/settings');
    }
}
