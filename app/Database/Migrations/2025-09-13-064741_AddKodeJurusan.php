<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKodeJurusan extends Migration
{
    public function up()
    {
        $this->forge->addColumn("jurusan", [
            "kode_jurusan" => [
                "type" => "VARCHAR",
                "constraint" => 10,
                "after" => "nama_jurusan",
                "null" => true
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn("jurusan","kode_jurusan");
    }
}
