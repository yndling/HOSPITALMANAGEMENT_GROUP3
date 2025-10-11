<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }
    }

    public function index()
    {
        return redirect()->to('/dashboard');
    }

    public function patients()
    {
        return view('auth/admin/patients');
    }

    public function appointments()
    {
        return view('auth/admin/appointments');
    }

    public function billing()
    {
        return view('auth/admin/billing');
    }

    public function pharmacy()
    {
        return view('auth/admin/pharmacy');
    }

    public function reports()
    {
        return view('auth/admin/reports');
    }

    public function users()
    {
        return view('auth/admin/users');
    }

    public function settings()
    {
        return view('auth/admin/settings');
    }
}
