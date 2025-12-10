<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\SemesterModel;

class SetDefaultNomorSemester extends BaseCommand
{
    protected $group = 'Semester';
    protected $name = 'semester:set-default-nomor';
    protected $description = 'Set default nomor_semester = 1 for existing semester rows where null or empty';

    public function run(array $params)
    {
        $model = new SemesterModel();

        // Count rows without nomor_semester or with empty value
        $db = \Config\Database::connect();

        // Pastikan kolom ada: jika belum, tambahkan
        try {
            $db->query("ALTER TABLE `semester` ADD COLUMN IF NOT EXISTS `nomor_semester` TINYINT(1) DEFAULT 1 COMMENT '1 untuk Semester 1, 2 untuk Semester 2'");
        } catch (\Exception $e) {
            // Jika ALTER TABLE gagal karena versi MySQL tidak support IF NOT EXISTS,
            // coba tambahkan tanpa IF NOT EXISTS dan abaikan error jika kolom sudah ada.
            try {
                $db->query("ALTER TABLE `semester` ADD COLUMN `nomor_semester` TINYINT(1) DEFAULT 1 COMMENT '1 untuk Semester 1, 2 untuk Semester 2'");
            } catch (\Exception $e) {
                // Abaikan — kolom mungkin sudah ada atau gagal karena hak akses.
            }
        }

        // Update rows yang NULL atau kosong
        try {
            $res = $db->query("SELECT COUNT(*) AS cnt FROM `semester` WHERE nomor_semester IS NULL OR nomor_semester = ''")->getRowArray();
            $count = $res['cnt'] ?? 0;
        } catch (\Exception $e) {
            CLI::write('Gagal memeriksa kolom atau tabel semester: ' . $e->getMessage(), 'yellow');
            return;
        }

        if ($count == 0) {
            CLI::write('Tidak ada baris yang perlu diupdate.');
            return;
        }

        try {
            $db->query("UPDATE `semester` SET nomor_semester = 1 WHERE nomor_semester IS NULL OR nomor_semester = ''");
            CLI::write("Selesai. Diperbarui: {$count} baris.", 'green');
        } catch (\Exception $e) {
            CLI::write('Gagal mengupdate baris: ' . $e->getMessage(), 'red');
        }
    }
}
