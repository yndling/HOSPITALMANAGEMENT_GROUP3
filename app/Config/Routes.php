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
    $routes->get('dashboard', 'AdminController::dashboard');

    // Staff Management
    $routes->get('staff', 'AdminController::staff');
    $routes->get('staff/create', 'AdminController::createStaff');
    $routes->post('staff/store', 'AdminController::storeStaff');
    $routes->get('staff/edit/(:num)', 'AdminController::editStaff/$1');
    $routes->post('staff/update/(:num)', 'AdminController::updateStaff/$1');
    $routes->get('staff/delete/(:num)', 'AdminController::deleteStaff/$1');
    $routes->get('staff/search', 'AdminController::searchStaff');

    // Billing Management
    $routes->get('bills', 'AdminController::bills');
    $routes->get('bills/create', 'AdminController::createBill');
    $routes->post('bills/store', 'AdminController::storeBill');
    $routes->get('bills/edit/(:num)', 'AdminController::editBill/$1');
    $routes->post('bills/update/(:num)', 'AdminController::updateBill/$1');
    $routes->get('bills/delete/(:num)', 'AdminController::deleteBill/$1');
    $routes->get('bills/invoice/(:num)', 'AdminController::createInvoice/$1');
    $routes->get('bills/payment/(:num)', 'AdminController::recordPayment/$1');
    $routes->post('payments/store', 'AdminController::storePayment');

    // Existing routes
    $routes->get('patients', 'AdminController::patients');
    $routes->get('patients/create', 'AdminController::createPatient');
    $routes->post('patients/store', 'AdminController::storePatient');
    $routes->get('appointments', 'AdminController::appointments');
    $routes->get('appointments/create', 'AdminController::createAppointment');
    $routes->post('appointments/store', 'AdminController::storeAppointment');
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

    // Patient Management
    $routes->get('patients', 'ReceptionistController::patients');
    $routes->get('patients/create', 'ReceptionistController::createPatient');
    $routes->post('patients/store', 'ReceptionistController::storePatient');
    $routes->get('patients/edit/(:num)', 'ReceptionistController::editPatient/$1');
    $routes->post('patients/update/(:num)', 'ReceptionistController::updatePatient/$1');
    $routes->get('patients/delete/(:num)', 'ReceptionistController::deletePatient/$1');
    $routes->get('patients/view/(:num)', 'ReceptionistController::viewPatient/$1');
    $routes->get('patients/search', 'ReceptionistController::searchPatients');

    // Appointment Management
    $routes->get('appointments', 'ReceptionistController::appointments');
    $routes->get('appointments/create', 'ReceptionistController::createAppointment');
    $routes->post('appointments/store', 'ReceptionistController::storeAppointment');
    $routes->get('appointments/edit/(:num)', 'ReceptionistController::editAppointment/$1');
    $routes->post('appointments/update/(:num)', 'ReceptionistController::updateAppointment/$1');
    $routes->get('appointments/delete/(:num)', 'ReceptionistController::deleteAppointment/$1');
    $routes->post('appointments/status/(:num)', 'ReceptionistController::updateAppointmentStatus/$1');
    $routes->get('appointments/view/(:num)', 'ReceptionistController::viewAppointment/$1');
    $routes->get('appointments/search', 'ReceptionistController::searchAppointments');
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

