<?php

namespace App\Controllers;

use App\Models\JurusanModel;
use App\Models\SemesterModel;
use App\Controllers\BaseController;
use App\Controllers\JurusanController;
use CodeIgniter\HTTP\ResponseInterface;

class SemesterController extends BaseController
{
    protected $semesterModel;
    protected $jurusanModel;
    public function __construct()
    {
        $this->semesterModel = new SemesterModel();
        $this->jurusanModel = new JurusanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Semester',
            'semester' => $this->semesterModel->getWithRealtion(),
        ];

        return view('admin/data-kas/data-kas-semester', $data);
    }

    public function inputSemester()
    {
        $data = [
            'title' => 'Input Data Semester',
            'jurusan' => $this->jurusanModel->findAll()
        ];

        return view('admin/Inputs/input-data-kas-semester', $data);
    }

    public function createSemester()
    {
        $rules = [
            'tahun-ajaran1' => [
                'label' => 'Tahun Ajaran Pertama',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
                'tahun-ajaran2' => [
                    'label' => 'Tahun Ajaran Kedua',
                    'rules' => 'required|numeric|greater_than[tahun-ajaran1]',
                    'errors' => [
                        'required' => '{field} wajib diisi.',
                        'numeric' => '{field} harus berupa angka.',
                        'greater_than' => '{field} harus lebih besar dari Tahun Ajaran Pertama.',
                    ],
                ],
                'biaya-semester' => [
                    'label' => 'Biaya Semester',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} wajib diisi.',
                        'numeric' => '{field} harus berupa angka.',
                    ],
                ],
                'status' => [
                    'label' => 'Status',
                    'rules' => 'required|in_list[Aktif,Tidak Aktif]',
                    'errors' => [
                        'required' => '{field} wajib diisi.',
                        'in_list' => '{field} harus bernilai Aktif atau Tidak Aktif.',
                    ],
                ],
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $tahunAjaran1 = $this->request->getPost('tahun-ajaran1');
        $tahunAjaran2 = $this->request->getPost('tahun-ajaran2');
        $tahunAjaran = $tahunAjaran1 . '/' . $tahunAjaran2;

        $data = [
            'tahun_ajaran' => $tahunAjaran,
            'id_jurusan' => $this->request->getPost('id_jurusan'),
            'nominal' => $this->request->getPost('biaya_semester'),
            'status' => $this->request->getPost('status'),
        ];
        $this->semesterModel->insert($data);
        return redirect()->to('/data-kas/semester')->with('success', 'Data semester berhasil ditambahkan.');
    }

    public function editSemester($id)
    {
        $semester = $this->semesterModel->find($id);
        if (!$semester) {
            return redirect()->to('/data-kas/semester')->with('error', 'Data semester tidak ditemukan.');
        }

        list($tahunAjaran1, $tahunAjaran2) = explode('/', $semester['tahun_ajaran']);

        $data = [
            'title' => 'Edit Data Semester',
            'semester' => $semester,
            'jurusan' => $this->jurusanModel->findAll(),
            'tahunAjaran1' => $tahunAjaran1,
            'tahunAjaran2' => $tahunAjaran2,
        ];

        return view('admin/Edits/edit-data-kas-semester', $data);
    }
}
