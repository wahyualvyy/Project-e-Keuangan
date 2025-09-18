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
            'email'    => 'admin@example.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('users')->insert($adminData);

        // Create test users using Faker
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            $data = [
                'username' => $faker->userName . $i, // Add number to avoid duplicates
                'email'    => $faker->unique()->safeEmail,
                'password' => password_hash('password123', PASSWORD_DEFAULT), // Same password for all test users
                'is_active' => $faker->randomElement([0, 1]),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            
            // Using Query Builder
            $this->db->table('users')->insert($data);
        }

        echo "Default admin user created:\n";
        echo "Username: admin\n";
        echo "Password: admin123\n";
        echo "Email: admin@example.com\n\n";
        echo "10 test users created with password: password123\n";
    }
}