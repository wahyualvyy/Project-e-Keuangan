<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory as Faker;

class GuruSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create("id_ID");
        for ($i = 0; $i < 50; $i++) {
            $data = [
                'nama_guru' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'bidang_studi' => $faker->randomElement(['Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'Fisika', 'Kimia', 'Biologi', 'Sejarah', 'Geografi', 'Ekonomi', 'Seni Budaya', 'Pendidikan Jasmani']),
                'alamat' => $faker->address,
                'nip' => $faker->unique()->numerify('##########'),
                'no_telp' => $faker->phoneNumber,
                'status' => $faker->randomElement(['Aktif', 'Tidak Aktif', 'Cuti']),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            // Using Query Builder
            $this->db->table('guru')->insert($data);
        }
    }

}
