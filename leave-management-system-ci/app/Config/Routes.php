<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', function() {
    return redirect()->to('login');
});

// Auth Routes
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::authenticate');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::store');
$routes->get('logout', 'Auth::logout');

$routes->get('profile', 'Auth::profile');
$routes->get('change-password', 'Auth::changePassword');
$routes->post('change-password', 'Auth::changePassword');

// Dashboard
$routes->get('dashboard', 'Dashboard::index');

// Leave Request Routes
$routes->group('leave-request', function($routes) {
    $routes->get('create', 'LeaveRequest::create');
    $routes->post('store', 'LeaveRequest::store');
    $routes->post('approve/(:num)', 'LeaveRequest::approve/$1');
    $routes->post('reject/(:num)', 'LeaveRequest::reject/$1');
    $routes->get('view/(:num)', 'LeaveRequest::view/$1', ['filter' => 'auth']);
});

// Leave Type Routes (Admin only)
$routes->group('leave-types', function($routes) {
    $routes->get('/', 'LeaveType::index');
    $routes->get('create', 'LeaveType::create');
    $routes->post('store', 'LeaveType::store');
    $routes->get('edit/(:num)', 'LeaveType::edit/$1');
    $routes->post('update/(:num)', 'LeaveType::update/$1');
    $routes->post('delete/(:num)', 'LeaveType::delete/$1');
});

$routes->get('admin/activate/(:num)', 'Admin::activate/$1');
$routes->get('admin/deactivate/(:num)', 'Admin::deactivate/$1');
$routes->get('admin/edit/(:num)', 'Admin::edit/$1', ['filter' => 'auth']);
$routes->post('admin/update/(:num)', 'Admin::update/$1', ['filter' => 'auth']);
$routes->get('admin/delete/(:num)', 'Admin::delete/$1', ['filter' => 'auth']);