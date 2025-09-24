<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory as Faker;
use CodeIgniter\I18n\Time;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create("id_ID");

        // ambil semua id kelas yang ada
        $kelasIds = array_column(
            $this->db->table('kelas')->select('id_kelas')->get()->getResultArray(),
            'id_kelas'
        );

        if (empty($kelasIds)) {
            echo "Seeder gagal: pastikan kelas sudah ada.\n";
            return;
        }

        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'id_kelas'      => $faker->randomElement($kelasIds),
                'nama_siswa'    => $faker->name,
                'nis'           => $faker->unique()->numerify('20########'),
                'nisn'          => $faker->unique()->numerify('00########'),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir'  => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2010-12-31'),
                'alamat'        => $faker->address,
                'no_telp'       => $faker->phoneNumber,
                'status'        => $faker->randomElement(['Aktif', 'Tidak Aktif', 'Cuti']),
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ];
        }

        $this->db->table('siswa')->truncate();
        $this->db->table('siswa')->insertBatch($data);

        echo "Seeder siswa sukses: 100 data ditambahkan.\n";
    }
}
