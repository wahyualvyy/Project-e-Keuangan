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

        $transaksi = $this->transaksiModel->getLaporanTransaksi($bulan, $tahun, $jenis);

        $data = [
            'title' => 'Laporan Transaksi (Buku Kas)',
            'transaksi' => $transaksi,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jenis' => $jenis,
            'total_pemasukan' => $this->transaksiModel->getTotalPemasukan($bulan, $tahun),
            'total_pengeluaran' => $this->transaksiModel->getTotalPengeluaran($bulan, $tahun),
            'saldo' => $this->transaksiModel->getSaldo($bulan, $tahun),
        ];

        return view('admin/data-kas/data-kas-transaksi', $data);
    }

    /**
     * Detail transaksi
     */
    // public function detail($id)
    // {
    //     $transaksi = $this->transaksiModel->find($id);
    //     if (!$transaksi) {
    //         return redirect()->to('/data-kas/laporan/transaksi')->with('error', 'Data transaksi tidak ditemukan.');
    //     }

    //     $data = [
    //         'title' => 'Detail Transaksi',
    //         'transaksi' => $transaksi,
    //     ];

    //     return view('admin/Details/transaksi-detail', $data);
    // }

    // /**
    //  * Dashboard summary
    //  */
    // public function dashboard()
    // {
    //     $bulanIni = date('m');
    //     $tahunIni = date('Y');

    //     $data = [
    //         'title' => 'Dashboard Keuangan',
    //         'pemasukan_bulan_ini' => $this->transaksiModel->getTotalPemasukan($bulanIni, $tahunIni),
    //         'pengeluaran_bulan_ini' => $this->transaksiModel->getTotalPengeluaran($bulanIni, $tahunIni),
    //         'saldo_bulan_ini' => $this->transaksiModel->getSaldo($bulanIni, $tahunIni),
    //         'pemasukan_total' => $this->transaksiModel->getTotalPemasukan(),
    //         'pengeluaran_total' => $this->transaksiModel->getTotalPengeluaran(),
    //         'saldo_total' => $this->transaksiModel->getSaldo(),
    //         'transaksi_terbaru' => $this->transaksiModel->orderBy('tanggal', 'DESC')->limit(10)->find(),
    //     ];

    //     return view('admin/dashboard/dashboard-keuangan', $data);
    // }

    /**
     * Export laporan ke Excel/PDF
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
     * Export ke Excel (CSV sederhana)
     */
    private function exportExcel($transaksi, $bulan, $tahun)
    {
        $filename = 'Laporan_Transaksi_' . date('YmdHis') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');

        // Header CSV
        fputcsv($output, ['LAPORAN TRANSAKSI KEUANGAN']);
        fputcsv($output, ['Periode: ' . ($bulan ? 'Bulan ' . $bulan : 'Semua Bulan') . ' ' . ($tahun ?? 'Semua Tahun')]);
        fputcsv($output, ['']);
        fputcsv($output, ['No', 'Tanggal', 'Kategori', 'Jenis', 'Nama', 'Nominal', 'Keterangan']);

        // Data
        $no = 1;
        foreach ($transaksi as $row) {
            fputcsv($output, [
                $no++,
                date('d/m/Y', strtotime($row['tanggal'])),
                $row['kategori'],
                $row['jenis_transaksi'],
                $row['nama_siswa'] ?? $row['nama_guru'] ?? '-',
                $row['nominal'],
                $row['keterangan'] ?? '-'
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Export ke PDF (perlu library tambahan)
     */
    private function exportPDF($transaksi, $bulan, $tahun)
    {
        // Implementasi export PDF jika diperlukan
        // Bisa menggunakan TCPDF, Dompdf, dll
        return redirect()->back()->with('info', 'Fitur export PDF dalam pengembangan.');
    }
}