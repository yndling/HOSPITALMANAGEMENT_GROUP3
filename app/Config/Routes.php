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
    $routes->get('patients/view/(:num)', 'AdminController::viewPatient/$1');
    $routes->get('patients/edit/(:num)', 'AdminController::editPatient/$1');
    $routes->post('patients/update/(:num)', 'AdminController::updatePatient/$1');
    $routes->get('patients/delete/(:num)', 'AdminController::deletePatient/$1');
    $routes->get('appointments', 'AdminController::appointments');
    $routes->get('appointments/create', 'AdminController::createAppointment');
    $routes->post('appointments/store', 'AdminController::storeAppointment');
    $routes->get('appointments/view/(:num)', 'AdminController::viewAppointment/$1');
    $routes->get('appointments/edit/(:num)', 'AdminController::editAppointment/$1');
    $routes->post('appointments/update/(:num)', 'AdminController::updateAppointment/$1');
    $routes->get('appointments/delete/(:num)', 'AdminController::deleteAppointment/$1');
    $routes->get('billing', 'AdminController::billing');
    $routes->get('pharmacy', 'AdminController::pharmacy');
    $routes->get('reports', 'AdminController::reports');
    $routes->get('users', 'AdminController::users');
    $routes->get('settings', 'AdminController::settings');
});

// DOCTOR ROUTES
$routes->group('doctor', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'DoctorController::index');
    $routes->get('dashboard', 'DoctorController::dashboard');

    // Patient Management
    $routes->get('patients', 'DoctorController::patients');
    $routes->get('patients/create', 'DoctorController::createPatient');
    $routes->post('patients/store', 'DoctorController::storePatient');
    $routes->get('patients/edit/(:num)', 'DoctorController::editPatient/$1');
    $routes->post('patients/update/(:num)', 'DoctorController::updatePatient/$1');
    $routes->get('patients/delete/(:num)', 'DoctorController::deletePatient/$1');
    $routes->get('patients/view/(:num)', 'DoctorController::viewPatient/$1');
    $routes->get('patients/search', 'DoctorController::searchPatients');

    // Appointment Management
    $routes->get('appointments', 'DoctorController::appointments');
    $routes->get('appointments/create', 'DoctorController::createAppointment');
    $routes->post('appointments/store', 'DoctorController::storeAppointment');
    $routes->get('appointments/edit/(:num)', 'DoctorController::editAppointment/$1');
    $routes->post('appointments/update/(:num)', 'DoctorController::updateAppointment/$1');
    $routes->get('appointments/delete/(:num)', 'DoctorController::deleteAppointment/$1');
    $routes->post('appointments/status/(:num)', 'DoctorController::updateAppointmentStatus/$1');
    $routes->get('appointments/view/(:num)', 'DoctorController::viewAppointment/$1');
    $routes->get('appointments/search', 'DoctorController::searchAppointments');

    $routes->get('prescriptions', 'DoctorController::prescriptions');
    $routes->get('prescriptions/create', 'DoctorController::createPrescription');
    $routes->post('prescriptions/store', 'DoctorController::storePrescription');
    $routes->get('prescriptions/view/(:num)', 'DoctorController::viewPrescription/$1');
    $routes->get('prescriptions/edit/(:num)', 'DoctorController::editPrescription/$1');
    $routes->post('prescriptions/update/(:num)', 'DoctorController::updatePrescription/$1');
    $routes->get('prescriptions/delete/(:num)', 'DoctorController::deletePrescription/$1');
    
    $routes->get('lab', 'DoctorController::lab');
    $routes->get('lab/create', 'DoctorController::createLabRequest');
    $routes->post('lab/store', 'DoctorController::storeLabRequest');

    // Lab staff routes (when accessing /doctor/lab)
    $routes->get('lab/supplies', 'LabController::supplies');
    $routes->get('lab/supplies/create', 'LabController::addSupply');
    $routes->post('lab/supplies/store', 'LabController::storeSupply');
    $routes->get('lab/supplies/edit/(:num)', 'LabController::editSupply/$1');
    $routes->post('lab/supplies/update/(:num)', 'LabController::updateSupply/$1');
    $routes->get('lab/supplies/delete/(:num)', 'LabController::deleteSupply/$1');
    $routes->get('lab/requests', 'LabController::requests');
    $routes->get('lab/requests/view/(:num)', 'LabController::viewRequest/$1');
    $routes->post('lab/requests/status/(:num)', 'LabController::updateRequestStatus/$1');
    $routes->get('lab/results', 'LabController::results');
    $routes->get('lab/results/add/(:num)', 'LabController::addResult/$1');
    $routes->post('lab/results/store', 'LabController::storeResult');
});

// NURSE ROUTES
$routes->group('nurse', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'NurseController::index');
    $routes->get('dashboard', 'NurseController::dashboard');
    
    // Medication Management
    $routes->post('medication/update-status', 'NurseController::updateMedicationStatus');
    
    // Patient Management
    $routes->group('patients', function($routes) {
        $routes->get('/', 'NurseController::patients');
        $routes->get('create', 'NurseController::createPatient');
        $routes->post('store', 'NurseController::storePatient');
        $routes->get('edit/(:num)', 'NurseController::editPatient/$1');
        $routes->post('update/(:num)', 'NurseController::updatePatient/$1');
        $routes->get('view/(:num)', 'NurseController::viewPatient/$1');
        // Move complete-task before vitals to avoid route conflicts
        $routes->post('complete-task/(:num)', 'NurseController::completeTask/$1');
        $routes->get('vitals/(:num)', 'NurseController::updateVitals/$1');
        $routes->post('vitals/(:num)/save', 'NurseController::saveVitals/$1');
        $routes->get('search', 'NurseController::searchPatients');
    });
    
    // Appointment Management
    $routes->group('appointments', function($routes) {
        $routes->get('/', 'NurseController::appointments');
        $routes->get('create', 'NurseController::createAppointment');
        $routes->post('store', 'NurseController::storeAppointment');
        $routes->get('edit/(:num)', 'NurseController::editAppointment/$1');
        $routes->post('update/(:num)', 'NurseController::updateAppointment/$1');
        $routes->get('view/(:num)', 'NurseController::viewAppointment/$1');
        $routes->post('status/(:num)', 'NurseController::updateAppointmentStatus/$1');
        $routes->get('search', 'NurseController::searchAppointments');
    });
    
    // Medication Management
    $routes->group('medications', function($routes) {
        $routes->get('/', 'NurseController::medications');
        $routes->get('view/(:num)', 'NurseController::viewMedication/$1');
    });
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
    $routes->get('supplies', 'LabController::supplies');
    $routes->get('supplies/create', 'LabController::addSupply');
    $routes->post('supplies/store', 'LabController::storeSupply');
    $routes->get('supplies/edit/(:num)', 'LabController::editSupply/$1');
    $routes->post('supplies/update/(:num)', 'LabController::updateSupply/$1');
    $routes->get('supplies/delete/(:num)', 'LabController::deleteSupply/$1');
    $routes->get('requests', 'LabController::requests');
    $routes->get('requests/view/(:num)', 'LabController::viewRequest/$1');
    $routes->post('requests/status/(:num)', 'LabController::updateRequestStatus/$1');
    $routes->get('results', 'LabController::results');
    $routes->get('results/view/(:num)', 'LabController::viewResult/$1');
    $routes->get('results/add/(:num)', 'LabController::addResult/$1');
    $routes->post('results/store', 'LabController::storeResult');
});

// PHARMACY ROUTES
$routes->group('pharmacy', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'PharmacyController::index');
    $routes->get('dashboard', 'PharmacyController::dashboard');
    $routes->get('medicines', 'PharmacyController::medicines');
    $routes->get('medicines/create', 'PharmacyController::addMedicine');
    $routes->post('medicines/store', 'PharmacyController::storeMedicine');
    $routes->get('medicines/edit/(:num)', 'PharmacyController::editMedicine/$1');
    $routes->post('medicines/update/(:num)', 'PharmacyController::updateMedicine/$1');
    $routes->get('medicines/delete/(:num)', 'PharmacyController::deleteMedicine/$1');
    $routes->get('prescriptions', 'PharmacyController::prescriptions');
    $routes->get('prescriptions/dispense/(:num)', 'PharmacyController::dispensePrescription/$1');
});

// ACCOUNTANT ROUTES
$routes->group('accountant', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'AccountantController::index');
    $routes->get('billing', 'AccountantController::billing');
    $routes->get('manage-bills', 'AccountantController::manageBills');
    $routes->get('reports', 'AccountantController::reports');

    // Bill Management
    $routes->get('bills/create', 'AccountantController::createBill');
    $routes->post('bills/store', 'AccountantController::storeBill');
    $routes->get('bills/edit/(:num)', 'AccountantController::editBill/$1');
    $routes->post('bills/update/(:num)', 'AccountantController::updateBill/$1');
    $routes->get('bills/delete/(:num)', 'AccountantController::deleteBill/$1');
    $routes->get('bills/invoice/(:num)', 'AccountantController::createInvoice/$1');
    $routes->get('bills/payment/(:num)', 'AccountantController::recordPayment/$1');
    $routes->post('payments/store', 'AccountantController::storePayment');
});

// IT STAFF ROUTES
$routes->group('itstaff', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'ItStaffController::index');
    $routes->get('userAccounts', 'ItStaffController::userAccounts');
    $routes->get('logs', 'ItStaffController::logs');
    $routes->get('backups', 'ItStaffController::backups');
    $routes->get('settings', 'ItStaffController::settings');
});

