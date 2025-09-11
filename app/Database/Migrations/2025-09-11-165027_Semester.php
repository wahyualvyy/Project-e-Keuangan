<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Semester extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
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
            'mulai_tahun_ajaran' => [
                'type' => 'YEAR'
            ],
            'sampai_tahun_ajaran'=> [
                'type' => 'YEAR'
            ],
            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nominal'=> [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Aktif', 'Tidak Aktif'],
                'default' => 'nonaktif',
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

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('semester');
    }

    public function down()
    {
        $this->forge->dropTable('semester', true);
    }
}
