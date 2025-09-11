<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $isLoggedIn = (bool) $session->get('isLoggedIn');
        $role = strtolower((string) $session->get('role'));

        if (!$isLoggedIn) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        if (!in_array($role, ['admin', 'hospital administrator'], true)) {
            return redirect()->to('/home')->with('error', 'Not your role.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       
    }
}
