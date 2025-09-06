<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function dashboard()
    {
        if (!$this->session->get('isLoggedIn') || (strtolower($this->session->get('role')) !== 'admin' && strtolower($this->session->get('role')) !== 'hospital administrator')) {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        return view('admin/dashboard');
    }

    public function users()
    {
        if (!$this->session->get('isLoggedIn') || (strtolower($this->session->get('role')) !== 'admin' && strtolower($this->session->get('role')) !== 'hospital administrator')) {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        return view('admin/users');
    }

    public function patients()
    {
        if (!$this->session->get('isLoggedIn') || (strtolower($this->session->get('role')) !== 'admin' && strtolower($this->session->get('role')) !== 'hospital administrator')) {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        return view('admin/patients');
    }

    public function appointments()
    {
        if (!$this->session->get('isLoggedIn') || (strtolower($this->session->get('role')) !== 'admin' && strtolower($this->session->get('role')) !== 'hospital administrator')) {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        return view('admin/appointments');
    }

    public function billing()
    {
        if (!$this->session->get('isLoggedIn') || (strtolower($this->session->get('role')) !== 'admin' && strtolower($this->session->get('role')) !== 'hospital administrator')) {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        return view('admin/billing');
    }

    public function pharmacy()
    {
        if (!$this->session->get('isLoggedIn') || (strtolower($this->session->get('role')) !== 'admin' && strtolower($this->session->get('role')) !== 'hospital administrator')) {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        return view('admin/pharmacy');
    }

    public function reports()
    {
        if (!$this->session->get('isLoggedIn') || (strtolower($this->session->get('role')) !== 'admin' && strtolower($this->session->get('role')) !== 'hospital administrator')) {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        return view('admin/reports');
    }

    public function settings()
    {
        if (!$this->session->get('isLoggedIn') || (strtolower($this->session->get('role')) !== 'admin' && strtolower($this->session->get('role')) !== 'hospital administrator')) {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        return view('admin/settings');
    }
}
