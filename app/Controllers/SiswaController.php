<?php

namespace App\Controllers;


use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\JurusanModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SiswaController extends BaseController
{
    protected $siswaModel;
    protected $jurusanModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->siswaModel = new siswaModel();
        $this->jurusanModel = new JurusanModel();
        $this->kelasModel = new KelasModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Siswa',
            'siswa' => $this->siswaModel->getSiswaWithAllData()
        ];
        return view('admin/data-tabel/data-siswa', $data);
    }

    public function input()
    {
        $data = [
            'title' => 'Input Data Siswa',
            'kelas' => $this->kelasModel->getKelasWithRelations(),
            'jurusan' => $this->kelasModel->getJurusanFromKelas()
        ];
        return view('admin/data-tabel/input-siswa', $data);
    }
    
}
