<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class AdminController extends BaseController
{
    /**
     * Simple role guard. Tawagin sa simula ng bawat method.
     */
    private function guard(): ?RedirectResponse
    {
        $session = session();
        $isLoggedIn = (bool) $session->get('isLoggedIn');
        $role = strtolower((string) $session->get('role'));

        if (!$isLoggedIn) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        // Payagan lang: admin o hospital administrator
        if (!in_array($role, ['admin', 'hospital administrator'], true)) {
            return redirect()->to('/home')->with('error', 'Not your role.');
        }

        return null; // OK
    }

    public function dashboard()
    {
        if ($r = $this->guard()) return $r;
        return view('admin/dashboard');
    }

    public function users()
    {
        if ($r = $this->guard()) return $r;
        return view('admin/users');
    }

    public function patients()
    {
        if ($r = $this->guard()) return $r;
        return view('admin/patients');
    }

    public function appointments()
    {
        if ($r = $this->guard()) return $r;
        return view('admin/appointments');
    }

    public function billing()
    {
        if ($r = $this->guard()) return $r;
        return view('admin/billing');
    }

    public function pharmacy()
    {
        if ($r = $this->guard()) return $r;
        return view('admin/pharmacy');
    }

    public function reports()
    {
        if ($r = $this->guard()) return $r;
        return view('admin/reports');
    }

    public function settings()
    {
        if ($r = $this->guard()) return $r;
        return view('admin/settings');
    }
}
