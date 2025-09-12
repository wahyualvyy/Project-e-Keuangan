<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelasMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_jurusan' => [
                'type'=> 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_guru'=> [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'keterangan'=> [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->addKey('id_kelas', true);
        $this->forge->addForeignKey('id_jurusan', 'jurusan', 'id_jurusan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_guru', 'guru', 'id_guru', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kelas');
    }

    public function down()
    {
        $this->forge->dropTable("kelas", true);
    }
}
