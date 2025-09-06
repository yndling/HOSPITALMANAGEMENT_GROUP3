<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');

$routes->get('home', 'Home::index');

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

$routes->get('doctor/dashboard', 'DoctorController::dashboard');
$routes->get('doctor/patients', 'DoctorController::patients');
$routes->get('doctor/appointments', 'DoctorController::appointments');
$routes->get('doctor/prescriptions', 'DoctorController::prescriptions');
$routes->get('doctor/lab', 'DoctorController::lab');

$routes->get('nurse/dashboard', 'NurseController::dashboard');
$routes->get('nurse/patients', 'NurseController::patients');
$routes->get('nurse/appointments', 'NurseController::appointments');
$routes->get('nurse/medications', 'NurseController::medications');
