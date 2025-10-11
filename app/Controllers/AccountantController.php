<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AccountantController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'accountant') {
            return redirect()->to('/dashboard');
        }
    }

    public function index()
    {
        return redirect()->to('/dashboard');
    }

    public function bills()
    {
        return view('auth/accountant/bills');
    }

    public function reports()
    {
        return view('auth/accountant/reports');
    }

    public function payments()
    {
        return view('auth/accountant/payments');
    }
}
