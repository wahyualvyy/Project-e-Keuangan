<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('Data-guru', 'AdminController::DataGuru');
});


