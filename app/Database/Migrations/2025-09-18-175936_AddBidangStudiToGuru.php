<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBidangStudiToGuru extends Migration
{
    public function up()
    {
        $this->forge->addColumn('guru', [
            'bidang_studi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'jenis_kelamin' 
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('guru', 'bidang_studi');
    }
}
