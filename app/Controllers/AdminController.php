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
        return view( 'admin/dashboard', $data);
    }
    public function DataGuru()
    {
        $data = [
            "title" => "Data Guru"
        ];
        return view( 'admin/data-tabel/data-guru', $data);
    }
    public function InputGuru()
    {
        $data = [
            "title" => "Input Data Guru"
        ];
        return view( 'admin/data-tabel/input-guru', $data);
    }
    public function DataSiswa()
    {
        $data = [
            "title" => "Data Siswa"
        ];
        return view( 'admin/data-tabel/data-siswa', $data);
    }
    public function InputSiswa()
    {
        $data = [
            "title" => "Input Data Siswa"
        ];
        return view( 'admin/data-tabel/input-siswa', $data);
    }
    public function DataKelas()
    {
        $data = [
            "title" => "Data Kelas"
        ];
        return view( 'admin/data-tabel/data-kelas', $data);
    }
    public function InputKelas()
    {
        $data = [
            "title" => "Input Data Kelas"
        ];
        return view( 'admin/data-tabel/input-kelas', $data);
    }
    public function DataKasSpp()
    {
        $data = [
            "title" => "Data Kas SPP"
        ];
        return view( 'admin/data-kas/data-kas-spp', $data);
    }
    public function InputKasSpp()
    {
        $data = [
            "title" => "Input Data Kas SPP"
        ];
        return view( 'admin/data-kas/input-data-kas-spp', $data);
    }
    public function DataKasSemester()
    {
        $data = [
            "title" => "Data Kas Semester"
        ];
        return view( 'admin/data-kas/data-kas-semester', $data);
    }
    public function InputKasSemester()
    {
        $data = [
            "title" => "Input Data Kas Semester"
        ];
        return view( 'admin/data-kas/input-data-kas-semester', $data);
    }
    public function DataKasGaji()
    {
        $data = [
            "title" => "Data Kas Gaji"
        ];
        return view( 'admin/data-kas/data-kas-gaji', $data);
    }
    public function InputKasGaji()
    {
        $data = [
            "title" => "Input Data Kas Gaji"
        ];
        return view( 'admin/data-kas/input-data-kas-gaji', $data);
    }
    public function KasSpp()
    {
        $data = [
            "title" => "Kas SPP"
        ];
        return view( 'admin/kas-masuk/kas-spp', $data);
    }
    public function KasSppDetail()
    {
        $data = [
            "title" => "Kas SPP Detail"
        ];
        return view( 'admin/kas-masuk/kas-spp-detail', $data);
    }
    public function KasSemester()
    {
        $data = [
            "title" => "Kas Semester"
        ];
        return view( 'admin/kas-masuk/kas-semester', $data);
    }
    public function KasSemesterDetail()
    {
        $data = [
            "title" => "Kas Semester Detail"
        ];
        return view( 'admin/kas-masuk/kas-semester-detail', $data);
    }
    public function KasPemasukan()
    {
        $data = [
            "title" => "Data Kas Pemasukan"
        ];
        return view( 'admin/kas-masuk/kas-pemasukan', $data);
    }
    public function InputKasPemasukan()
    {
        $data = [
            "title" => "Input Data Kas Pemasukan"
        ];
        return view( 'admin/kas-masuk/input-kas-pemasukan', $data);
    }
    public function KasGaji()
    {
        $data = [
            "title" => "Kas Gaji"
        ];
        return view( 'admin/kas-keluar/kas-gaji', $data);
    }
    public function KasPengeluaran()
    {
        $data = [
            "title" => "Data Kas Pengeluaran"
        ];
        return view( 'admin/kas-keluar/kas-pengeluaran', $data);
    }
    public function InputKasPengeluaran()
    {
        $data = [
            "title" => "Input Data Kas Pengeluaran"
        ];
        return view( 'admin/kas-keluar/input-kas-pengeluaran', $data);
    }
}
