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

