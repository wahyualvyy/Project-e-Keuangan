<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\SppModel;
use App\Models\SiswaModel;
use App\Models\PembayaranSPPModel;

class GeneratePembayaranSPP extends BaseCommand
{
    protected $group       = 'SPP';
    protected $name        = 'spp:generate-pembayaran';
    protected $description = 'Generate pembayaran SPP otomatis setiap bulan';

    public function run(array $params)
    {
        $bulan = date('Y-m'); // Bulan sekarang
        $sppModel = new SppModel();
        $siswaModel = new SiswaModel();
        $pembayaranModel = new PembayaranSPPModel();

        $sppAktif = $sppModel->where('status', 'Aktif')->findAll();
        $siswaAktif = $siswaModel->where('status', 'Aktif')->findAll();

        foreach ($sppAktif as $spp) {
            foreach ($siswaAktif as $siswa) {
                // Cek apakah sudah ada pembayaran bulan ini
                $cek = $pembayaranModel
                    ->where('id_spp', $spp['id_spp'])
                    ->where('id_siswa', $siswa['id_siswa'])
                    ->where('MONTH(tanggal_bayar)', date('m'))
                    ->where('YEAR(tanggal_bayar)', date('Y'))
                    ->first();

                if (!$cek) {
                    $pembayaranModel->insert([
                        'id_spp' => $spp['id_spp'],
                        'id_siswa' => $siswa['id_siswa'],
                        'tanggal_bayar' => null,
                        'status_pembayaran' => 'Belum Lunas',
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }

        CLI::write('Generate pembayaran SPP bulan ' . $bulan . ' selesai.', 'green');
    }
}