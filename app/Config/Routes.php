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
    $routes->get('data-kas-spp', 'AdminController::DataKasSpp');
    $routes->get('input-data-kas-spp', 'AdminController::InputKasSpp');
    $routes->get('data-kas-semester', 'AdminController::DataKasSemester');
    $routes->get('input-data-kas-semester', 'AdminController::InputKasSemester');
    $routes->get('data-kas-gaji', 'AdminController::DataKasGaji');
    $routes->get('input-data-kas-gaji', 'AdminController::InputKasGaji');
    $routes->get('kas-spp', 'AdminController::KasSpp');
    $routes->get('kas-spp/detail', 'AdminController::KasSppDetail');
    $routes->get('kas-semester', 'AdminController::KasSemester');
    $routes->get('kas-semester/detail', 'AdminController::KasSemesterDetail');
    $routes->get('kas-pemasukan', 'AdminController::KasPemasukan');
    $routes->get('input-kas-pemasukan', 'AdminController::InputKasPemasukan');
    $routes->get('kas-gaji', 'AdminController::KasGaji');
    $routes->get('kas-gaji/detail', 'AdminController::KasGajiDetail');
    $routes->get('kas-pengeluaran', 'AdminController::KasPengeluaran');
    $routes->get('input-kas-pengeluaran', 'AdminController::InputKasPengeluaran');
});


