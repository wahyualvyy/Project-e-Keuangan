<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GajiMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_gaji' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_guru' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'jam_mengajar'=> [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'nominal' => [
                'type' => 'DECIMAL',
                'constraint' => 12, 2
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
        $this->forge->addKey('id_gaji', true);
        $this->forge->addForeignKey('id_guru', 'guru', 'id_guru', 'CASCADE', 'CASCADE');
        $this->forge->createTable('gaji');
    }

    public function down()
    {
        $this->forge->dropTable("gaji", true);
    }
}
