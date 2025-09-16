<?php

namespace App\Controllers;

use App\Models\JurusanModel;
use CodeIgniter\HTTP\Request;
use App\Controllers\BaseController;
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
        $sort = $this->request->getGet('sort') ?? 'terbaru';

        $jurusanData = $this->JurusanModel->getData($sort);

        $data = [
            "title" => "Data Jurusan",
            "jurusanData" => $jurusanData,
            "sort" => $sort
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
        // dd($this->request->getPost());
        $rules = [
            'nama_jurusan' => [
                'required',
                'max_length[100]',
                'is_unique[jurusan.nama_jurusan]',
                'errors' => [
                    'required' => 'Nama Jurusan wajib diisi.',
                    'is_unique' => 'Nama Jurusan ini sudah terdaftar, silakan gunakan nama lain.'
                ]
            ],
            'kode_jurusan' => [
                'is_unique[jurusan.kode_jurusan]',
                'errors' => [
                    'required'=> 'Kode Jurusan wajib diisi.',
                    'is_unique' => 'Kode Jurusan ini sudah terdaftar, silakan gunakan kode lain.'
                ]
                
            ],
            'keterangan' => ['required', 'max_length[255]']
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nama_jurusan' => $this->request->getPost('nama_jurusan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'kode_jurusan' => strtoupper(substr($this->request->getPost('nama_jurusan'), 0, 3)) . rand(100, 999),
        ];
        $this->JurusanModel->insert($data);
        return redirect()->to('/admin/data-jurusan')->with('success', 'Data Jurusan Berhasil Ditambahkan');
    }
    public function edit($id)
    {
        $jurusan = $this->JurusanModel->find($id);
        if (!$jurusan) {
            return redirect()->to('/admin/data-jurusan')->with('error', 'Data Jurusan Tidak Ditemukan');
        }

        $data = [
            "title" => "Edit Jurusan",
            "jurusan" => $jurusan
        ];

        return view('admin/edit-tabel/edit-jurusan', $data);
    }
    public function update($id)
    {
        $rules = [
            'nama_jurusan' => [
                'required',
                'max_length[100]',
                "is_unique[jurusan.nama_jurusan,id_jurusan,{$id}]",
                'errors' => [
                    'required' => 'Nama Jurusan wajib diisi.',
                    'is_unique' => 'Nama Jurusan ini sudah terdaftar, silakan gunakan nama lain.'
                ]
            ],
            'kode_jurusan' => [
                'is_unique[jurusan.kode_jurusan]',
                'errors' => [
                    'required'=> 'Kode Jurusan wajib diisi.',
                    'is_unique' => 'Kode Jurusan ini sudah terdaftar, silakan gunakan kode lain.'
                ]
                
            ],
            'keterangan' => ['required', 'max_length[255]']
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $KodeJurusanLamaArray = $this->JurusanModel->find($id);
        if (!$KodeJurusanLamaArray) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $KodeJurusanLamaString = $KodeJurusanLamaArray['kode_jurusan'];

        $KodeJurusanNumerik = substr($KodeJurusanLamaString,3);
        
        $StringKodeJurusan = strtoupper(substr($this->request->getPost('nama_jurusan'), 0, 3));

        $NewKodeJurusan = $StringKodeJurusan . $KodeJurusanNumerik ;
        
        $data = [
            'nama_jurusan' => $this->request->getPost('nama_jurusan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'kode_jurusan' => $NewKodeJurusan
        ];

        $this->JurusanModel->update($id, $data);
        return redirect()->to('/admin/data-jurusan')->with('success', 'Data Jurusan Berhasil Diperbarui');
    }
    public function delete($id)
    {
        $jurusan = $this->JurusanModel->find($id);
        if (!$jurusan) {
            return redirect()->to('/admin/data-jurusan')->with('error', 'Data Jurusan Tidak Ditemukan');
        }

        $this->JurusanModel->delete($id);
        return redirect()->to('/admin/data-jurusan')->with('success', 'Data Jurusan Berhasil Dihapus');
    }
    public function bulkAction()
    {
        $action = $this->request->getPost('aksi_massal');
        $jurusanIds = $this->request->getPost('jurusan_ids');

        if (empty($action) || empty($jurusanIds)) {
            return redirect()->to('/admin/data-jurusan')->with('error', 'Aksi atau data jurusan belum dipilih.');
        }

        switch ($action) {
            case 'hapus':
                $this->JurusanModel->delete($jurusanIds);
                return redirect()->to('/admin/data-jurusan')->with('success', 'Data jurusan yang dipilih berhasil dihapus.');
            default:
                return redirect()->to('/admin/data-jurusan')->with('error', 'Aksi tidak dikenali.');
        }
    }
}
