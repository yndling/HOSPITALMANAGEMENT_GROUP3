<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DoctorController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'doctor') {
            return redirect()->to('/dashboard');
        }
    }

    public function dashboard()
    {
        return view('auth/dashboard');
    }

    public function patients()
    {
        return view('auth/doctor/patients');
    }

    public function appointments()
    {
        return view('auth/doctor/appointments');
    }

    public function prescriptions()
    {
        return view('auth/doctor/prescriptions');
    }

    public function lab()
    {
        return view('auth/doctor/lab');
    }
}
