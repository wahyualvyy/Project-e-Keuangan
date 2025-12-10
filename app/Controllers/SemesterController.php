<?php

namespace App\Controllers;

use App\Models\JurusanModel;
use App\Models\SemesterModel;
use App\Controllers\BaseController;
use App\Models\PembayaranSemesterModel;
use CodeIgniter\HTTP\ResponseInterface;

class SemesterController extends BaseController
{
    protected $semesterModel;
    protected $jurusanModel;
    protected $pembayaranSemesterModel;

    public function __construct()
    {
        $this->semesterModel = new SemesterModel();
        $this->jurusanModel = new JurusanModel();
        $this->pembayaranSemesterModel = new PembayaranSemesterModel();
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
        // Ambil nilai dari input
        $tahun1 = (int) $this->request->getPost('tahun-ajaran1');
        $tahun2 = (int) $this->request->getPost('tahun-ajaran2');

        $rules = [
            'tahun-ajaran1' => [
                'label' => 'Tahun Ajaran Pertama',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
            ],
            'tahun-ajaran2' => [
                'label' => 'Tahun Ajaran Kedua',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
            ],
            'biaya_semester' => [
                'label' => 'Biaya Semester',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
            ],
            'nomor_semester' => [
                'label' => 'Nomor Semester',
                'rules' => 'required|in_list[1,2]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'in_list' => '{field} harus bernilai 1 atau 2.',
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
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validasi manual: tahun kedua harus lebih besar dari tahun pertama
        if ($tahun2 <= $tahun1) {
            return redirect()->back()->withInput()->with('error', 'Tahun Ajaran Kedua harus lebih besar dari Tahun Ajaran Pertama.');
        }

        $tahunAjaran = $tahun1 . '/' . $tahun2;

        $data = [
            'tahun_ajaran' => $tahunAjaran,
            'nomor_semester' => $this->request->getPost('nomor_semester'),
            'id_jurusan' => $this->request->getPost('id_jurusan'),
            'biaya_semester' => $this->request->getPost('biaya_semester'),
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

    public function updateSemester($id)
    {
        $semester = $this->semesterModel->find($id);
        if (!$semester) {
            return redirect()->to('/data-kas/semester')->with('error', 'Data semester tidak ditemukan.');
        }

        // Ambil nilai dari input
        $tahun1 = (int) $this->request->getPost('tahun-ajaran1');
        $tahun2 = (int) $this->request->getPost('tahun-ajaran2');

        $rules = [
            'tahun-ajaran1' => [
                'label' => 'Tahun Ajaran Pertama',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
            ],
            'tahun-ajaran2' => [
                'label' => 'Tahun Ajaran Kedua',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
            ],
            'biaya_semester' => [
                'label' => 'Biaya Semester',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} harus berupa angka.',
                ],
            ],
            'nomor_semester' => [
                'label' => 'Nomor Semester',
                'rules' => 'required|in_list[1,2]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'in_list' => '{field} harus bernilai 1 atau 2.',
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
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validasi manual: tahun kedua harus lebih besar dari tahun pertama
        if ($tahun2 <= $tahun1) {
            return redirect()->back()->withInput()->with('error', 'Tahun Ajaran Kedua harus lebih besar dari Tahun Ajaran Pertama.');
        }

        $tahunAjaran = $tahun1 . '/' . $tahun2;

        $data = [
            'tahun_ajaran' => $tahunAjaran,
            'id_jurusan' => $this->request->getPost('id_jurusan'),
            'nomor_semester' => $this->request->getPost('nomor_semester'),
            'biaya_semester' => $this->request->getPost('biaya_semester'),
            'status' => $this->request->getPost('status'),
        ];

        $this->semesterModel->update($id, $data);
        return redirect()->to('/data-kas/semester')->with('success', 'Data semester berhasil diperbarui.');
    }

    public function deleteSemester($id)
    {
        $semester = $this->semesterModel->find($id);
        if (!$semester) {
            return redirect()->to('/data-kas/semester')->with('error', 'Data semester tidak ditemukan.');
        }

        $this->semesterModel->delete($id);
        return redirect()->to('/data-kas/semester')->with('success', 'Data semester berhasil dihapus.');
    }

    public function SemesterMasuk()
    {
        $sort = $this->request->getGet('sort') ?? 'semua';
        $semester = $this->request->getGet('semester') ?? null;
        $bulan = $this->request->getGet('bulan') ?? null;
        $tahun = $this->request->getGet('tahun') ?? null;

        $pembayaran = $this->pembayaranSemesterModel->getDataSort($sort, $bulan, $tahun, $semester);

        $data = [
            'title' => 'Kas Masuk Semester',
            'pembayaran_semester' => $pembayaran,
            'sort' => $sort,
            'semester' => $semester,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        return view('admin/kas-masuk/kas-semester', $data);
    }

    public function kasSemesterDetail($id)
    {
        $pembayaran = $this->pembayaranSemesterModel->find($id);
        if (!$pembayaran) {
            return redirect()->to('/kas-masuk/semester')->with('error', 'Data pembayaran semester tidak ditemukan.');
        }
        $data = [
            'title' => 'Detail Kas Masuk Semester',
            'pembayaran' => $pembayaran,
            'data' => $this->pembayaranSemesterModel->getDetailById($id)
        ];
        return view('admin/Details/kas-semester-detail', $data);
    }

    public function deleteSemesterMasuk($id)
    {
        $pembayaran = $this->pembayaranSemesterModel->find($id);
        if (!$pembayaran) {
            return redirect()->to('/kas-masuk/semester')->with('error', 'Data pembayaran semester tidak ditemukan.');
        }

        $this->pembayaranSemesterModel->delete($id);
        return redirect()->to('/kas-masuk/semester')->with('success', 'Data pembayaran semester berhasil dihapus.');
    }

    public function bayarSemester($id)
    {
        $pembayaran = $this->pembayaranSemesterModel->find($id);
        if (!$pembayaran) {
            return redirect()->to('/kas-masuk/semester')->with('error', 'Data pembayaran semester tidak ditemukan.');
        }

        $this->pembayaranSemesterModel->update($id, ['status_pembayaran' => 'Lunas']);
        return redirect()->to('/kas-masuk/semester')->with('success', 'Pembayaran semester berhasil diproses.');
    }
}