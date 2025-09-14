<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKeteranganToJurusan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('jurusan',[
            "keterangan" => [
                "type"=> "text",
                "after"=> "kode_jurusan"
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn("jurusan","keterangan");
    }
}
