<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembayaranGajiMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pembayaran_gaji' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_gaji' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'tanggal_bayar' => [
                'type' => 'DATE',
            ],
            'status_pembayaran' => [
                'type' => 'ENUM',
                'constraint' => ['Lunas', 'Belum Lunas'],
                'default' => 'Belum Lunas',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addForeignKey('id_gaji', 'gaji', 'id_gaji', 'CASCADE', 'CASCADE');
        $this->forge->addKey('id_pembayaran_gaji', true);
        $this->forge->createTable('pembayaran_gaji');
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran_gaji', true);
    }
}
