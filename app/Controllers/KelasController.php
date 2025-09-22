<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class KelasController extends BaseController
{

    protected $kelasModel;
    protected $jurusanModel;
    protected $guruModel;
    public function __construct()
    {
        // Load the KelasModel
        $this->kelasModel = new \App\Models\KelasModel();
        $this->jurusanModel = new \App\Models\JurusanModel();
        $this->guruModel = new \App\Models\GuruModel();
    }
    private function numberToRoman($num)
    {
        $map = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1,
        ];
        $returnValue = '';
        while ($num > 0) {
            foreach ($map as $roman => $int) {
                if ($num >= $int) {
                    $num -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    public function index()
    {
        $sort = $this->request->getGet('sort') ?? 'terbaru';

        $kelas = $this->kelasModel->getData($sort);

        $data = [
            'title' => 'Data Kelas',
            'kelas' => $kelas,
            'sort' => $sort
        ];
        return view('admin/data-tabel/data-kelas', $data);
    }
    public function input()
    {
        $data = [
            'title' => 'Input Kelas',
            'jurusan' => $this->jurusanModel->findAll(),
            'guru' => $this->guruModel->findAll(),
        ];
        return view('admin/data-tabel/input-kelas', $data);
    }

    public function create()
    {
        $rules = [
            'nama_kelas' => [
                'label' => 'Nama Kelas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ]
            ],
            'id_jurusan' => [
                'label' => 'Nama Jurusan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ],
            ],
            'id_guru' => [
                'label' => 'Nama Wali',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $nama_kelas = $this->request->getPost('nama_kelas');
        $kelas_romawi = $this->numberToRoman((int) $nama_kelas);

        $data = [
            'nama_kelas' => $kelas_romawi,
            'id_jurusan' => $this->request->getPost('id_jurusan'),
            'id_guru' => $this->request->getPost('id_guru'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        $this->kelasModel->insert($data);
        return redirect()->to(base_url('kelas'))->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelas = $this->kelasModel->getKelasById($id);
        if (!$kelas) {
            return redirect()->to(base_url('kelas'))->with('error', 'Data kelas tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Kelas',
            'kelas' => $kelas,
            'jurusan' => $this->jurusanModel->findAll(),
            'guru' => $this->guruModel->findAll(),
        ];
        return view('admin/edit-tabel/edit-kelas', $data);
    }

    public function update($id)
    {
        $kelas = $this->kelasModel->find($id);
        if (!$kelas) {
            return redirect()->to(base_url('kelas'))->with('error', 'Data kelas tidak ditemukan.');
        }

        $rules = [
            'nama_kelas' => [
                'label' => 'Nama Kelas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ]
            ],
            'id_jurusan' => [
                'label' => 'Nama Jurusan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ],
            ],
            'id_guru' => [
                'label' => 'Nama Wali',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $nama_kelas = $this->request->getPost('nama_kelas');
        $kelas_romawi = $this->numberToRoman((int) $nama_kelas);

        $data = [
            'nama_kelas' => $kelas_romawi,
            'id_jurusan' => $this->request->getPost('id_jurusan'),
            'id_guru' => $this->request->getPost('id_guru'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        $this->kelasModel->update($id, $data);
        return redirect()->to(base_url('kelas'))->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function delete($id)
    {
        $kelas = $this->kelasModel->find($id);
        if (!$kelas) {
            return redirect()->to(base_url('kelas'))->with('error', 'Data kelas tidak ditemukan.');
        }

        $this->kelasModel->delete($id);
        return redirect()->to(base_url('kelas'))->with('success', 'Data kelas berhasil dihapus.');
    }

    public function bulkAction()
    {
        $action = $this->request->getPost('aksi_massal');
        $kelasIds = $this->request->getPost('kelas_ids');

        if (is_array($kelasIds)) {
            $kelasIds = array_map('intval', $kelasIds);
        } else {
            $kelasIds = [$kelasIds];
        }

        if (empty($action) || empty($kelasIds)) {
            return redirect()->to(base_url('kelas'))->with('error', 'Aksi massal atau data kelas belum dipilih.');
        }

        switch ($action) {
            case 'hapus':
                $this->kelasModel->whereIn('id_kelas', $kelasIds)->delete();
                return redirect()->to(base_url('kelas'))->with('success', 'Data kelas yang dipilih berhasil dihapus.');
            case 'export_excel':
                return $this->exportToExcel($kelasIds);
            default:
                return redirect()->to(base_url('kelas'))->with('error', 'Aksi massal tidak valid.');
        }
    }
    private function exportToExcel($kelasIds)
{
    $kelasData = $this->kelasModel->getKelasByIds($kelasIds);

    if (empty($kelasData)) {
        return redirect()->to('kelas/')->with('error', 'Data kelas tidak ditemukan.');
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Data Kelas');

    // === Header tabel (baris ke-1) ===
    $headers = ['No', 'Kelas', 'Wali Kelas', 'Jurusan', 'Keterangan'];
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
            'startColor' => ['rgb' => '4472C4'] // biru elegan
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
    $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);
    $sheet->getRowDimension(1)->setRowHeight(25);

    // === Isi data mulai baris ke-2 ===
    $row = 2;
    $no = 1;
    foreach ($kelasData as $data) {
        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, $data['nama_kelas']);
        $sheet->setCellValue('C' . $row, $data['nama_guru']);
        $sheet->setCellValue('D' . $row, $data['nama_jurusan']);
        $sheet->setCellValue('E' . $row, $data['keterangan']);

        // Zebra striping
        if ($row % 2 == 0) {
            $sheet->getStyle("A{$row}:E{$row}")->getFill()->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setRGB('F2F2F2'); // abu muda
        }
        $row++;
    }

    // Style isi data
    $sheet->getStyle('A2:E' . ($row - 1))->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000']
            ]
        ],
        'alignment' => ['vertical' => Alignment::VERTICAL_CENTER]
    ]);

    // Kolom No rata tengah
    $sheet->getStyle('A2:A' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    // Auto size kolom
    foreach (range('A', 'E') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // === Output ===
    $filename = 'Data_Kelas_' . date('Y-m-d_H-i-s') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    $spreadsheet->disconnectWorksheets();
    unset($spreadsheet);
    exit();
}


}
