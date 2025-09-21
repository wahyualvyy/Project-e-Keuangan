<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class KelasController extends BaseController
{

    protected $kelasModel;
    protected $jurusanModel;
    protected $guruModel;
    public function __construct()
    {
        // Load the KelasModel
        $this->kelasModel = new \App\Models\KelasModel();
        $this->jurusanModel = new \App\Models\JurusanModel();
        $this->guruModel = new \App\Models\GuruModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Kelas',
            'kelas' => $this->kelasModel->getKelasWithRelations()
        ];
        return view('admin/data-tabel/data-kelas', $data);
    }
    public function input()
    {
        $data = [
            'title' => 'Input Kelas',
            'jurusan' => $this->jurusanModel->findAll(),
            'guru' => $this->guruModel->findAll(),
        ];
        return view('admin/data-tabel/input-kelas', $data);
    }

    public function create()
    {
        $rules = [
            'nama_kelas' => [
                'label' => 'Nama Kelas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ]
            ],
            'id_jurusan' => [
                'label' => 'Nama Jurusan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ],
            ],
            'id_guru' => [
                'label' => 'Nama Wali',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $nama_kelas = $this->request->getPost('nama_kelas');
        $id_jurusan = $this->request->getPost('id_jurusan');

        $nama_jurusan = $this->jurusanModel->find($id_jurusan);


        $data = [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
            'id_jurusan' => $this->request->getPost('id_jurusan'),
            'id_guru' => $this->request->getPost('id_guru'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];
        $this->kelasModel->insert($data);
        return redirect()->to(base_url('kelas'))->with('success', 'Data kelas berhasil ditambahkan.')
        ;
    }
}
