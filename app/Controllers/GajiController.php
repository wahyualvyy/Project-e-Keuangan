<?php

namespace App\Controllers;

use App\Models\GajiModel;
use App\Models\GuruModel;
use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use App\Models\PembayaranGajiModel;
use CodeIgniter\HTTP\ResponseInterface;

class GajiController extends BaseController
{
    protected $guruModel;
    protected $gajiModel;
    protected $pembayaranGajiModel;
    protected $TransaksiModel;
    public function __construct()
    {
        $this->guruModel = new GuruModel();
        $this->gajiModel = new GajiModel();
        $this->pembayaranGajiModel = new PembayaranGajiModel();
        $this->TransaksiModel = new TransaksiModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Gaji Guru',
            'gaji' => $this->gajiModel->getGajiWithGuru()

        ];
        return view('admin/data-kas/data-kas-gaji', $data);
    }

    public function inputGaji()
    {
        $data = [
            'title' => 'Input Data Gaji Guru',
            'guru' => $this->guruModel->findAktif()

        ];
        return view('admin/Inputs/input-data-kas-gaji', $data);
    }

    public function createGaji()
    {
        $rules = [
            'biaya_gaji' => [
                'label' => 'Biaya Gaji',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
            ],
            'jumlah_jam' => [
                'label' => 'Jumlah Jam',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gajiFinal = $this->request->getPost('biaya_gaji') * $this->request->getPost('jumlah_jam') * 4;
        $jamFinal = $this->request->getPost('jumlah_jam') * 4;

        $data =
            [
                "biaya_gaji" => $gajiFinal,
                "jumlah_jam" => $jamFinal,
            ];

        $this->gajiModel->insert($data);
        return redirect()->to(base_url('data-kas/gaji'))->with('success', 'Data gaji guru berhasil ditambahkan.');
    }

    public function editGaji($id)
    {
        $gaji = $this->gajiModel->find($id);
        $gajiFinal = $gaji['biaya_gaji'] / $gaji['jumlah_jam'];
        $jamFinal = $gaji['jumlah_jam'] / 4;

        $data = [
            'title' => 'Edit Data Gaji Guru',
            'guru' => $this->guruModel->findAll(),
            'gaji' => $this->gajiModel->find($id),
            'biaya_gaji' => $gajiFinal,
            'jumlah_jam' => $jamFinal,

        ];
        return view('admin/Edits/edit-data-kas-gaji', $data);
    }

    public function updateGaji($id)
    {
        $rules = [
            'id_guru' => [
                'label' => 'Guru',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
            ],
            'biaya_gaji' => [
                'label' => 'Biaya Gaji',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
            ],
            'jumlah_jam' => [
                'label' => 'Jumlah Jam',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gajiFinal = $this->request->getPost('biaya_gaji') * $this->request->getPost('jumlah_jam') * 4;
        $jamFinal = $this->request->getPost('jumlah_jam') * 4;

        $data =
            [
                "id_guru" => $this->request->getPost('id_guru'),
                "biaya_gaji" => $gajiFinal,
                "jumlah_jam" => $jamFinal,
            ];

        $this->gajiModel->update($id, $data);
        return redirect()->to(base_url('data-kas/gaji'))->with('success', 'Data gaji guru berhasil diupdate.');
    }

    public function deleteGaji($id)
    {
        $gaji = $this->gajiModel->find($id);
        if (!$gaji) {
            return redirect()->to(base_url('data-kas/gaji'))->with('error', 'Data gaji guru tidak ditemukan.');
        }

        $this->gajiModel->delete($id);
        return redirect()->to(base_url('data-kas/gaji'))->with('success', 'Data gaji guru berhasil dihapus.');
    }

    public function kasGaji()
    {
        $sort = $this->request->getGet('sort') ?? 'semua';
        $bulan = $this->request->getGet('bulan') ?? '';
        $tahun = $this->request->getGet('tahun') ?? '';

        $data = [
            "title" => "Kas Keluar Gaji Guru",
            "gaji" => $this->pembayaranGajiModel->getSortedData($sort, $bulan, $tahun),
            "sort" => $sort,
            "bulan" => $bulan,
            "tahun" => $tahun
        ];

        return view("admin/kas-keluar/kas-gaji", $data);
    }

    public function kasGajiDetail($id)
    {
        if (!$id) {
            return redirect()->to(base_url('kas-keluar/gaji'))->with('error', 'ID pembayaran gaji tidak ditemukan.');
        }
        $data = [
            "title" => "Detail Kas Keluar Gaji Guru",
            "gaji" => $this->pembayaranGajiModel->getRelationshipDataId($id)
        ];

        return view("admin/Details/kas-gaji-detail", $data);
    }

    public function deleteKasGaji($id)
    {
        if (!$id) {
            return redirect()->to(base_url('kas-keluar/gaji'))->with('error', 'ID pembayaran gaji tidak ditemukan.');
        }

        $pembayaranGaji = $this->pembayaranGajiModel->find($id);
        if (!$pembayaranGaji) {
            return redirect()->to(base_url('kas-keluar/gaji'))->with('error', 'Data pembayaran gaji tidak ditemukan.');
        }

        // Hapus pembayaran (transaksi terkait akan terhapus otomatis karena CASCADE)
        $this->pembayaranGajiModel->delete($id);
        return redirect()->to(base_url('kas-keluar/gaji'))->with('success', 'Data pembayaran gaji dan transaksi terkait berhasil dihapus.');
    }

    public function bayarKasGaji($id)
    {
        if (!$id) {
            return redirect()->to(base_url('kas-keluar/gaji'))->with('error', 'ID pembayaran gaji tidak ditemukan.');
        }

        $pembayaranGaji = $this->pembayaranGajiModel->getRelationshipDataId($id);
        if (!$pembayaranGaji) {
            return redirect()->to(base_url('kas-keluar/gaji'))->with('error', 'Data pembayaran gaji tidak ditemukan.');
        }

        // Mulai database transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Update status pembayaran
            $data = [
                "status_pembayaran" => "Lunas",
                "tanggal_bayar" => date('Y-m-d H:i:s')
            ];
            $this->pembayaranGajiModel->update($id, $data);

            // Catat ke tabel transaksi
            $this->TransaksiModel->catatPengeluaranGaji(
                $id,
                $pembayaranGaji['biaya_gaji'], 
                'Pembayaran Gaji Guru - ' . ($pembayaranGaji['bulan'] ?? '') . ' ' . ($pembayaranGaji['tahun'] ?? '')
            );

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->to(base_url('kas-keluar/gaji'))->with('error', 'Gagal memproses pembayaran gaji.');
            }

            return redirect()->to(base_url('kas-keluar/gaji'))->with('success', 'Pembayaran gaji berhasil diproses dan tercatat di transaksi.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->to(base_url('kas-keluar/gaji'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
