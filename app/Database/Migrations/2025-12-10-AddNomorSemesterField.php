<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNomorSemesterField extends Migration
{
    public function up()
    {
        // Tambahkan field nomor_semester ke tabel semester
        $fields = [
            'nomor_semester' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '1 untuk Semester 1, 2 untuk Semester 2'
            ],
        ];
        $this->forge->addColumn('semester', $fields);
    }

    public function down()
    {
        // Hapus field nomor_semester dari tabel semester
        $this->forge->dropColumn('semester', 'nomor_semester');
    }
}
