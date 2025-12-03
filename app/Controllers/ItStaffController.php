<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ItStaffController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $session = session();
        $role = $session->get('role');
        if (!$session->get('isLoggedIn') || !($role === 'it_staff' || $role === 'itstaff')) {
            return redirect()->to('/dashboard');
        }
    }

    public function index()
    {
        return redirect()->to('/dashboard');
    }

    public function userAccounts()
    {
        return view('auth/itstaff/userAccounts');
    }

    public function logs()
    {
        return view('auth/itstaff/logs');
    }

    public function backups()
    {
        return view('auth/itstaff/backups');
    }

    public function settings()
    {
        return view('auth/itstaff/settings');
    }
}
