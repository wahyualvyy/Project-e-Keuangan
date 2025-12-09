<?php

namespace App\Commands;

use App\Models\GajiModel;
use App\Models\GuruModel;
use App\Models\PembayaranGajiModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class GeneratePembayaranGaji extends BaseCommand
{
    protected $group = 'GAJI';
    protected $name = 'gaji:generate-pembayaran';
    protected $description = 'Generate pembayaran Gaji otomatis setiap bulan';
    public function run(array $params)
    {
        $bulan = date('Y-m'); // Bulan sekarang
        $gajiModel = new GajiModel();
        $guruModel = new GuruModel();
        $pembayaranModel = new PembayaranGajiModel();

        // Ambil semua data gaji (guru yang memiliki data gaji)
        $gajiList = $gajiModel->findAll();

        foreach ($gajiList as $gaji) {
            // Cek apakah sudah ada pembayaran bulan ini untuk gaji ini
            $cek = $pembayaranModel
                ->where('id_gaji', $gaji['id_gaji'])
                ->where('MONTH(created_at)', date('m'))
                ->where('YEAR(created_at)', date('Y'))
                ->first();

            if (!$cek) {
                $pembayaranModel->insert([
                    'id_gaji' => $gaji['id_gaji'],
                    'tanggal_bayar' => null,
                    'status_pembayaran' => 'Belum Lunas',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
        CLI::write('Generate pembayaran Gaji bulan ' . $bulan . ' selesai.', 'green');
    }
}
