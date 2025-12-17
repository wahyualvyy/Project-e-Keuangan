<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();

        // ====== BULAN INI ======
        $bulan = date('m');
        $tahun = date('Y');

        $pemasukanBulanan = $transaksiModel->getTotalPemasukan($bulan, $tahun);
        $pengeluaranBulanan = $transaksiModel->getTotalPengeluaran($bulan, $tahun);

        // ====== TAHUN INI ======
        $pemasukanTahunan = $transaksiModel->getTotalPemasukan(null, $tahun);
        $pengeluaranTahunan = $transaksiModel->getTotalPengeluaran(null, $tahun);

        $data = [
            "title" => "Dashboard Admin",
            "pemasukanBulanan" => $pemasukanBulanan,
            "pengeluaranBulanan" => $pengeluaranBulanan,
            "pemasukanTahunan" => $pemasukanTahunan,
            "pengeluaranTahunan" => $pengeluaranTahunan,
        ];

        return view('admin/dashboard', $data);
    }
    public function profile()
    {
        $data = [
            "title" => "Profile Sekolah"
        ];
        return view('admin/profile', $data);
    }
    public function KasPemasukan()
    {
        $data = [
            "title" => "Data Kas Pemasukan"
        ];
        return view('admin/kas-masuk/kas-pemasukan', $data);
    }
    public function InputKasPemasukan()
    {
        $data = [
            "title" => "Input Data Kas Pemasukan"
        ];
        return view('admin/kas-masuk/input-kas-pemasukan', $data);
    }
    public function KasPengeluaran()
    {
        $data = [
            "title" => "Data Kas Pengeluaran"
        ];
        return view('admin/kas-keluar/kas-pengeluaran', $data);
    }
    public function InputKasPengeluaran()
    {
        $data = [
            "title" => "Input Data Kas Pengeluaran"
        ];
        return view('admin/kas-keluar/input-kas-pengeluaran', $data);
    }
}
