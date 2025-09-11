<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
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
            'nama_kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'kompetensi_keahlian' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'nama_wali' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'keterangan'=> [
                'type' => 'TEXT',
                'null' => true,
            ],
            'id_guru'=> [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
        $this->forge->addForeignKey('id_guru', 'guru', 'id_guru', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kelas');
    }

    public function down()
    {
        $this->forge->dropTable("kelas", true);
    }
}
