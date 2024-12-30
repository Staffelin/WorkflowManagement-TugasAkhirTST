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
$routes->setDefaultController('DashboardController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Authentication Routes
$routes->group('auth', function ($routes) {
    $routes->get('login', 'UserController::showLogin');
    $routes->get('register', 'UserController::showRegister');
    $routes->post('login', 'UserController::login');
    $routes->post('register', 'UserController::register');
    $routes->get('logout', 'UserController::logout');
});

// Dashboard Route
$routes->get('dashboard', 'DashboardController::index');

// Articles Routes (using ResourceController)
$routes->resource('articles', [
    'controller' => 'ArticleController',
]);

// Workflows Routes (using ResourceController)
$routes->resource('workflows', [
    'controller' => 'WorkflowController',
]);

// Tasks Routes
$routes->group('tasks', function ($routes) {
    $routes->get('/', 'TaskController::index');
    $routes->get('create', 'TaskController::create');
    $routes->post('store', 'TaskController::store');
    $routes->get('edit/(:num)', 'TaskController::edit/$1');
    $routes->post('update/(:num)', 'TaskController::update/$1');
    $routes->post('delete/(:num)', 'TaskController::delete/$1');
    $routes->get('(:num)', 'TaskController::show/$1');
});

// Approvals Routes
$routes->group('approvals', function ($routes) {
    $routes->get('/', 'ApprovalController::index');
    $routes->get('create', 'ApprovalController::create');
    $routes->post('store', 'ApprovalController::store');
    $routes->get('edit/(:num)', 'ApprovalController::edit/$1');
    $routes->post('update/(:num)', 'ApprovalController::update/$1');
    $routes->get('(:num)', 'ApprovalController::show/$1');
});

// Settings Routes
$routes->group('settings', function ($routes) {
    $routes->get('/', 'SettingsController::index');
    $routes->post('update/(:num)', 'SettingsController::update/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
