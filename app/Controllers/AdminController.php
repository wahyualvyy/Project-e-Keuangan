<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();

        // ====== BULAN INI ======
        $bulan = date('m');
        $tahun = date('Y');

        $pemasukanBulanan = $transaksiModel->getTotalPemasukan($bulan, $tahun);
        $pengeluaranBulanan = $transaksiModel->getTotalPengeluaran($bulan, $tahun);

        // ====== TAHUN INI ======
        $pemasukanTahunan = $transaksiModel->getTotalPemasukan(null, $tahun);
        $pengeluaranTahunan = $transaksiModel->getTotalPengeluaran(null, $tahun);

        // ====== DATA GRAFIK BULANAN (12 BULAN TERAKHIR) ======
        $dataGrafikBulanan = [];
        for ($i = 11; $i >= 0; $i--) {
            $bulanData = date('m', strtotime("-$i months"));
            $tahunData = date('Y', strtotime("-$i months"));
            
            $dataGrafikBulanan[] = [
                'bulan' => date('M Y', strtotime("-$i months")),
                'pemasukan' => $transaksiModel->getTotalPemasukan($bulanData, $tahunData),
                'pengeluaran' => $transaksiModel->getTotalPengeluaran($bulanData, $tahunData)
            ];
        }

        // ====== DATA GRAFIK MINGGUAN (4 MINGGU TERAKHIR) ======
        $dataGrafikMingguan = [];
        for ($i = 3; $i >= 0; $i--) {
            $startDate = date('Y-m-d', strtotime("-$i weeks monday"));
            $endDate = date('Y-m-d', strtotime("-$i weeks sunday"));
            
            $dataGrafikMingguan[] = [
                'minggu' => 'Minggu ' . (4 - $i),
                'periode' => date('d M', strtotime($startDate)) . ' - ' . date('d M', strtotime($endDate)),
                'pemasukan' => $transaksiModel->getTotalPemasukanByDateRange($startDate, $endDate),
                'pengeluaran' => $transaksiModel->getTotalPengeluaranByDateRange($startDate, $endDate)
            ];
        }

        // ====== TRANSAKSI TERBARU ======
        $transaksiTerbaru = $transaksiModel
            ->orderBy('tanggal', 'DESC')
            ->limit(10)
            ->find();

        // ====== TOP KATEGORI PENGELUARAN ======
        $topPengeluaran = $transaksiModel
            ->select('kategori, SUM(nominal) as total')
            ->where('jenis_transaksi', 'Pengeluaran')
            ->where('YEAR(tanggal)', $tahun)
            ->where('MONTH(tanggal)', $bulan)
            ->groupBy('kategori')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->find();

        $data = [
            "title" => "Dashboard Admin",
            "pemasukanBulanan" => $pemasukanBulanan,
            "pengeluaranBulanan" => $pengeluaranBulanan,
            "pemasukanTahunan" => $pemasukanTahunan,
            "pengeluaranTahunan" => $pengeluaranTahunan,
            "saldoBulanan" => $pemasukanBulanan - $pengeluaranBulanan,
            "saldoTahunan" => $pemasukanTahunan - $pengeluaranTahunan,
            "dataGrafikBulanan" => json_encode($dataGrafikBulanan),
            "dataGrafikMingguan" => json_encode($dataGrafikMingguan),
            "transaksiTerbaru" => $transaksiTerbaru,
            "topPengeluaran" => $topPengeluaran
        ];

        return view('admin/dashboard', $data);
    }
    
    public function profile()
    {
        $data = [
            "title" => "Profile Sekolah"
        ];
        return view('admin/profile', $data);
    }
    
    public function KasPengeluaran()
    {
        $data = [
            "title" => "Data Kas Pengeluaran"
        ];
        return view('admin/kas-keluar/kas-pengeluaran', $data);
    }
    
    public function InputKasPengeluaran()
    {
        $data = [
            "title" => "Input Data Kas Pengeluaran"
        ];
        return view('admin/kas-keluar/input-kas-pengeluaran', $data);
    }
}