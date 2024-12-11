<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [AuthController::class, 'login']);
$routes->get('/cadastrar', [AuthController::class, 'register']);
$routes->post('/create', [AuthController::class, 'create']);
$routes->get('/forgot-password', [AuthController::class, 'resetPassword']);
$routes->post('auth', [AuthController::class, 'authUser'] );

$routes->group('dashboard', ['filter' => 'auth'], function($routes) {
    $routes->get('/', [DashboardController::class, 'index']);
    $routes->get('/users', [DashboardController::class, 'newUser']);
});
