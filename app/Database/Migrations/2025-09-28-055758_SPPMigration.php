<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SPPMigration extends Migration
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
            'tahun_ajaran' => [
                'type' => 'VARCHAR',
                'constraint' => 9,
            ],
            'biaya_spp' => [
                'type' => 'decimal',
                'constraint' => '12,2',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Aktif', 'Tidak Aktif'],
                'default' => 'Tidak Aktif',
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
        $this->forge->createTable('spp');
    }

    public function down()
    {
        $this->forge->dropTable('spp', true);
    }
}
