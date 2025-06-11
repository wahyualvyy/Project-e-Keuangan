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
        return view( 'admin/data-guru', $data);
    }
    public function InputGuru()
    {
        $data = [
            "title" => "Input Data Guru"
        ];
        return view( 'admin/input-guru', $data);
    }
    public function DataSiswa()
    {
        $data = [
            "title" => "Data Siswa"
        ];
        return view( 'admin/data-siswa', $data);
    }
    public function InputSiswa()
    {
        $data = [
            "title" => "Input Data Siswa"
        ];
        return view( 'admin/input-siswa', $data);
    }
    public function DataKelas()
    {
        $data = [
            "title" => "Data Kelas"
        ];
        return view( 'admin/data-kelas', $data);
    }
    public function InputKelas()
    {
        $data = [
            "title" => "Input Data Kelas"
        ];
        return view( 'admin/input-kelas', $data);
    }
    public function DataKasSpp()
    {
        $data = [
            "title" => "Data Kas SPP"
        ];
        return view( 'admin/data-kas-spp', $data);
    }
    public function InputKasSpp()
    {
        $data = [
            "title" => "Input Data Kas SPP"
        ];
        return view( 'admin/input-data-kas-spp', $data);
    }
    public function DataKasPendaftaran()
    {
        $data = [
            "title" => "Data Kas Pendaftaran"
        ];
        return view( 'admin/data-kas-pendaftaran', $data);
    }
    public function InputKasPendaftaran()
    {
        $data = [
            "title" => "Input Data Kas Pendaftaran"
        ];
        return view( 'admin/input-data-kas-pendaftaran', $data);
    }
    public function DataKasGaji()
    {
        $data = [
            "title" => "Data Kas Gaji"
        ];
        return view( 'admin/data-kas-gaji', $data);
    }
    public function InputKasGaji()
    {
        $data = [
            "title" => "Input Data Kas Gaji"
        ];
        return view( 'admin/input-data-kas-gaji', $data);
    }
}
