<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TransaksiController extends BaseController
{
    protected $transaksiModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
    }

    /**
     * Menampilkan laporan transaksi (buku kas)
     */
    public function index()
    {
        $bulan = $this->request->getGet('bulan') ?? null;
        $tahun = $this->request->getGet('tahun') ?? null;
        $jenis = $this->request->getGet('jenis') ?? null;
        $sortBy = $this->request->getGet('sort_by') ?? 'tanggal';
        $sortOrder = $this->request->getGet('sort_order') ?? 'DESC';

        $transaksi = $this->transaksiModel->getLaporanTransaksi($bulan, $tahun, $jenis, $sortBy, $sortOrder);

        $data = [
            'title' => 'Laporan Transaksi (Buku Kas)',
            'transaksi' => $transaksi,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jenis' => $jenis,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
            'total_pemasukan' => $this->transaksiModel->getTotalPemasukan($bulan, $tahun),
            'total_pengeluaran' => $this->transaksiModel->getTotalPengeluaran($bulan, $tahun),
            'saldo' => $this->transaksiModel->getSaldo($bulan, $tahun),
        ];

        return view('admin/data-kas/data-kas-transaksi', $data);
    }

    /**
     * Export laporan ke Excel
     */
    public function export()
    {
        $bulan = $this->request->getGet('bulan') ?? null;
        $tahun = $this->request->getGet('tahun') ?? null;
        $jenis = $this->request->getGet('jenis') ?? null;
        $format = $this->request->getGet('format') ?? 'excel';

        $transaksi = $this->transaksiModel->getLaporanTransaksi($bulan, $tahun, $jenis);

        if ($format == 'excel') {
            return $this->exportExcel($transaksi, $bulan, $tahun);
        } else {
            return $this->exportPDF($transaksi, $bulan, $tahun);
        }
    }

    /**
     * Export ke Excel (PhpSpreadsheet)
     */
    private function exportExcel($transaksi, $bulan, $tahun)
    {
        try {
            // Load PhpSpreadsheet
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Laporan Transaksi');

            // === JUDUL LAPORAN ===
            $sheet->mergeCells('A1:H1');
            $sheet->setCellValue('A1', 'LAPORAN TRANSAKSI KEUANGAN');
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

            // === INFO SEKOLAH & PERIODE ===
            $sheet->mergeCells('A2:H2');
            $sheet->setCellValue('A2', 'SMK HASYIM ASY\'ARI');
            $sheet->getStyle('A2')->applyFromArray([
                'font' => ['bold' => true, 'size' => 12],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
            ]);

            $periode = ($bulan ? $this->getNamaBulan($bulan) : 'Semua Bulan') . ' ' . ($tahun ?? 'Semua Tahun');
            $sheet->mergeCells('A3:H3');
            $sheet->setCellValue('A3', 'Periode: ' . $periode);
            $sheet->getStyle('A3')->applyFromArray([
                'font' => ['italic' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
            ]);

            $sheet->mergeCells('A4:H4');
            $sheet->setCellValue('A4', 'Tanggal Export: ' . date('d/m/Y H:i:s'));
            $sheet->getStyle('A4')->applyFromArray([
                'font' => ['size' => 9, 'italic' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
            ]);

            // === HEADER TABEL ===
            $headers = ['No', 'Tanggal', 'Kategori', 'Jenis', 'Nama', 'NIS/NIP', 'Nominal', 'Keterangan'];
            $col = 'A';
            foreach ($headers as $header) {
                $sheet->setCellValue($col . '6', $header);
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
            $sheet->getStyle('A6:H6')->applyFromArray($headerStyle);
            $sheet->getRowDimension(6)->setRowHeight(25);

            // === ISI DATA ===
            $row = 7;
            $no = 1;
            $totalPemasukan = 0;
            $totalPengeluaran = 0;

            foreach ($transaksi as $data) {
                $nama = $data['nama_siswa'] ?? $data['nama_guru'] ?? '-';
                $nomor = $data['nis'] ?? $data['nip'] ?? '-';
                $nominal = (float)$data['nominal'];

                if ($data['jenis_transaksi'] === 'pemasukan') {
                    $totalPemasukan += $nominal;
                } else {
                    $totalPengeluaran += $nominal;
                }

                $sheet->setCellValue('A' . $row, $no++);
                $sheet->setCellValue('B' . $row, date('d/m/Y', strtotime($data['tanggal'])));
                $sheet->setCellValue('C' . $row, $data['kategori']);
                $sheet->setCellValue('D' . $row, ucfirst($data['jenis_transaksi']));
                $sheet->setCellValue('E' . $row, $nama);
                $sheet->setCellValue('F' . $row, $nomor);
                $sheet->setCellValue('G' . $row, $nominal);
                $sheet->setCellValue('H' . $row, $data['keterangan'] ?? '-');

                // Warna berdasarkan jenis transaksi
                if ($data['jenis_transaksi'] === 'pemasukan') {
                    $sheet->getStyle("D{$row}")->applyFromArray([
                        'font' => ['color' => ['rgb' => '28A745'], 'bold' => true]
                    ]);
                } else {
                    $sheet->getStyle("D{$row}")->applyFromArray([
                        'font' => ['color' => ['rgb' => 'DC3545'], 'bold' => true]
                    ]);
                }

                // Zebra striping
                if ($row % 2 == 0) {
                    $sheet->getStyle("A{$row}:H{$row}")
                        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setRGB('F8F9FA');
                }

                $row++;
            }

            // Style isi data
            $lastRow = $row - 1;
            $sheet->getStyle('A7:H' . $lastRow)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC']
                    ]
                ],
                'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]
            ]);

            // Format currency untuk kolom nominal
            $sheet->getStyle('G7:G' . $lastRow)->getNumberFormat()
                ->setFormatCode('#,##0');

            // Center alignment
            $sheet->getStyle('A7:A' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B7:B' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('C7:C' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D7:D' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F7:F' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G7:G' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

            // === RINGKASAN ===
            $summaryRow = $row + 1;
            $saldo = $totalPemasukan - $totalPengeluaran;

            // Judul Ringkasan
            $sheet->mergeCells("A{$summaryRow}:H{$summaryRow}");
            $sheet->setCellValue("A{$summaryRow}", 'RINGKASAN');
            $sheet->getStyle("A{$summaryRow}")->applyFromArray([
                'font' => ['bold' => true, 'size' => 12],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E7E6E6']
                ]
            ]);
            $sheet->getRowDimension($summaryRow)->setRowHeight(25);

            // Total Pemasukan
            $summaryRow++;
            $sheet->mergeCells("A{$summaryRow}:F{$summaryRow}");
            $sheet->setCellValue("A{$summaryRow}", 'Total Pemasukan:');
            $sheet->setCellValue("G{$summaryRow}", $totalPemasukan);
            $sheet->getStyle("A{$summaryRow}:G{$summaryRow}")->applyFromArray([
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D4EDDA']
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    ]
                ]
            ]);
            $sheet->getStyle("A{$summaryRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle("G{$summaryRow}")->applyFromArray([
                'font' => ['color' => ['rgb' => '28A745']],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT],
                'numberFormat' => ['formatCode' => '#,##0']
            ]);

            // Total Pengeluaran
            $summaryRow++;
            $sheet->mergeCells("A{$summaryRow}:F{$summaryRow}");
            $sheet->setCellValue("A{$summaryRow}", 'Total Pengeluaran:');
            $sheet->setCellValue("G{$summaryRow}", $totalPengeluaran);
            $sheet->getStyle("A{$summaryRow}:G{$summaryRow}")->applyFromArray([
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F8D7DA']
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    ]
                ]
            ]);
            $sheet->getStyle("A{$summaryRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle("G{$summaryRow}")->applyFromArray([
                'font' => ['color' => ['rgb' => 'DC3545']],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT],
                'numberFormat' => ['formatCode' => '#,##0']
            ]);

            // Saldo Akhir
            $summaryRow++;
            $sheet->mergeCells("A{$summaryRow}:F{$summaryRow}");
            $sheet->setCellValue("A{$summaryRow}", 'SALDO:');
            $sheet->setCellValue("G{$summaryRow}", $saldo);
            $sheet->getStyle("A{$summaryRow}:G{$summaryRow}")->applyFromArray([
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $saldo >= 0 ? 'CCE5FF' : 'FFE5E5']
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
                'font' => ['color' => ['rgb' => $saldo >= 0 ? '0066CC' : 'CC0000']],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT],
                'numberFormat' => ['formatCode' => '#,##0']
            ]);
            $sheet->getRowDimension($summaryRow)->setRowHeight(25);

            // === AUTO SIZE KOLOM ===
            foreach (range('A', 'H') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // Set minimum width untuk kolom tertentu
            $sheet->getColumnDimension('E')->setWidth(25); // Nama
            $sheet->getColumnDimension('H')->setWidth(30); // Keterangan

            // === OUTPUT ===
            $filename = 'Laporan_Transaksi_' . date('Y-m-d_H-i-s') . '.xlsx';
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

    /**
     * Export ke PDF
     */
    private function exportPDF($transaksi, $bulan, $tahun)
    {
        return redirect()->back()->with('info', 'Fitur export PDF dalam pengembangan. Silakan gunakan export Excel.');
    }

    /**
     * Helper - Get nama bulan
     */
    private function getNamaBulan($bulan)
    {
        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        return $namaBulan[$bulan] ?? '';
    }
}