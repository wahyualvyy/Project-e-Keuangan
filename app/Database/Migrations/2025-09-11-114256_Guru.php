<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Guru extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_guru' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_guru' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'jenis_kelamin'=> [
                'type' => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
                'default' => 'Laki-laki',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => 18,
                'unique' => true,
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Aktif', 'Tidak Aktif', 'Cuti'],
                'default' => 'Aktif',
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

        $this->forge->addKey('id_guru', true);
        $this->forge->createTable('guru');
        $this->forge->addUniqueKey('nip'); 
    }

    public function down()
    {
        $this->forge->dropTable("guru", true);
    }
}
