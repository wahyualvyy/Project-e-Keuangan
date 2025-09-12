<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKelasIdToSiswa extends Migration
{
    public function up()
    {
        $this->forge->addColumn('siswa', [
            'id_kelas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'after' => 'id_jurusan',
            ],
        ]);
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id_kelas', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropColumn('siswa', 'id_kelas');
        $this->forge->dropForeignKey('siswa', 'id_kelas');
    }
}
