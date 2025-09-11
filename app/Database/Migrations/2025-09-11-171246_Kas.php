<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'jenis_kas' => [
                'type' => 'ENUM',
                'constraint' => ['Pemasukan', 'Pengeluaran'],
                'default' => 'Pemasukan',
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'nominal' => [
                'type' => 'DECIMAL',
                'constraint' => 12, 2
            ],
            'keterangan' => [
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

        $this->forge->addKey('id_kas', true);
        $this->forge->createTable('kas');
    }

    public function down()
    {
        $this->forge->dropTable("kas", true);
    }
}
