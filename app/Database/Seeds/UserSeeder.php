<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create default admin user
        $adminData = [
            'username' => 'admin',
            'email'    => 'admin@gmail.com',
            'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('users')->insert($adminData);


        echo "Default admin user created:\n";
        echo "Username: admin\n";
        echo "Password: admin123\n";
        echo "Email: admin@example.com\n\n";
    }
}