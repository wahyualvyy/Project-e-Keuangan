<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembayaranSemesterMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pembayaran_semester' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_semester' => [
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
        $this->forge->addKey('id_pembayaran_semester', true);
        $this->forge->addForeignKey('id_semester', 'semester', 'id_semester', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pembayaran_semester'); 
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran_semester', true);   }
}
