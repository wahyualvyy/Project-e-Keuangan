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

        if(! $this->validate($rules)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nama_jurusan' => $this->request->getPost('nama_jurusan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'kode_jurusan' =>'KD-' . random_int(100, 999)
        ];
        $this->JurusanModel->insert($data);
        return redirect()->to('/admin/data-jurusan')->with('success', 'Data Jurusan Berhasil Ditambahkan');
    }
}
