<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', [AuthController::class, 'login']);
$routes->get('/register', [AuthController::class, 'register']);
$routes->post('/create', [AuthController::class, 'create']);
$routes->get('/forgot-password', [AuthController::class, 'resetPassword']);
$routes->post('auth', [AuthController::class, 'authUser'] );
$routes->get('/logout', [AuthController::class, 'logout'] );

$routes->group('dashboard', ['filter' => 'auth'], function($routes) {
    $routes->get('/', [DashboardController::class, 'index']);
    $routes->get('users', [DashboardController::class, 'newUser']);
    $routes->post('users/store-customer', [DashboardController::class, 'storeCustomer']);
    $routes->get('users/edit-customer/(:num)', [DashboardController::class, 'editCustomer']);
    $routes->post('users/update-customer/(:num)', [DashboardController::class, 'updateCustomer']);
    $routes->get('users/delete-customer/(:num)', [DashboardController::class, 'deleteCustomer']);
});
