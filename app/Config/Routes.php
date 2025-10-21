<?php

use App\Controllers\AuthController;
use App\Controllers\GuruController;
use App\Controllers\JurusanController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ============================================================================
// AUTH ROUTES (Myth/Auth)
// ============================================================================
$routes->group('', ['namespace' => 'Myth\Auth\Controllers'], function ($routes) {
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');
    $routes->get('forgot', 'AuthController::forgotPassword');
    $routes->post('forgot', 'AuthController::attemptForgot');
    $routes->get('reset-password', 'AuthController::resetPassword');
    $routes->post('reset-password', 'AuthController::attemptReset');
});

// =============================================================================
// ADMIN ROUTES (Protected by login filter)
// =============================================================================
$routes->group('', ['filter' => 'login'], function ($routes) {
    // Dashboard
    $routes->get('/', 'AdminController::index');
    $routes->get('dashboard', 'AdminController::index');

    // Profile Management
    $routes->get('profile', 'AdminController::profile');
    $routes->post('profile/update', 'AdminController::updateProfile');

    // =======================================================================
    // DATA MANAGEMENT ROUTES
    // =======================================================================

    // Data Guru Routes
    $routes->group('guru', function ($routes) {
        $routes->get('/', 'GuruController::index');
        $routes->get('input', 'GuruController::Input');
        $routes->post('create', 'GuruController::create');
        $routes->get('edit/(:num)', 'GuruController::edit/$1');
        $routes->post('update/(:num)', 'GuruController::update/$1');
        $routes->get('delete/(:num)', 'GuruController::delete/$1');
        $routes->post('bulk-action', 'GuruController::bulkAction');
    });

    // Data Siswa Routes
    $routes->group('siswa', function ($routes) {
        $routes->get('/', 'SiswaController::index');
        $routes->get('input', 'SiswaController::Input');
        $routes->post('create', 'SiswaController::create');
        $routes->get('edit/(:num)', 'SiswaController::edit/$1');
        $routes->post('update/(:num)', 'SiswaController::update/$1');
        $routes->get('delete/(:num)', 'SiswaController::delete/$1');
        $routes->post('bulk-action', 'SiswaController::bulkAction');

    });

    // Data Kelas Routes
    $routes->group('kelas', function ($routes) {
        $routes->get('/', 'KelasController::index');
        $routes->get('input', 'KelasController::Input');
        $routes->post('create', 'KelasController::create');
        $routes->get('edit/(:num)', 'KelasController::edit/$1');
        $routes->post('update/(:num)', 'KelasController::update/$1');
        $routes->get('delete/(:num)', 'KelasController::delete/$1');
        $routes->post('bulk-action', 'KelasController::bulkAction');
    });

    // Data Jurusan Routes
    $routes->group('jurusan', function ($routes) {
        $routes->get('/', 'JurusanController::index');
        $routes->get('input', 'JurusanController::InputJurusan');
        $routes->post('create', 'JurusanController::create');
        $routes->get('edit/(:num)', 'JurusanController::edit/$1');
        $routes->post('update/(:num)', 'JurusanController::update/$1');
        $routes->get('delete/(:num)', 'JurusanController::delete/$1');
        $routes->post('bulk-action', 'JurusanController::bulkAction');
    });

    // =======================================================================
    // KAS MANAGEMENT ROUTES
    // =======================================================================
    $routes->group('data-kas', function ($routes) {
        $routes->get('spp', 'SppController::index');
        $routes->get('input-spp', 'SppController::inputSPP');
        $routes->post('create-spp', 'SppController::createSPP');
        $routes->get('edit-spp/(:num)', 'SppController::editSPP/$1');
        $routes->post('update-spp/(:num)', 'SppController::updateSPP/$1');
        $routes->get('delete-spp/(:num)', 'SppController::deleteSPP/$1');
        
        $routes->get('semester', 'SemesterController::index');
        $routes->get('input-semester', 'SemesterController::inputSemester');
        $routes->post('create-semester', 'SemesterController::createSemester');
        $routes->get('edit-semester/(:num)', 'SemesterController::editSemester/$1');
        $routes->post('update-semester/(:num)', 'SemesterController::updateSemester/$1');
        $routes->get('delete-semester/(:num)', 'SemesterController::deleteSemester/$1');

        $routes->get('input-semester', 'AdminController::inputKasSemester');
        $routes->get('gaji', 'AdminController::dataKasGaji');
        $routes->get('input-gaji', 'AdminController::inputKasGaji');
    });

    $routes->group('kas-masuk', function ($routes) {
        $routes->get('spp', 'SppController::SppMasuk');
        $routes->get('spp/detail/(:num)', 'SppController::SppDetail/$1');
        $routes->get('spp-delete/(:num)', 'SppController::deleteSPPMasuk/$1');
        $routes->get('semester', 'AdminController::kasSemester');
        $routes->get('semester/detail', 'AdminController::kasSemesterDetail');
        $routes->get('pemasukan', 'AdminController::kasPemasukan');
        $routes->get('input-pemasukan', 'AdminController::inputKasPemasukan');
    });

    $routes->group('kas-keluar', function ($routes) {
        $routes->get('gaji', 'AdminController::kasGaji');
        $routes->get('gaji/detail', 'AdminController::kasGajiDetail');
        $routes->get('pengeluaran', 'AdminController::kasPengeluaran');
        $routes->get('input-pengeluaran', 'AdminController::inputKasPengeluaran');
    });
});

// =============================================================================
// API ROUTES (Optional - for AJAX requests)
// =============================================================================
$routes->group('api', ['filter' => 'login'], function ($routes) {
    $routes->group('admin', function ($routes) {
        $routes->post('guru/store', 'GuruController::apiStore');
        $routes->post('jurusan/store', 'JurusanController::apiStore');
    });
});

// =============================================================================
// ERROR ROUTES
// =============================================================================
$routes->set404Override(function () {
    return view('errors/html/error_404', [
        'message' => 'Halaman yang Anda cari tidak ditemukan.'
    ]);
});
