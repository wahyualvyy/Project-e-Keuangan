<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        $data = [
            "title" => "Dasboard Admin"
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
