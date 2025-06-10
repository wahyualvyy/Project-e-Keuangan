<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('data-guru', 'AdminController::DataGuru');
    $routes->get('input-guru', 'AdminController::InputGuru');
    $routes->get('data-siswa', 'AdminController::DataSiswa');
    $routes->get('input-siswa', 'AdminController::InputSiswa');
    $routes->get('data-kelas', 'AdminController::DataKelas');
    $routes->get('input-kelas', 'AdminController::InputKelas');
});


