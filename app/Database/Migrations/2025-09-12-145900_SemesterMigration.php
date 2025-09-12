<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SemesterMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_semester' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_jurusan' => [
                'type' => 'INT',
                'constraint'=> 11,
                'unsigned' => true,
            ],
            'tahun_ajaran' => [
                'type' => 'VARCHAR',
                'constraint' => 9,
            ],
            'biaya_semester'=> [
                'type' => 'INT',
                'constraint' => 11,
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

        $this->forge->addKey('id_semester', true);
        $this->forge->addForeignKey('id_jurusan', 'jurusan', 'id_jurusan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('semester');
    }

    public function down()
    {
        $this->forge->dropTable('semester', true);
    }
}
