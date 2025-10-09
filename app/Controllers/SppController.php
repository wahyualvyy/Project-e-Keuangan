<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SppModel;

class SppController extends BaseController
{
    protected $sppModel;
    public function __construct()
    {
        $this->sppModel = new SppModel();
    }
    public function index()
    {
        $data = [
            "title" => "Data Kas SPP",
            "spp" => $this->sppModel->getData()
        ];
        return view('admin/data-kas/data-kas-spp', $data);
    }
    public function input()
    {
        $data = [
            "title" => "Input Data Kas SPP"
        ];
        return view('admin/input-tabel/input-data-kas-spp', $data);
    }

    public function createSPP()
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
                'biaya-spp' => [
                    'label' => 'Biaya SPP',
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
            'biaya_spp' => $this->request->getPost('biaya-spp'),
            'status' => $this->request->getPost('status')
        ];

        $this->sppModel->insert($data);
        return redirect()->to(base_url('data-kas/spp'))->with('success', 'Data SPP berhasil ditambahkan.');
    }
}
