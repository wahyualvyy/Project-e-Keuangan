<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanModel;
use CodeIgniter\HTTP\ResponseInterface;

class JurusanController extends BaseController
{
    protected $JurusanModel;

    public function __construct()
    {
        $this->JurusanModel = new JurusanModel();
    }
    public function index()
    {
        $data = [
            "title" => "Data Jurusan",
            "jurusan" => $this->JurusanModel->findAll()
        ];

        return view('admin/data-tabel/data-jurusan', $data);
    }
    public function InputJurusan()
    {
        $data = [
            "title" => "Input Jurusan"
        ];

        return view('admin/data-tabel/input-jurusan', $data);
    }

    public function create()
    {
        $rules = [
            'nama_jurusan' => ['required','max_length[100]'],
            'keterangan' => ['required','max_length[255]']
        ];

        if(! $this->val)
    }
}
