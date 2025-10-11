<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ReceptionistController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'receptionist') {
            return redirect()->to('/dashboard');
        }
    }

    public function index()
    {
        return redirect()->to('/dashboard');
    }

    public function patients()
    {
        return view('auth/receptionist/patients');
    }

    public function appointments()
    {
        return view('auth/receptionist/appointments');
    }
}
