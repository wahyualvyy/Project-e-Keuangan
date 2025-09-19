<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

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
            case 'set_aktif':
                $this->GuruModel->update($guruIds, ['status' => 'Aktif']);
                return redirect()->to('guru/')->with('success', 'Status guru yang dipilih berhasil diubah menjadi Aktif.');
            case 'set_tidak_aktif':
                $this->GuruModel->update($guruIds, ['status' => 'Tidak Aktif']);
                return redirect()->to('guru/')->with('success', 'Status guru yang dipilih berhasil diubah menjadi Tidak Aktif.');
            case 'set_cuti':
                $this->GuruModel->update($guruIds, ['status' => 'Cuti']);
                return redirect()->to('guru/')->with('success', 'Status guru yang dipilih berhasil diubah menjadi Cuti.');
            case 'export_excel':
                return $this->exportExcel($guruIds);
            default:
                return redirect()->to('guru/')->with('error', 'Aksi tidak dikenali.');
        }

        
    }
     private function exportExcel($guruIds)
    {
        try {
            // Ambil data guru berdasarkan ID yang dipilih
            $guruData = $this->GuruModel->whereIn('id_guru', $guruIds)->findAll();
            
            if (empty($guruData)) {
                return redirect()->to('guru/')->with('error', 'Data guru tidak ditemukan.');
            }

            // Buat spreadsheet baru
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set judul dokumen
            $sheet->setTitle('Data Guru');

            // Header tabel
            $headers = [
                'A1' => 'No',
                'B1' => 'Nama Guru',
                'C1' => 'NIP',
                'D1' => 'Jenis Kelamin',
                'E1' => 'Bidang Studi',
                'F1' => 'Alamat',
                'G1' => 'No. Telepon',
                'H1' => 'Status'
            ];

            // Input header
            foreach ($headers as $cell => $value) {
                $sheet->setCellValue($cell, $value);
            }

            // Styling header
            $headerStyle = [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
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

            $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

            // Input data
            $row = 2;
            $no = 1;
            foreach ($guruData as $guru) {
                $sheet->setCellValue('A' . $row, $no++);
                $sheet->setCellValue('B' . $row, $guru['nama_guru']);
                $sheet->setCellValue('C' . $row, $guru['nip']);
                $sheet->setCellValue('D' . $row, $guru['jenis_kelamin']);
                $sheet->setCellValue('E' . $row, $guru['bidang_studi']);
                $sheet->setCellValue('F' . $row, $guru['alamat']);
                $sheet->setCellValue('G' . $row, $guru['no_telp']);
                $sheet->setCellValue('H' . $row, $guru['status']);
                $row++;
            }

            // Styling data
            $dataStyle = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ];

            $sheet->getStyle('A2:H' . ($row - 1))->applyFromArray($dataStyle);

            // Auto width kolom
            foreach (range('A', 'H') as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }

            // Set row height
            $sheet->getRowDimension(1)->setRowHeight(25);

            // Nama file dengan timestamp
            $filename = 'Data_Guru_' . date('Y-m-d_H-i-s') . '.xlsx';

            // Set header untuk download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            // Tulis file dan output
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            
            // Cleanup
            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);
            
            exit(); // Stop execution setelah download

        } catch (\Exception $e) {
            return redirect()->to('guru/')->with('error', 'Gagal mengeksport data: ' . $e->getMessage());
        }
    }
}
