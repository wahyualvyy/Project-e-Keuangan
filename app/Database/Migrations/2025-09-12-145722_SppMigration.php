<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SppMigration extends Migration
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
            'tanggal_bayar'=> [ 
                'type' => 'DATE',
                'null' => true
            ],
            'bulan'=> [
                'type'=> 'TINYINT',
                'null' => true
            ],
            'tahun'=> [
                'type' => 'YEAR',
                'null' => true
            ],
            'tahun_ajaran'=> [
                'type' => 'VARCHAR',
                'constraint' => 9,
                'null' => true
            ],
            'nominal' => [
                'type' => 'DECIMAL',
                'constraint' => 12, 2
            ],
            'status'=> [
                'type' => 'ENUM',
                'constraint' => ['Lunas', 'Belum Lunas'],
                'default' => 'Belum Lunas',
                'null' => true
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
