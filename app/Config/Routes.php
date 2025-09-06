<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');

$routes->get('home', function() {
    return redirect()->to('/login');
});

$routes->get('login', 'LoginController::index');
$routes->post('login/authenticate', 'LoginController::authenticate');
$routes->get('login/logout', 'LoginController::logout');

$routes->get('register', 'LoginController::register');
$routes->post('register', 'LoginController::store');

$routes->get('admin/dashboard', 'AdminController::dashboard');

$routes->get('admin/patients', 'AdminController::patients');
$routes->get('admin/appointments', 'AdminController::appointments');
$routes->get('admin/billing', 'AdminController::billing');
$routes->get('admin/pharmacy', 'AdminController::pharmacy');
$routes->get('admin/reports', 'AdminController::reports');
$routes->get('admin/users', 'UsersController::index');
$routes->get('admin/settings', 'AdminController::settings');
