<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Spp extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_spp' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'tahun_mulai' => [
                'type' => 'VARCHAR',
                'constraint' => 4,
            ],
            'tahun_akhir' => [
                'type' => 'VARCHAR',
                'constraint' => 4,
            ],
            'nominal' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status'=> [
                'type' => 'ENUM',
                'constraint' => ['Lunas', 'Belum Lunas'],
                'default' => 'Belum Lunas',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id_spp', true);
        $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('spp');
    }

    public function down()
    {
        $this->forge->dropTable("spp", true);
    }
}
