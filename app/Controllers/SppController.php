<?php

namespace App\Controllers;

use App\Models\SppModel;
use App\Models\PembayaranSPPModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SppController extends BaseController
{
    protected $sppModel;
    protected $PembayaranSPPModel;
    public function __construct()
    {
        $this->sppModel = new SppModel();
        $this->PembayaranSPPModel = new PembayaranSPPModel();
    }
    public function index()
    {
        $data = [
            "title" => "Data Kas SPP",
            "spp" => $this->sppModel->getData()
        ];
        return view('admin/data-kas/data-kas-spp', $data);
    }
    public function inputSPP()
    {
        $data = [
            "title" => "Input Data Kas SPP"
        ];
        return view('admin/Inputs/input-data-kas-spp', $data);
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

    public function editSPP($id)
    {
        $spp = $this->sppModel->find($id);
        if (!$spp) {
            return redirect()->to(base_url('data-kas/spp'))->with('error', 'Data SPP tidak ditemukan.');
        }

        // Pisahkan tahun ajaran menjadi dua bagian
        list($tahunAjaran1, $tahunAjaran2) = explode('/', $spp['tahun_ajaran']);

        $data = [
            "title" => "Edit Data Kas SPP",
            "spp" => $spp,
            "tahunAjaran1" => $tahunAjaran1,
            "tahunAjaran2" => $tahunAjaran2
        ];
        return view('admin/Edits/edit-data-kas-spp', $data);
    }

    public function updateSPP($id)
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

        $this->sppModel->update($id, $data);
        return redirect()->to(base_url('data-kas/spp'))->with('success', 'Data SPP berhasil diperbarui.');
    }

    public function deleteSPP($id)
    {
        $spp = $this->sppModel->find($id);
        if (!$spp) {
            return redirect()->to(base_url('data-kas/spp'))->with('error', 'Data SPP tidak ditemukan.');
        }

        $this->sppModel->delete($id);
        return redirect()->to(base_url('data-kas/spp'))->with('success', 'Data SPP berhasil dihapus.');
    }

    public function SppMasuk()
    {
        $data = [
            "title" => "Kas Masuk SPP",
            "spp" => $this->PembayaranSPPModel->getDataWithRelations()
        ];
        return view('admin/kas-masuk/kas-spp', $data);
    }

    public function SppDetail($id)
    {
        $data = [
            "title" => "Detail Kas Masuk SPP",
            "spp" => $this->PembayaranSPPModel->getDataWithRelationsById($id)
        ];
        return view('admin/Details/kas-spp-detail', $data);
    }

    public function deleteSPPMasuk($id)
    {
        $pembayaranSpp = $this->PembayaranSPPModel->find($id);
        if (!$pembayaranSpp) {
            return redirect()->to(base_url('kas-masuk/spp'))->with('error', 'Data Pembayaran SPP tidak ditemukan.');
        }

        $this->PembayaranSPPModel->delete($id);
        return redirect()->to(base_url('kas-masuk/spp'))->with('success', 'Data Pembayaran SPP berhasil dihapus.');
    }
}
