<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LabController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'laboratory_staff') {
            return redirect()->to('/dashboard');
        }
    }

    public function index()
    {
        return redirect()->to('/dashboard');
    }

    public function requests()
    {
        return view('auth/lab/requests');
    }

    public function results()
    {
        return view('auth/lab/results');
    }
}
