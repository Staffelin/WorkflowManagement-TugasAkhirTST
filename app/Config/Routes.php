<?php

namespace Config;

$routes = Services::routes();

// Load the system's routing file first, so the app and ENVIRONMENT can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('UserController'); // Set UserController as the default controller
$routes->setDefaultMethod('showLogin'); // Set the default method to showLogin
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Redirect root URL to auth/login
$routes->get('/', 'UserController::showLogin');

// Debugging: Clear session route
$routes->get('/clear-session', function () {
    session()->destroy();
    return 'Session cleared.';
});

// Authentication Routes
$routes->group('auth', function ($routes) {
    $routes->get('login', 'UserController::showLogin');
    $routes->get('register', 'UserController::showRegister');
    $routes->post('login', 'UserController::login');
    $routes->post('register', 'UserController::register');
    $routes->get('logout', 'UserController::logout');
});

// Dashboard Route
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

// Articles Routes (using ResourceController)
$routes->resource('articles', [
    'controller' => 'ArticleController',
    'filter' => 'auth',
]);

// Workflows Routes (using ResourceController)
$routes->resource('workflows', [
    'controller' => 'WorkflowController',
    'filter' => 'auth',
]);

// Profile Page Routes
$routes->get('/profile', 'UserController::profile', ['filter' => 'auth']);
$routes->post('/profile/update', 'UserController::updateProfile', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
