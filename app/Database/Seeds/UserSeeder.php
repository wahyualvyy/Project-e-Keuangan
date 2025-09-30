<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // koneksi db via $this->db (tersedia dari Seeder)
        $usersTable = $this->db->table('users');

        $email = 'admin@gmail.com';
        $username = 'admin';

        // cek apakah user sudah ada
        $existing = $usersTable->where('email', $email)->get()->getRow();

        $now = date('Y-m-d H:i:s');

        $adminData = [
            'username'         => $username,
            'email'            => $email,
            'password_hash'    => password_hash('admin123', PASSWORD_DEFAULT),
            'reset_hash'       => null,
            'reset_at'         => null,
            'reset_expires'    => null,
            'activate_hash'    => null,
            'status'           => null,
            'status_message'   => null,
            'active'           => 1,
            'force_pass_reset' => 0,
            'created_at'       => $now,
            'updated_at'       => $now,
            'deleted_at'       => null,
        ];

        if ($existing) {
            // jika sudah ada, update supaya yakin active=1 dan password sesuai (opsional)
            $usersTable->where('id', $existing->id)->update($adminData);
            $userId = $existing->id;
            echo "User admin sudah ada — data diupdate.\n";
        } else {
            // insert baru
            $this->db->table('users')->insert($adminData);
            $userId = $this->db->insertID();
            echo "User admin berhasil dibuat.\n";
        }

        echo "Username: {$username}\n";
        echo "Password: admin123\n";
        echo "Email: {$email}\n\n";

        /*
         * (Optional tetapi direkomendasikan)
         * Buat grup 'admin' jika belum ada, lalu tautkan user ke grup tersebut
         * tabel: auth_groups, auth_groups_users
         */
        $groupsTable = $this->db->table('auth_groups');
        $groupName = 'admin';

        $group = $groupsTable->where('name', $groupName)->get()->getRow();

        if (!$group) {
            $groupsTable->insert([
                'name' => $groupName,
                'description' => 'Administrator',
            ]);
            $groupId = $this->db->insertID();
            echo "Grup 'admin' dibuat (id: {$groupId}).\n";
        } else {
            $groupId = $group->id;
            echo "Grup 'admin' sudah ada (id: {$groupId}).\n";
        }

        // tambah mapping user -> group kalau belum ada
        $groupsUsersTable = $this->db->table('auth_groups_users');
        $existsMap = $groupsUsersTable
            ->where('group_id', $groupId)
            ->where('user_id', $userId)
            ->get()
            ->getRow();

        if (!$existsMap) {
            $groupsUsersTable->insert([
                'group_id' => $groupId,
                'user_id'  => $userId,
            ]);
            echo "User di-assign ke grup 'admin'.\n";
        } else {
            echo "User sudah ter-assign di grup 'admin'.\n";
        }

        echo "\nSelesai.\n";
    }
}
