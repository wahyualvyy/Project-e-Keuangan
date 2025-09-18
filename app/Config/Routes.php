<?php

use App\Controllers\AuthController;
use App\Controllers\GuruController;
use App\Controllers\JurusanController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =============================================================================
// PUBLIC ROUTES (Guest Only)
// =============================================================================
$routes->group('', ['filter' => 'guest'], function($routes) {
    $routes->get('/', 'AuthController::index');
    $routes->post('/login', 'AuthController::login');
});

// =============================================================================
// AUTH ROUTES
// =============================================================================
$routes->get('/logout', 'AuthController::logout', ['filter' => 'auth']);

// =============================================================================
// ADMIN ROUTES (Protected by Auth Middleware)
// =============================================================================
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    
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
    $routes->group('guru', function($routes) {
        $routes->get('/', 'GuruController::index'); // /admin/guru
        $routes->get('data', 'AdminController::dataGuru'); // /admin/guru/data
        $routes->get('input', 'AdminController::inputGuru'); // /admin/guru/input
        $routes->post('create', 'GuruController::create'); // /admin/guru/create
        $routes->get('edit/(:num)', 'GuruController::edit/$1'); // /admin/guru/edit/1
        $routes->post('update/(:num)', 'GuruController::update/$1'); // /admin/guru/update/1
        $routes->get('delete/(:num)', 'GuruController::delete/$1'); // /admin/guru/delete/1
        $routes->post('bulk-action', 'GuruController::bulkAction'); // /admin/guru/bulk-action
    });
    
    // Data Siswa Routes
    $routes->group('siswa', function($routes) {
        $routes->get('/', 'AdminController::dataSiswa'); // /admin/siswa
        $routes->get('data', 'AdminController::dataSiswa'); // /admin/siswa/data
        $routes->get('input', 'AdminController::inputSiswa'); // /admin/siswa/input
        // Add CRUD operations for Siswa here if needed
    });
    
    // Data Kelas Routes
    $routes->group('kelas', function($routes) {
        $routes->get('/', 'AdminController::dataKelas'); // /admin/kelas
        $routes->get('data', 'AdminController::dataKelas'); // /admin/kelas/data
        $routes->get('input', 'AdminController::inputKelas'); // /admin/kelas/input
        // Add CRUD operations for Kelas here if needed
    });
    
    // Data Jurusan Routes
    $routes->group('jurusan', function($routes) {
        $routes->get('/', 'JurusanController::index'); // /admin/jurusan
        $routes->get('data', 'JurusanController::index'); // /admin/jurusan/data
        $routes->get('input', 'JurusanController::InputJurusan'); // /admin/jurusan/input
        $routes->post('create', 'JurusanController::create'); // /admin/jurusan/create
        $routes->get('edit/(:num)', 'JurusanController::edit/$1'); // /admin/jurusan/edit/1
        $routes->post('update/(:num)', 'JurusanController::update/$1'); // /admin/jurusan/update/1
        $routes->get('delete/(:num)', 'JurusanController::delete/$1'); // /admin/jurusan/delete/1
        $routes->post('bulk-action', 'JurusanController::bulkAction'); // /admin/jurusan/bulk-action
    });
    
    // =======================================================================
    // KAS MANAGEMENT ROUTES
    // =======================================================================
    
    // Data Kas Routes
    $routes->group('data-kas', function($routes) {
        // SPP
        $routes->get('spp', 'AdminController::dataKasSpp');
        $routes->get('input-spp', 'AdminController::inputKasSpp');
        
        // Semester
        $routes->get('semester', 'AdminController::dataKasSemester');
        $routes->get('input-semester', 'AdminController::inputKasSemester');
        
        // Gaji
        $routes->get('gaji', 'AdminController::dataKasGaji');
        $routes->get('input-gaji', 'AdminController::inputKasGaji');
    });
    
    // Kas Masuk Routes
    $routes->group('kas-masuk', function($routes) {
        // SPP
        $routes->get('spp', 'AdminController::kasSpp');
        $routes->get('spp/detail', 'AdminController::kasSppDetail');
        
        // Semester
        $routes->get('semester', 'AdminController::kasSemester');
        $routes->get('semester/detail', 'AdminController::kasSemesterDetail');
        
        // Pemasukan
        $routes->get('pemasukan', 'AdminController::kasPemasukan');
        $routes->get('input-pemasukan', 'AdminController::inputKasPemasukan');
    });
    
    // Kas Keluar Routes
    $routes->group('kas-keluar', function($routes) {
        // Gaji
        $routes->get('gaji', 'AdminController::kasGaji');
        $routes->get('gaji/detail', 'AdminController::kasGajiDetail');
        
        // Pengeluaran
        $routes->get('pengeluaran', 'AdminController::kasPengeluaran');
        $routes->get('input-pengeluaran', 'AdminController::inputKasPengeluaran');
    });
    
    // =======================================================================
    // LEGACY ROUTES (For Backward Compatibility)
    // =======================================================================
    
    // Keep old routes for backward compatibility
    $routes->get('data-guru', 'GuruController::index');
    $routes->get('input-guru', 'AdminController::inputGuru');
    $routes->get('data-siswa', 'AdminController::dataSiswa');
    $routes->get('input-siswa', 'AdminController::inputSiswa');
    $routes->get('data-kelas', 'AdminController::dataKelas');
    $routes->get('input-kelas', 'AdminController::inputKelas');
    $routes->get('data-jurusan', 'JurusanController::index');
    $routes->get('input-jurusan', 'JurusanController::InputJurusan');
    $routes->post('input-jurusan-create', 'JurusanController::create');
    $routes->get('edit-jurusan/(:num)', 'JurusanController::edit/$1');
    $routes->post('update-jurusan/(:num)', 'JurusanController::update/$1');
    $routes->get('delete-jurusan/(:num)', 'JurusanController::delete/$1');
    $routes->post('jurusan/bulk-action', 'JurusanController::bulkAction');
    
    // Legacy Kas routes
    $routes->get('data-kas-spp', 'AdminController::dataKasSpp');
    $routes->get('input-data-kas-spp', 'AdminController::inputKasSpp');
    $routes->get('data-kas-semester', 'AdminController::dataKasSemester');
    $routes->get('input-data-kas-semester', 'AdminController::inputKasSemester');
    $routes->get('data-kas-gaji', 'AdminController::dataKasGaji');
    $routes->get('input-data-kas-gaji', 'AdminController::inputKasGaji');
    $routes->get('kas-spp', 'AdminController::kasSpp');
    $routes->get('kas-spp/detail', 'AdminController::kasSppDetail');
    $routes->get('kas-semester', 'AdminController::kasSemester');
    $routes->get('kas-semester/detail', 'AdminController::kasSemesterDetail');
    $routes->get('kas-pemasukan', 'AdminController::kasPemasukan');
    $routes->get('input-kas-pemasukan', 'AdminController::inputKasPemasukan');
    $routes->get('kas-gaji', 'AdminController::kasGaji');
    $routes->get('kas-gaji/detail', 'AdminController::kasGajiDetail');
    $routes->get('kas-pengeluaran', 'AdminController::kasPengeluaran');
    $routes->get('input-kas-pengeluaran', 'AdminController::inputKasPengeluaran');
});

// =============================================================================
// API ROUTES (Optional - for AJAX requests)
// =============================================================================
$routes->group('api', ['filter' => 'auth'], function($routes) {
    $routes->group('admin', function($routes) {
        // API endpoints for AJAX calls
        $routes->post('guru/store', 'GuruController::apiStore');
        $routes->post('jurusan/store', 'JurusanController::apiStore');
        // Add more API endpoints as needed
    });
});

// =============================================================================
// ERROR ROUTES
// =============================================================================
$routes->set404Override(function() {
    return view('errors/html/error_404', [
        'message' => 'Halaman yang Anda cari tidak ditemukan.'
    ]);
});