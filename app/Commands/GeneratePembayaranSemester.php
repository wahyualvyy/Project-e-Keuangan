<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\SemesterModel;
use App\Models\SiswaModel;
use App\Models\PembayaranSemesterModel;

class GeneratePembayaranSemester extends BaseCommand
{
    protected $group = 'Semester';
    protected $name = 'semester:generate-pembayaran';
    protected $description = 'Generate pembayaran Semester untuk semester yang baru diaktifkan';

    public function run(array $params)
    {
        $semesterModel = new SemesterModel();
        $siswaModel = new SiswaModel();
        $pembayaranModel = new PembayaranSemesterModel();

        // Ambil semua semester aktif
        $semesterAktif = $semesterModel->where('status', 'Aktif')->findAll();
        $siswaAktif = $siswaModel->where('status', 'Aktif')->findAll();

        $totalGenerated = 0;

        foreach ($semesterAktif as $semester) {
            foreach ($siswaAktif as $siswa) {
                // Cek apakah sudah ada pembayaran semester ini
                $cek = $pembayaranModel
                    ->where('id_semester', $semester['id_semester'])
                    ->where('id_siswa', $siswa['id_siswa'])
                    ->first();

                // Jika belum ada, buat pembayaran baru
                if (!$cek) {
                    $pembayaranModel->insert([
                        'id_semester' => $semester['id_semester'],
                        'id_siswa' => $siswa['id_siswa'],
                        'tanggal_bayar' => null,
                        'status_pembayaran' => 'Belum Lunas',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                    $totalGenerated++;
                }
            }
        }

        CLI::write("Generate pembayaran Semester selesai. Dibuat {$totalGenerated} data pembayaran baru.", 'green');
    }
}