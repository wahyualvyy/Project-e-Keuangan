<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class KelasSeeder extends Seeder
{
    public function run()
    {
        // 1. Inisialisasi Faker Factory
        $faker = \Faker\Factory::create('id_ID');

        // 2. Ambil semua ID yang valid dari tabel relasi (jurusan dan guru)
        // Ini adalah langkah PENTING untuk memastikan data foreign key valid.
        $jurusanIds = $this->db->table('jurusan')->select('id_jurusan')->get()->getResultArray();
        $guruIds = $this->db->table('guru')->select('id_guru')->get()->getResultArray();

        // Konversi array of objects ke array biasa
        $jurusanIds = array_column($jurusanIds, 'id_jurusan');
        $guruIds = array_column($guruIds, 'id_guru');

        // 3. Hentikan seeder jika tidak ada data guru atau jurusan
        // untuk menghindari error.
        if (empty($jurusanIds) || empty($guruIds)) {
            echo "Data jurusan atau guru tidak ditemukan. Harap jalankan JurusanSeeder dan GuruSeeder terlebih dahulu.\n";
            return;
        }

        // 4. Siapkan data dummy untuk di-generate
        $data = [];
        $tingkatKelas = ['X', 'XI', 'XII'];

        // Generate 15 data kelas dummy
        for ($i = 0; $i < 15; $i++) {
            // Ambil id jurusan dan id guru secara acak dari data yang ada
            $randomJurusanId = $faker->randomElement($jurusanIds);
            $randomGuruId = $faker->randomElement($guruIds);
            
            // Dapatkan singkatan jurusan untuk nama kelas yang lebih realistis
            $jurusan = $this->db->table('jurusan')->where('id_jurusan', $randomJurusanId)->get()->getRow();
            
            $data[] = [
                'id_jurusan'  => $randomJurusanId,
                'id_guru'     => $randomGuruId,
                'nama_kelas'  => $faker->randomElement($tingkatKelas) . ' ' . ($jurusan->singkatan ?? 'JRS') . ' ' . $faker->numberBetween(1, 4),
                'created_at'  => Time::now(),
                'updated_at'  => Time::now(),
            ];
        }

        // 5. Menggunakan Query Builder untuk insert semua data sekaligus
        // Hapus data lama (opsional, tapi disarankan untuk seeding)
        $this->db->table('kelas')->truncate(); 
        
        // Masukkan data baru
        $this->db->table('kelas')->insertBatch($data);

        echo "Seeding tabel 'kelas' berhasil. 15 data baru ditambahkan.\n";
    }
}
