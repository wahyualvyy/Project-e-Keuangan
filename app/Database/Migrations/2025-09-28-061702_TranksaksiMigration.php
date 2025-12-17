<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TranksaksiMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_pembayaran_spp' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'id_pembayaran_semester' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'id_pembayaran_gaji' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'jenis_transaksi' => [
                'type' => 'ENUM',
                'constraint' => ['pemasukan', 'pengeluaran'],
            ],
            'kategori' => [
                'type' => 'ENUM',
                'constraint' => ['SPP', 'GAJI', 'SEMESTER', 'Lainnya'],
            ],
            'nominal' => [
                'type' => 'DECIMAL',
                'constraint' => [12, 2],
                'default' => 0.00,
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
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_transaksi', true);
        $this->forge->addForeignKey('id_pembayaran_spp', 'pembayaran_spp', 'id_pembayaran_spp', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pembayaran_semester', 'pembayaran_semester', 'id_pembayaran_semester', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pembayaran_gaji', 'pembayaran_gaji', 'id_pembayaran_gaji', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
