<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use CodeIgniter\HTTP\ResponseInterface;

class GuruController extends BaseController
{
    protected $GuruModel;

    public function __construct()
    {
        $this->GuruModel = new GuruModel();

        helper('text');
    }
    public function index()
    {
        $sort = $this->request->getGet('sort') ?? 'terbaru';

        $guru = $this->GuruModel->getData($sort);

        $data = [
            'guru' => $guru,
            "title" => "Data Guru",
            "sort" => $sort
        ];
        return view('admin/data-tabel/data-guru', $data);
    }

    public function Input()
    {
        $data = [
            "title" => "Input Data Guru"
        ];
        return view('admin/data-tabel/input-guru', $data);
    }

    public function create()
    {
        $rules = [
            'nama_guru' => [
                'required',
                'max_length[100]',
                'errors' => [
                    'required' => 'Nama Guru wajib diisi.'
                ]
            ],
            'jenis_kelamin' => [
                'required',
                'in_list[Laki-laki,Perempuan]',
                'errors' => [
                    'required' => 'Jenis Kelamin wajib diisi.',
                    'in_list' => 'Pilihan Jenis Kelamin tidak valid, Silakan pilih Laki-laki atau Perempuan.'
                ]
            ],
            'bidang_studi' => [
                'required',
                'max_length[100]',
                'errors' => [
                    'required' => 'Bidang Studi wajib diisi.'
                ]
            ],
            'alamat' => [
                'required',
                'max_length[255]',
                'errors' => [
                    'required' => 'Alamat wajib diisi.'
                ]
            ],
            'nip' => [
                'required',
                'is_unique[guru.nip]',
                'errors' => [
                    'required' => 'NIP wajib diisi.',
                    'is_unique' => 'NIP ini sudah terdaftar, silakan gunakan NIP lain.'
                ]
            ],
            'no_telp' => [
                'required',
                'max_length[15]',
                'errors' => [
                    'required' => 'Nomor Telepon wajib diisi.'
                ]
            ],
            'status' => [
                'required',
                'in_list[Aktif,Tidak Aktif,Cuti]',
                'errors' => [
                    'required' => 'Status wajib diisi.',
                    'in_list' => 'Pilihan Status tidak valid. silakan pilih Aktif, Tidak Aktif, atau Cuti.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_guru' => ucwords(strtolower($this->request->getPost('nama_guru'))),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'bidang_studi' => $this->request->getPost('bidang_studi'),
            'alamat' => ucwords(strtolower($this->request->getPost('alamat'))),
            'nip' => $this->request->getPost('nip'),
            'no_telp' => $this->request->getPost('no_telp'),
            'status' => $this->request->getPost('status')
        ];

        $this->GuruModel->insert($data);
        return redirect()->to('/guru')->with('success', 'Data Guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $guru = $this->GuruModel->find($id);
        if (!$guru) {
            return redirect()->to('guru')->with('error', 'Data Guru Tidak Ditemukan');
        }
        $data = [
            "title" => "Edit Guru",
            "guru" => $guru
        ];
        return view('admin/edit-tabel/edit-guru', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama_guru' => [
                'required',
                'max_length[100]',
                'errors' => [
                    'required' => 'Nama Guru wajib diisi.'
                ]
            ],
            'jenis_kelamin' => [
                'required',
                'in_list[Laki-laki,Perempuan]',
                'errors' => [
                    'required' => 'Jenis Kelamin wajib diisi.',
                    'in_list' => 'Pilihan Jenis Kelamin tidak valid, Silakan pilih Laki-laki atau Perempuan.'
                ]
            ],
            'bidang_studi' => [
                'required',
                'max_length[100]',
                'errors' => [
                    'required' => 'Bidang Studi wajib diisi.'
                ]
            ],
            'alamat' => [
                'required',
                'max_length[255]',
                'errors' => [
                    'required' => 'Alamat wajib diisi.'
                ]
            ],
            'nip' => [
                'required',
                "is_unique[guru.nip,id_guru,{$id}]",
                'errors' => [
                    'required' => 'NIP wajib diisi.',
                    'is_unique' => 'NIP ini sudah terdaftar, silakan gunakan NIP lain.'
                ]
            ],
            'no_telp' => [
                'required',
                'max_length[15]',
                'errors' => [
                    'required' => 'Nomor Telepon wajib diisi.'
                ]
            ],
            'status' => [
                'required',
                'in_list[Aktif,Tidak Aktif,Cuti]',
                'errors' => [
                    'required' => 'Status wajib diisi.',
                    'in_list' => 'Pilihan Status tidak valid. silakan pilih Aktif, Tidak Aktif, atau Cuti.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_guru' => ucwords(strtolower($this->request->getPost('nama_guru'))),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'bidang_studi' => $this->request->getPost('bidang_studi'),
            'alamat' => ucwords(strtolower($this->request->getPost('alamat'))),
            'nip' => $this->request->getPost('nip'),
            'no_telp' => $this->request->getPost('no_telp'),
            'status' => $this->request->getPost('status')
        ];
        $this->GuruModel->update($id, $data);
        return redirect()->to('/guru')->with('success', 'Data Guru berhasil diperbarui.');

    }

    public function delete($id)
    {
        $guru = $this->GuruModel->find($id);
        if (!$guru) {
            return redirect()->to('guru')->with('error', 'Data Guru Tidak Ditemukan');
        }

        $this->GuruModel->delete($id);
        return redirect()->to('guru')->with('success', 'Data Guru Berhasil Dihapus');
    }

    public function bulkAction()
    {
        $action = $this->request->getPost('aksi_massal');
        $guruIds = $this->request->getPost('guru_ids');

        if (empty($action) || empty($guruIds)) {
            return redirect()->to('guru/')->with('error', 'Aksi atau data guru belum dipilih.');
        }

        switch ($action) {
            case 'hapus':
                $this->GuruModel->delete($guruIds);
                return redirect()->to('guru/')->with('success', 'Data guru yang dipilih berhasil dihapus.');
            default:
                return redirect()->to('guru/')->with('error', 'Aksi tidak dikenali.');
        }
    }
}
