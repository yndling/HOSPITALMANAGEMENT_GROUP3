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
$routes->group('admin', function ($routes) {
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
$routes->group('doctor', function ($routes) {
    $routes->get('dashboard', 'DoctorController::dashboard');
    $routes->get('patients', 'DoctorController::patients');
    $routes->get('appointments', 'DoctorController::appointments');
    $routes->get('prescriptions', 'DoctorController::prescriptions');
    $routes->get('lab', 'DoctorController::lab');
});

// --------------------
// Nurse Routes
// --------------------
$routes->group('nurse', function ($routes) {
    $routes->get('dashboard', 'NurseController::dashboard');
    $routes->get('patients', 'NurseController::patients');
    $routes->get('appointments', 'NurseController::appointments');
    $routes->get('medications', 'NurseController::medications');
});

// --------------------
// Laboratory Staff Routes
// --------------------
$routes->group('lab', function ($routes) {
    $routes->get('dashboard', 'LaboratoryStaffController::dashboard');
    $routes->get('testing-requests', 'LaboratoryStaffController::testingRequests');
    $routes->get('results', 'LaboratoryStaffController::results');
    $routes->post('results/save', 'LaboratoryStaffController::saveResult');
    $routes->get('records', 'LaboratoryStaffController::records');
});

// --------------------
// Patients CRUD (Global Routes)
// --------------------
$routes->group('patients', function ($routes) {
    $routes->get('/', 'PatientController::index');                  // list
    $routes->get('create', 'PatientController::create');            // create form
    $routes->post('store', 'PatientController::store');             // save new
    $routes->get('edit/(:num)', 'PatientController::edit/$1');      // edit form
    $routes->post('update/(:num)', 'PatientController::update/$1'); // update record
    $routes->get('delete/(:num)', 'PatientController::delete/$1');  // delete record
});
