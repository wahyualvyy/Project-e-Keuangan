<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembayaranSPPMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pembayaran_spp' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_spp' => [
                'type' => 'INT',
                'constraint'=> 11,
                'unsigned' => true,
            ],
            'id_siswa' => [
                'type' => 'INT',
                'constraint'=> 11,
                'unsigned' => true,
            ],
            'tanggal_bayar' => [
                'type' => 'DATETIME',
                'null' => true,
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
            ]
        ]);
        
        $this->forge->addForeignKey('id_spp', 'spp', 'id_spp', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->addKey('id_pembayaran_spp', true);
        $this->forge->createTable('pembayaran_spp');
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran_spp', true);
    }
}
