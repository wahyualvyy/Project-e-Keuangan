<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GajiMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_gaji' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_guru' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'biaya_gaji' => [
                'type'       => 'decimal',
                'constraint' => '12,2',
            ],
            'jumlah_jam' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'deleted_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addForeignKey('id_guru', 'guru', 'id_guru', 'CASCADE', 'CASCADE');
        $this->forge->addKey('id_gaji', true);
        $this->forge->createTable('gaji');
    }

    public function down()
    {
        $this->forge->dropTable('gaji', true);
    }
}
