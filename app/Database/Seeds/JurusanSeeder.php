<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            $data = [
                'nama_jurusan' => $faker->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Manajemen Informatika', 'Teknik Komputer', 'Rekayasa Perangkat Lunak']),
                'kode_jurusan' => strtoupper($faker->lexify('??')) . $faker->numerify('###'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            // Using Query Builder
            $this->db->table('jurusan')->insert($data);
        }
    }
}
