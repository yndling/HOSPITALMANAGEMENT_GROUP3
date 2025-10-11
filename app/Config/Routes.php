<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --------------------
// Default & Auth Routes
// --------------------
$routes->get('/', 'AuthController::index');

$routes->get('home', 'Home::index');

// LOGIN
$routes->get('login', 'AuthController::index');           // show login form
$routes->post('login', 'AuthController::authenticate');   // process login

// LOGOUT
$routes->get('logout', 'AuthController::logout');

// REGISTER
$routes->get('register', 'AuthController::register');     // show register form
$routes->post('register', 'AuthController::store');       // process register

// DASHBOARD
$routes->get('/dashboard', 'AuthController::dashboard');

// ADMIN ROUTES
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('patients', 'AdminController::patients');
    $routes->get('appointments', 'AdminController::appointments');
    $routes->get('billing', 'AdminController::billing');
    $routes->get('pharmacy', 'AdminController::pharmacy');
    $routes->get('reports', 'AdminController::reports');
    $routes->get('users', 'AdminController::users');
    $routes->get('settings', 'AdminController::settings');
});

// DOCTOR ROUTES
$routes->group('doctor', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'DoctorController::dashboard');
    $routes->get('patients', 'DoctorController::patients');
    $routes->get('appointments', 'DoctorController::appointments');
    $routes->get('prescriptions', 'DoctorController::prescriptions');
    $routes->get('lab', 'DoctorController::lab');
});

// NURSE ROUTES
$routes->group('nurse', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'NurseController::index');
    $routes->get('patients', 'NurseController::patients');
    $routes->get('appointments', 'NurseController::appointments');
    $routes->get('medications', 'NurseController::medications');
});

// RECEPTIONIST ROUTES
$routes->group('receptionist', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'ReceptionistController::index');
    $routes->get('patients', 'ReceptionistController::patients');
    $routes->get('appointments', 'ReceptionistController::appointments');
});

// LAB ROUTES
$routes->group('lab', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'LabController::index');
    $routes->get('requests', 'LabController::requests');
    $routes->get('results', 'LabController::results');
});

// PHARMACY ROUTES
$routes->group('pharmacy', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'PharmacyController::index');
    $routes->get('medicines', 'PharmacyController::medicines');
    $routes->get('prescriptions', 'PharmacyController::prescriptions');
});

// ACCOUNTANT ROUTES
$routes->group('accountant', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'AccountantController::index');
    $routes->get('bills', 'AccountantController::bills');
    $routes->get('reports', 'AccountantController::reports');
    $routes->get('payments', 'AccountantController::payments');
});

// IT STAFF ROUTES
$routes->group('itstaff', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'ItStaffController::index');
    $routes->get('userAccounts', 'ItStaffController::userAccounts');
    $routes->get('logs', 'ItStaffController::logs');
    $routes->get('backups', 'ItStaffController::backups');
    $routes->get('settings', 'ItStaffController::settings');
});

