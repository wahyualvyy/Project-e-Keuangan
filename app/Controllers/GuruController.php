<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use CodeIgniter\HTTP\ResponseInterface;

class GuruController extends BaseController
{
    public function index()
    {
        helper('text');
        $GuruModel = new GuruModel();

        $data = [
            'guru' => $GuruModel->getAllGuru(),
            "title" => "Data Guru"
        ];
        return view('admin/data-tabel/data-guru', $data);
    }
}
