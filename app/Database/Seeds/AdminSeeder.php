<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $userModel  = new UserModel();
        $groupModel = new GroupModel();

        // Cek apakah user admin sudah ada
        $admin = $userModel->where('email', 'admin@example.com')->first();

        if (! $admin) {
            // Insert user baru
            $userId = $userModel->insert([
                'email'         => 'admin@example.com',
                'username'      => 'admin',
                'password'      => 'admin123',   // ⬅️ Gunakan 'password', biar otomatis di-hash
                'active'        => 1,
            ]);
        } else {
            $userId = $admin->id;
        }

        // Pastikan group admin ada
        $db      = \Config\Database::connect();
        $builder = $db->table('auth_groups');
        $group   = $builder->where('name', 'admin')->get()->getRow();

        if (! $group) {
            $builder->insert([
                'name'        => 'admin',
                'description' => 'Administrator',
            ]);
            $groupId = $db->insertID();
        } else {
            $groupId = $group->id;
        }

        // Tambahkan user ke group admin
        $groupModel->addUserToGroup($userId, $groupId);
    }
}
