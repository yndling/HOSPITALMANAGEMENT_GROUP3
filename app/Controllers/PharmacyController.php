<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PharmacyController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'pharmacist') {
            return redirect()->to('/dashboard');
        }
    }

    public function index()
    {
        return redirect()->to('/dashboard');
    }

    public function medicines()
    {
        return view('auth/pharmacy/medicines');
    }

    public function prescriptions()
    {
        return view('auth/pharmacy/prescriptions');
    }
}
