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
    public function DataKasSemester()
    {
        $data = [
            "title" => "Data Kas Semester"
        ];
        return view('admin/data-kas/data-kas-semester', $data);
    }
    public function InputKasSemester()
    {
        $data = [
            "title" => "Input Data Kas Semester"
        ];
        return view('admin/data-kas/input-data-kas-semester', $data);
    }
    public function DataKasGaji()
    {
        $data = [
            "title" => "Data Kas Gaji"
        ];
        return view('admin/data-kas/data-kas-gaji', $data);
    }
    public function InputKasGaji()
    {
        $data = [
            "title" => "Input Data Kas Gaji"
        ];
        return view('admin/data-kas/input-data-kas-gaji', $data);
    }
    public function KasSpp()
    {
        $data = [
            "title" => "Kas SPP"
        ];
        return view('admin/kas-masuk/kas-spp', $data);
    }
    public function KasSppDetail()
    {
        $data = [
            "title" => "Kas SPP Detail"
        ];
        return view('admin/kas-masuk/kas-spp-detail', $data);
    }
    public function KasSemester()
    {
        $data = [
            "title" => "Kas Semester"
        ];
        return view('admin/kas-masuk/kas-semester', $data);
    }
    public function KasSemesterDetail()
    {
        $data = [
            "title" => "Kas Semester Detail"
        ];
        return view('admin/kas-masuk/kas-semester-detail', $data);
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
    public function KasGaji()
    {
        $data = [
            "title" => "Kas Gaji"
        ];
        return view('admin/kas-keluar/kas-gaji', $data);
    }
    public function KasGajiDetail()
    {
        $data = [
            "title" => "Kas Gaji Detail"
        ];
        return view('admin/kas-keluar/kas-gaji-detail', $data);
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
