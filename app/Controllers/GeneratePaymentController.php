<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GeneratePaymentController extends BaseController
{
    // Trigger SPP generation (monthly)
    public function spp()
    {
        try {
            $bulan = date('Y-m');
            $bulanIni = date('Y-m');
            $sppModel = new \App\Models\SppModel();
            $siswaModel = new \App\Models\SiswaModel();
            $pembayaranModel = new \App\Models\PembayaranSPPModel();
            $db = \Config\Database::connect();

            $sppAktif = $sppModel->where('status', 'Aktif')->findAll();
            $siswaAktif = $siswaModel->where('status', 'Aktif')->findAll();
            $created = 0;

            foreach ($sppAktif as $spp) {
                foreach ($siswaAktif as $siswa) {
                    // Check if payment already exists for this month
                    $query = $db->table('pembayaran_spp')
                        ->where('id_spp', $spp['id_spp'])
                        ->where('id_siswa', $siswa['id_siswa'])
                        ->where("DATE_FORMAT(created_at, '%Y-%m')", $bulanIni)
                        ->get();
                    $cek = $query->getRowArray();

                    if (!$cek) {
                        $pembayaranModel->insert([
                            'id_spp' => $spp['id_spp'],
                            'id_siswa' => $siswa['id_siswa'],
                            'tanggal_bayar' => null,
                            'status_pembayaran' => 'Belum Lunas',
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                        $created++;
                    }
                }
            }

            $output = "Generate pembayaran SPP bulan {$bulan} selesai. Dibuat {$created} data pembayaran baru.";
        } catch (\Throwable $e) {
            $output = 'Error: ' . $e->getMessage();
        }

        session()->setFlashdata('success', nl2br($output));
        return redirect()->back();
    }

    // Trigger Semester generation (one payment per student per semester)
    public function semester($nomorSemester = null)
    {
        try {
            $semesterModel = new \App\Models\SemesterModel();
            $siswaModel = new \App\Models\SiswaModel();
            $pembayaranModel = new \App\Models\PembayaranSemesterModel();

            // Build query for active semesters
            $query = $semesterModel->where('status', 'Aktif');

            // Filter by specific semester if provided
            if ($nomorSemester) {
                $query = $query->where('nomor_semester', $nomorSemester);
            }

            $semesterAktif = $query->findAll();
            $siswaAktif = $siswaModel->where('status', 'Aktif')->findAll();
            $created = 0;

            foreach ($semesterAktif as $semester) {
                foreach ($siswaAktif as $siswa) {
                    // Check if payment already exists for this student in this semester
                    $cek = $pembayaranModel
                        ->where('id_semester', $semester['id_semester'])
                        ->where('id_siswa', $siswa['id_siswa'])
                        ->first();

                    if (!$cek) {
                        $pembayaranModel->insert([
                            'id_semester' => $semester['id_semester'],
                            'id_siswa' => $siswa['id_siswa'],
                            'tanggal_bayar' => null,
                            'status_pembayaran' => 'Belum Lunas',
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                        $created++;
                    }
                }
            }

            $semesterText = $nomorSemester ? "Semester {$nomorSemester}" : "Semester";
            $output = "Generate pembayaran {$semesterText} selesai. Dibuat {$created} data pembayaran baru.";
        } catch (\Throwable $e) {
            $output = 'Error: ' . $e->getMessage();
        }

        session()->setFlashdata('success', nl2br($output));
        return redirect()->back();
    }

    // Trigger Gaji generation (monthly)
    public function gaji()
    {
        try {
            $bulanIni = date('Y-m');
            $gajiModel = new \App\Models\GajiModel();
            $pembayaranModel = new \App\Models\PembayaranGajiModel();
            $db = \Config\Database::connect();

            $gajiList = $gajiModel->findAll();
            $created = 0;

            foreach ($gajiList as $gaji) {
                // Check if payment already exists for this month
                $query = $db->table('pembayaran_gaji')
                    ->where('id_gaji', $gaji['id_gaji'])
                    ->where("DATE_FORMAT(created_at, '%Y-%m')", $bulanIni)
                    ->get();
                $cek = $query->getRowArray();

                if (!$cek) {
                    $pembayaranModel->insert([
                        'id_gaji' => $gaji['id_gaji'],
                        'tanggal_bayar' => null,
                        'status_pembayaran' => 'Belum Lunas',
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    $created++;
                }
            }

            $output = "Generate pembayaran Gaji selesai. Dibuat {$created} data pembayaran baru.";
        } catch (\Throwable $e) {
            $output = 'Error: ' . $e->getMessage();
        }

        session()->setFlashdata('success', nl2br($output));
        return redirect()->back();
    }
}