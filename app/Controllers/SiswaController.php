<?php

namespace App\Controllers;


use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\JurusanModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SiswaController extends BaseController
{
    protected $siswaModel;
    protected $jurusanModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->siswaModel = new siswaModel();
        $this->jurusanModel = new JurusanModel();
        $this->kelasModel = new KelasModel();
    }
    public function index()
    {
        $sort = $this->request->getGet('sort') ?? 'terbaru';
        $siswa = $this->siswaModel->getData($sort);

        $data = [
            'title' => 'Data Siswa',
            'siswa' => $siswa,
            'sort' => $sort,
            'kelas' => $this->kelasModel->getKelasWithRelations(),
        ];
        return view('admin/data-tabel/data-siswa', $data);
    }

    public function input()
    {
        $data = [
            'title' => 'Input Data Siswa',
            'kelas' => $this->kelasModel->getKelasWithRelations(),
            'jurusan' => $this->kelasModel->getJurusanFromKelas()
        ];
        return view('admin/data-tabel/input-siswa', $data);
    }

    public function create()
    {
        $rules = [
            'nama_siswa' => [
                'label' => 'Nama Siswa',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 100 karakter.'
                ]
            ],
            'nis' => [
                'label' => 'NIS',
                'rules' => 'required|is_unique[siswa.nis]|min_length[3]|max_length[20]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'is_unique' => '{field} sudah terdaftar.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 20 karakter.'
                ]
            ],
            'nisn' => [
                'label' => 'NISN',
                'rules' => 'required|is_unique[siswa.nisn]|min_length[3]|max_length[20]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'is_unique' => '{field} sudah terdaftar.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 20 karakter.'
                ]
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis Kelamin',
                'rules' => 'required|in_list[Laki-laki,Perempuan]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'in_list' => '{field} harus Laki-laki atau Perempuan.'
                ]
            ],
            'tempat_lahir' => [
                'label' => 'Tempat Lahir',
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 50 karakter.'
                ]
            ],
            'tanggal_lahir' => [
                'label' => 'Tanggal Lahir',
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'valid_date' => '{field} tidak valid.'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[5]|max_length[255]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 5 karakter.',
                    'max_length' => '{field} maksimal 255 karakter.'
                ]
            ],
            'no_telp' => [
                'label' => 'No. Telepon',
                'rules' => 'required|min_length[10]|max_length[15]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 10 karakter.',
                    'max_length' => '{field} maksimal 15 karakter.'
                ]
            ],
            'id_kelas' => [
                'label' => 'Kelas',
                'rules' => 'required|is_not_unique[kelas.id_kelas]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'is_not_unique' => '{field} tidak valid.'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required|in_list[Aktif,Tidak Aktif,Cuti]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'in_list' => '{field} harus Aktif, Tidak Aktif, dan Cuti.'
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'nis' => $this->request->getPost('nis'),
            'nisn' => $this->request->getPost('nisn'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('no_telp'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'status' => $this->request->getPost('status'),
        ];
        $this->siswaModel->insert($data);
        return redirect()->to('/siswa')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = $this->siswaModel->find($id);
        if (!$siswa) {
            return redirect()->to('/siswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        // Ambil data kelas siswa untuk mendapat id_jurusan
        $kelas_siswa = $this->kelasModel->find($siswa['id_kelas']);
        if ($kelas_siswa) {
            $siswa['id_jurusan'] = $kelas_siswa->id_jurusan;
        }

        $data = [
            'title' => 'Edit Data Siswa',
            'siswa' => $siswa,
            'kelas' => $this->kelasModel->getKelasWithRelations(),
            'jurusan' => $this->kelasModel->getJurusanFromKelas()
        ];

        return view('admin/edit-tabel/edit-siswa', $data);
    }

    public function update($id)
    {
        $siswa = $this->siswaModel->find($id);
        if (!$siswa) {
            return redirect()->to('/siswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        $rules = [
            'nama_siswa' => [
                'label' => 'Nama Siswa',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 100 karakter.'
                ]
            ],
            'nis' => [
                'label' => 'NIS',
                'rules' => 'required|min_length[3]|max_length[20]|is_unique[siswa.nis,id_siswa,' . $id . ']',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'is_unique' => '{field} sudah terdaftar.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 20 karakter.'
                ]
            ],
            'nisn' => [
                'label' => 'NISN',
                'rules' => 'required|min_length[3]|max_length[20]|is_unique[siswa.nisn,id_siswa,' . $id . ']',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'is_unique' => '{field} sudah terdaftar.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 20 karakter.'
                ]
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis Kelamin',
                'rules' => 'required|in_list[Laki-laki,Perempuan]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'in_list' => '{field} harus Laki-laki atau Perempuan.'
                ]
            ],
            'tempat_lahir' => [
                'label' => 'Tempat Lahir',
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 50 karakter.'
                ]
            ],
            'tanggal_lahir' => [
                'label' => 'Tanggal Lahir',
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'valid_date' => '{field} tidak valid.'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[5]|max_length[255]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 5 karakter.',
                    'max_length' => '{field} maksimal 255 karakter.'
                ]
            ],
            'no_telp' => [
                'label' => 'No. Telepon',
                'rules' => 'required|min_length[10]|max_length[15]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 10 karakter.',
                    'max_length' => '{field} maksimal 15 karakter.'
                ]
            ],
            'id_kelas' => [
                'label' => 'Kelas',
                'rules' => 'required|is_not_unique[kelas.id_kelas]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'is_not_unique' => '{field} tidak valid.'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required|in_list[Aktif,Tidak Aktif,Cuti]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'in_list' => '{field} harus Aktif, Tidak Aktif, dan Cuti.'
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'nis' => $this->request->getPost('nis'),
            'nisn' => $this->request->getPost('nisn'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('no_telp'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'status' => $this->request->getPost('status'),
        ];
        $this->siswaModel->update($id, $data);
        return redirect()->to('/siswa')->with('success', 'Data siswa berhasil diupdate.');
    }

    public function delete($id)
    {
        $siswa = $this->siswaModel->find($id);
        if (!$siswa) {
            return redirect()->to('/siswa')->with('error', 'Data siswa tidak ditemukan.');
        }
        $this->siswaModel->delete($id);
        return redirect()->to('/siswa')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function bulkAction()
    {
        $action = $this->request->getPost('aksi_massal');
        $siswa_ids = $this->request->getPost('siswa_ids');

        if (!$action || !$siswa_ids) {
            return redirect()->to('/siswa')->with('error', 'Aksi atau data siswa tidak valid.');
        }

        switch ($action) {
            case 'delete':
                $this->siswaModel->whereIn('id_siswa', $siswa_ids)->delete();
                return redirect()->to('/siswa')->with('success', 'Data siswa terpilih berhasil dihapus.');
            case 'set_aktif':
                $this->siswaModel->whereIn('id_siswa', $siswa_ids)->set(['status' => 'Aktif'])->update();
                return redirect()->to('/siswa')->with('success', 'Status siswa terpilih berhasil diubah menjadi Aktif.');
            case 'set_tidak_aktif':
                $this->siswaModel->whereIn('id_siswa', $siswa_ids)->set(['status' => 'Tidak Aktif'])->update();
                return redirect()->to('/siswa')->with('success', 'Status siswa terpilih berhasil diubah menjadi Tidak Aktif.');
            case 'set_cuti':
                $this->siswaModel->whereIn('id_siswa', $siswa_ids)->set(['status' => 'Cuti'])->update();
                return redirect()->to('/siswa')->with('success', 'Status siswa terpilih berhasil diubah menjadi Cuti.');
            case 'export_excel':
                return $this->exportToExcel($siswa_ids);
            default:
                return redirect()->to('/siswa')->with('error', 'Aksi tidak dikenali.');
        }
    }

    private function exportToExcel($siswaIds)
    {
        try {
            $siswaData = $this->siswaModel->whereIn('id_siswa', $siswaIds)->findAll();

            if (empty($siswaData)) {
                return redirect()->to('siswa/')->with('error', 'Data siswa tidak ditemukan.');
            }

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Data Siswa');

            // === Header tabel ===
            $headers = [
                'No',
                'Nama Siswa',
                'NIS',
                'NISN',
                'Jenis Kelamin',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Alamat',
                'No. Telepon',
                'Status'
            ];
            $col = 'A';
            foreach ($headers as $header) {
                $sheet->setCellValue($col . '1', $header);
                $col++;
            }

            // Style header
            $headerStyle = [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ];
            $sheet->getStyle('A1:J1')->applyFromArray($headerStyle);
            $sheet->getRowDimension(1)->setRowHeight(25);

            // === Isi data ===
            $row = 2;
            $no = 1;
            foreach ($siswaData as $siswa) {
                $sheet->setCellValue('A' . $row, $no++);
                $sheet->setCellValue('B' . $row, $siswa['nama_siswa']);
                $sheet->setCellValue('C' . $row, $siswa['nis']);
                $sheet->setCellValue('D' . $row, $siswa['nisn']);
                $sheet->setCellValue('E' . $row, $siswa['jenis_kelamin']);
                $sheet->setCellValue('F' . $row, $siswa['tempat_lahir']);
                $sheet->setCellValue('G' . $row, $siswa['tanggal_lahir']);
                $sheet->setCellValue('H' . $row, $siswa['alamat']);
                $sheet->setCellValue('I' . $row, $siswa['no_telp']);
                $sheet->setCellValue('J' . $row, $siswa['status']);

                // Zebra striping
                if ($row % 2 == 0) {
                    $sheet->getStyle("A{$row}:J{$row}")
                        ->getFill()->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setRGB('F2F2F2');
                }
                $row++;
            }

            // Style isi data
            $sheet->getStyle('A2:J' . ($row - 1))->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER]
            ]);

            // Center kolom tertentu
            $sheet->getStyle('A2:A' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('E2:E' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G2:G' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('J2:J' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Auto size kolom
            foreach (range('A', 'J') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // === Output ===
            $filename = 'Data_Siswa_' . date('Y-m-d_H-i-s') . '.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');

            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);
            exit();

        } catch (\Exception $e) {
            return redirect()->to('siswa/')->with('error', 'Gagal export data: ' . $e->getMessage());
        }
    }

}
