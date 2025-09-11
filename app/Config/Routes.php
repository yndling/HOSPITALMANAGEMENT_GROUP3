<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --------------------
// Default & Auth Routes
// --------------------
$routes->get('/', 'LoginController::index');

$routes->get('home', 'Home::index');

// LOGIN
$routes->get('login', 'LoginController::index');           // show login form
$routes->post('login', 'LoginController::authenticate');   // process login

// LOGOUT
$routes->get('logout', 'LoginController::logout');

// REGISTER
$routes->get('register', 'LoginController::register');     // show register form
$routes->post('register', 'LoginController::store');       // process register

// --------------------
// Admin Routes
// --------------------
$routes->group('admin', static function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('patients', 'AdminController::patients');
    $routes->get('appointments', 'AdminController::appointments');
    $routes->get('billing', 'AdminController::billing');
    $routes->get('pharmacy', 'AdminController::pharmacy');
    $routes->get('reports', 'AdminController::reports');
    $routes->get('settings', 'AdminController::settings');

    // Users Management
    $routes->get('users', 'UsersController::index');
});

// --------------------
// Doctor Routes
// --------------------
$routes->group('doctor', static function ($routes) {
    $routes->get('dashboard', 'DoctorController::dashboard');
    $routes->get('patients', 'DoctorController::patients');
    $routes->get('appointments', 'DoctorController::appointments');
    $routes->get('prescriptions', 'DoctorController::prescriptions');
    $routes->get('lab', 'DoctorController::lab');
});

// --------------------
// Nurse Routes
// --------------------
$routes->group('nurse', static function ($routes) {
    $routes->get('dashboard', 'NurseController::dashboard');
    $routes->get('patients', 'NurseController::patients');
    $routes->get('appointments', 'NurseController::appointments');
    $routes->get('medications', 'NurseController::medications');
});

// --------------------
// Receptionist Routes
// --------------------
$routes->group('receptionist', static function ($routes) {
    $routes->get('dashboard', 'ReceptionistController::dashboard');

    // Patients
    $routes->get('patients', 'ReceptionistController::patients');
    $routes->get('patients/create', 'ReceptionistController::createPatient');
    $routes->post('patients/store', 'ReceptionistController::storePatient');
    $routes->get('patients/edit/(:num)', 'ReceptionistController::editPatient/$1');
    $routes->post('patients/update/(:num)', 'ReceptionistController::updatePatient/$1');
    $routes->get('patients/delete/(:num)', 'ReceptionistController::deletePatient/$1');

    // Appointments
    $routes->get('appointments', 'ReceptionistController::appointments');
    $routes->get('appointments/create', 'ReceptionistController::createAppointment');
    $routes->post('appointments/store', 'ReceptionistController::storeAppointment');
    $routes->get('appointments/edit/(:num)', 'ReceptionistController::editAppointment/$1');
    $routes->post('appointments/update/(:num)', 'ReceptionistController::updateAppointment/$1');
    $routes->get('appointments/delete/(:num)', 'ReceptionistController::deleteAppointment/$1');
});

// --------------------
// Laboratory Staff Routes
// --------------------
$routes->group('lab', static function ($routes) {
    $routes->get('dashboard', 'LaboratoryStaffController::dashboard');
    $routes->get('testing-requests', 'LaboratoryStaffController::testingRequests');
    $routes->get('results', 'LaboratoryStaffController::results');
    $routes->post('results/save', 'LaboratoryStaffController::saveResult');
    $routes->get('records', 'LaboratoryStaffController::records');
});

// --------------------
// Pharmacist Routes
// --------------------
$routes->group('pharmacist', static function ($routes) {
    $routes->get('dashboard', 'PharmacistController::dashboard');

    // Medicines
    $routes->get('medicines', 'PharmacistController::medicines');
    $routes->get('medicines/create', 'PharmacistController::createMedicine');
    $routes->post('medicines/store', 'PharmacistController::storeMedicine');
    $routes->get('medicines/edit/(:num)', 'PharmacistController::editMedicine/$1');
    $routes->post('medicines/update/(:num)', 'PharmacistController::updateMedicine/$1');
    $routes->get('medicines/delete/(:num)', 'PharmacistController::deleteMedicine/$1');

    // Prescriptions
    $routes->get('prescriptions', 'PharmacistController::prescriptions');
    $routes->post('prescriptions/dispense/(:num)', 'PharmacistController::dispensePrescription/$1');
});
