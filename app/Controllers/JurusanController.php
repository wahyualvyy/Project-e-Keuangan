<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanModel;
use CodeIgniter\HTTP\ResponseInterface;

class JurusanController extends BaseController
{
    public function index()
    {
        $jurusan = new JurusanModel();
        $data = [
            "title" => "Data Jurusan",
            "jurusan" => $jurusan->findAll()
        ];

        return view('admin/data-tabel/data-jurusan', $data);
    }
}
