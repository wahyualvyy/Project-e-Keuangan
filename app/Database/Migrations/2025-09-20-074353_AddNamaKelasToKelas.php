<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNamaKelasToKelas extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kelas', [
            'nama_kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'id_kelas',  
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kelas', 'nama_kelas');
    }
}
