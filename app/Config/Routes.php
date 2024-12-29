<?php

namespace Config;

// Create a new instance of our RouteCollection class.
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
    $routes->post('login', 'AuthController::login');
    $routes->post('register', 'AuthController::register');
    $routes->get('logout', 'AuthController::logout');
});

// Dashboard
$routes->get('dashboard', 'DashboardController::index');

// Articles
$routes->group('articles', function ($routes) {
    $routes->get('', 'ArticleController::index');
    $routes->get('create', 'ArticleController::create');
    $routes->post('store', 'ArticleController::store');
    $routes->get('edit/(:num)', 'ArticleController::edit/$1');
    $routes->post('update/(:num)', 'ArticleController::update/$1');
    $routes->post('delete/(:num)', 'ArticleController::delete/$1');
    $routes->get('(:num)', 'ArticleController::show/$1');
});

// Workflows
$routes->group('workflows', function ($routes) {
    $routes->get('', 'WorkflowController::index');
    $routes->get('create', 'WorkflowController::create');
    $routes->post('store', 'WorkflowController::store');
    $routes->get('edit/(:num)', 'WorkflowController::edit/$1');
    $routes->post('update/(:num)', 'WorkflowController::update/$1');
    $routes->post('delete/(:num)', 'WorkflowController::delete/$1');
    $routes->get('(:num)', 'WorkflowController::show/$1');
});

// Tasks
$routes->group('tasks', function ($routes) {
    $routes->get('', 'TaskController::index');
    $routes->get('create', 'TaskController::create');
    $routes->post('store', 'TaskController::store');
    $routes->get('edit/(:num)', 'TaskController::edit/$1');
    $routes->post('update/(:num)', 'TaskController::update/$1');
    $routes->post('delete/(:num)', 'TaskController::delete/$1');
    $routes->get('(:num)', 'TaskController::show/$1');
});

// Approvals
$routes->group('approvals', function ($routes) {
    $routes->get('', 'ApprovalController::index');
    $routes->get('create', 'ApprovalController::create');
    $routes->post('store', 'ApprovalController::store');
    $routes->get('edit/(:num)', 'ApprovalController::edit/$1');
    $routes->post('update/(:num)', 'ApprovalController::update/$1');
    $routes->get('(:num)', 'ApprovalController::show/$1');
});

// Teams
$routes->group('teams', function ($routes) {
    $routes->get('', 'TeamController::index');
    $routes->get('create', 'TeamController::create');
    $routes->post('store', 'TeamController::store');
    $routes->get('edit/(:num)', 'TeamController::edit/$1');
    $routes->post('update/(:num)', 'TeamController::update/$1');
    $routes->post('delete/(:num)', 'TeamController::delete/$1');
    $routes->get('(:num)', 'TeamController::show/$1');
});

// Settings
$routes->group('settings', function ($routes) {
    $routes->get('', 'SettingsController::index');
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
