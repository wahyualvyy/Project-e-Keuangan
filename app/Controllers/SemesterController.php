<?php

namespace App\Controllers;

use App\Models\JurusanModel;
use App\Models\SemesterModel;
use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use App\Models\PembayaranSemesterModel;
use CodeIgniter\HTTP\ResponseInterface;

class SemesterController extends BaseController
{
    protected $semesterModel;
    protected $jurusanModel;
    protected $pembayaranSemesterModel;
    protected $TransaksiModel;

    public function __construct()
    {
        $this->semesterModel = new SemesterModel();
        $this->jurusanModel = new JurusanModel();
        $this->pembayaranSemesterModel = new PembayaranSemesterModel();
        $this->TransaksiModel = new TransaksiModel();
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

    /**
     * Bulk Action untuk Kas Semester
     */
    public function bulkActionSemester()
    {
        $aksi = $this->request->getPost('aksi_massal');
        $ids = $this->request->getPost('id_pembayaran_semester');

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }

        switch ($aksi) {
            case 'hapus':
                return $this->bulkDeleteSemester($ids);
            case 'bayar':
                return $this->bulkBayarSemester($ids);
            case 'export_excel':
                return $this->bulkExportSemester($ids);
            default:
                return redirect()->back()->with('error', 'Aksi tidak valid.');
        }
    }

    /**
     * Bulk Delete Pembayaran Semester
     */
    private function bulkDeleteSemester($ids)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            foreach ($ids as $id) {
                $this->pembayaranSemesterModel->delete($id);
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal menghapus data pembayaran semester.');
            }

            $count = count($ids);
            return redirect()->back()->with('success', "Berhasil menghapus {$count} data pembayaran semester.");
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Bulk Bayar Pembayaran Semester
     */
    private function bulkBayarSemester($ids)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $successCount = 0;
            $skipCount = 0;

            foreach ($ids as $id) {
                $pembayaran = $this->pembayaranSemesterModel->getDetailById($id);

                if (!$pembayaran) {
                    $skipCount++;
                    continue;
                }

                // Skip jika sudah lunas
                if ($pembayaran['status_pembayaran'] === 'Lunas') {
                    $skipCount++;
                    continue;
                }

                // Update status pembayaran
                $this->pembayaranSemesterModel->update($id, ['status_pembayaran' => 'Lunas']);

                // Catat ke tabel transaksi
                $this->TransaksiModel->catatPemasukanSemester(
                    $id,
                    $pembayaran['biaya_semester'],
                    'Pembayaran Semester ' . $pembayaran['nomor_semester'] . ' - ' . $pembayaran['nama_siswa']
                );

                $successCount++;
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal memproses pembayaran semester.');
            }

            $message = "Berhasil memproses {$successCount} pembayaran semester.";
            if ($skipCount > 0) {
                $message .= " {$skipCount} data dilewati (sudah lunas atau tidak valid).";
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Bulk Export Pembayaran Semester ke Excel
     */
    private function bulkExportSemester($ids)
    {
        try {
            // Ambil data berdasarkan IDs
            $pembayaran = $this->pembayaranSemesterModel
                ->select('pembayaran_semester.*, siswa.nama_siswa, siswa.nis, semester.biaya_semester, semester.tahun_ajaran, semester.nomor_semester, kelas.nama_kelas')
                ->join('siswa', 'siswa.id_siswa = pembayaran_semester.id_siswa')
                ->join('semester', 'semester.id_semester = pembayaran_semester.id_semester')
                ->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
                ->whereIn('pembayaran_semester.id_pembayaran_semester', $ids)
                ->findAll();

            if (empty($pembayaran)) {
                return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan.');
            }

            // Load PhpSpreadsheet
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Pembayaran Semester');

            // === JUDUL LAPORAN ===
            $sheet->mergeCells('A1:I1');
            $sheet->setCellValue('A1', 'LAPORAN PEMBAYARAN SEMESTER');
            $sheet->getStyle('A1')->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 16,
                    'color' => ['rgb' => '1F4788']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ]
            ]);
            $sheet->getRowDimension(1)->setRowHeight(30);

            // === INFO SEKOLAH ===
            $sheet->mergeCells('A2:I2');
            $sheet->setCellValue('A2', 'SMK HASYIM ASY\'ARI');
            $sheet->getStyle('A2')->applyFromArray([
                'font' => ['bold' => true, 'size' => 12],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
            ]);

            $sheet->mergeCells('A3:I3');
            $sheet->setCellValue('A3', 'Tanggal Export: ' . date('d/m/Y H:i:s'));
            $sheet->getStyle('A3')->applyFromArray([
                'font' => ['size' => 9, 'italic' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
            ]);

            // === HEADER TABEL ===
            $headers = ['No', 'NIS', 'Nama Siswa', 'Kelas', 'Semester', 'Tahun Ajaran', 'Biaya', 'Status', 'Tanggal Bayar'];
            $col = 'A';
            foreach ($headers as $header) {
                $sheet->setCellValue($col . '5', $header);
                $col++;
            }

            // Style Header
            $headerStyle = [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 11
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ];
            $sheet->getStyle('A5:I5')->applyFromArray($headerStyle);
            $sheet->getRowDimension(5)->setRowHeight(25);

            // === ISI DATA ===
            $row = 6;
            $no = 1;
            $totalBiaya = 0;
            $totalLunas = 0;
            $totalBelumLunas = 0;

            foreach ($pembayaran as $data) {
                $sheet->setCellValue('A' . $row, $no++);
                $sheet->setCellValue('B' . $row, $data['nis']);
                $sheet->setCellValue('C' . $row, $data['nama_siswa']);
                $sheet->setCellValue('D' . $row, $data['nama_kelas']);
                $sheet->setCellValue('E' . $row, 'Semester ' . $data['nomor_semester']);
                $sheet->setCellValue('F' . $row, $data['tahun_ajaran']);
                $sheet->setCellValue('G' . $row, $data['biaya_semester']);
                $sheet->setCellValue('H' . $row, $data['status_pembayaran']);
                $sheet->setCellValue('I' . $row, $data['tanggal_bayar'] ? date('d/m/Y', strtotime($data['tanggal_bayar'])) : '-');

                $totalBiaya += $data['biaya_semester'];
                if ($data['status_pembayaran'] === 'Lunas') {
                    $totalLunas++;
                } else {
                    $totalBelumLunas++;
                }

                // Warna status
                if ($data['status_pembayaran'] === 'Lunas') {
                    $sheet->getStyle("H{$row}")->applyFromArray([
                        'font' => ['color' => ['rgb' => '28A745'], 'bold' => true],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'D4EDDA']
                        ]
                    ]);
                } else {
                    $sheet->getStyle("H{$row}")->applyFromArray([
                        'font' => ['color' => ['rgb' => 'DC3545'], 'bold' => true],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'F8D7DA']
                        ]
                    ]);
                }

                // Zebra striping
                if ($row % 2 == 0) {
                    $sheet->getStyle("A{$row}:I{$row}")
                        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setRGB('F8F9FA');
                }

                $row++;
            }

            // Style isi data
            $lastRow = $row - 1;
            $sheet->getStyle('A6:I' . $lastRow)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC']
                    ]
                ],
                'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]
            ]);

            // Format currency
            $sheet->getStyle('G6:G' . $lastRow)->getNumberFormat()->setFormatCode('#,##0');

            // Alignment
            $sheet->getStyle('A6:A' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B6:B' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('E6:E' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('H6:H' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('I6:I' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G6:G' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

            // === RINGKASAN ===
            $summaryRow = $row + 1;

            $sheet->mergeCells("A{$summaryRow}:I{$summaryRow}");
            $sheet->setCellValue("A{$summaryRow}", 'RINGKASAN');
            $sheet->getStyle("A{$summaryRow}")->applyFromArray([
                'font' => ['bold' => true, 'size' => 12],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E7E6E6']
                ]
            ]);

            $summaryRow++;
            $sheet->mergeCells("A{$summaryRow}:F{$summaryRow}");
            $sheet->setCellValue("A{$summaryRow}", 'Total Pembayaran Lunas:');
            $sheet->setCellValue("G{$summaryRow}", $totalLunas . ' pembayaran');
            $sheet->getStyle("A{$summaryRow}:G{$summaryRow}")->applyFromArray([
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D4EDDA']
                ],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
            ]);
            $sheet->getStyle("A{$summaryRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

            $summaryRow++;
            $sheet->mergeCells("A{$summaryRow}:F{$summaryRow}");
            $sheet->setCellValue("A{$summaryRow}", 'Total Belum Lunas:');
            $sheet->setCellValue("G{$summaryRow}", $totalBelumLunas . ' pembayaran');
            $sheet->getStyle("A{$summaryRow}:G{$summaryRow}")->applyFromArray([
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F8D7DA']
                ],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
            ]);
            $sheet->getStyle("A{$summaryRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

            $summaryRow++;
            $sheet->mergeCells("A{$summaryRow}:F{$summaryRow}");
            $sheet->setCellValue("A{$summaryRow}", 'TOTAL BIAYA:');
            $sheet->setCellValue("G{$summaryRow}", $totalBiaya);
            $sheet->getStyle("A{$summaryRow}:G{$summaryRow}")->applyFromArray([
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'CCE5FF']
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ]);
            $sheet->getStyle("A{$summaryRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle("G{$summaryRow}")->applyFromArray([
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT],
                'numberFormat' => ['formatCode' => '#,##0']
            ]);

            // === AUTO SIZE ===
            foreach (range('A', 'I') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // === OUTPUT ===
            $filename = 'Pembayaran_Semester_' . date('Y-m-d_H-i-s') . '.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');

            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);
            exit();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal export Excel: ' . $e->getMessage());
        }
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

        // Hapus pembayaran (transaksi terkait akan terhapus otomatis karena CASCADE)
        $this->pembayaranSemesterModel->delete($id);
        return redirect()->to('/kas-masuk/semester')->with('success', 'Data pembayaran semester dan transaksi terkait berhasil dihapus.');
    }

    public function bayarSemester($id)
    {
        $pembayaran = $this->pembayaranSemesterModel->getDetailById($id);
        if (!$pembayaran) {
            return redirect()->to('/kas-masuk/semester')->with('error', 'Data pembayaran semester tidak ditemukan.');
        }

        // Mulai database transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Update status pembayaran
            $this->pembayaranSemesterModel->update($id, ['status_pembayaran' => 'Lunas']);

            // Catat ke tabel transaksi
            $this->TransaksiModel->catatPemasukanSemester(
                $id,
                $pembayaran['biaya_semester'],
                'Pembayaran Semester ' . ($pembayaran['semester'] ?? '')
            );

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->to('/kas-masuk/semester')->with('error', 'Gagal memproses pembayaran semester.');
            }

            return redirect()->to('/kas-masuk/semester')->with('success', 'Pembayaran semester berhasil diproses dan tercatat di transaksi.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->to('/kas-masuk/semester')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}