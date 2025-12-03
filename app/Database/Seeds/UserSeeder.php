<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Truncate table to avoid duplicates
        $this->db->table('users')->truncate();

        $data = [
            [
                'email'         => 'admin@hms.com',
                'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'          => 'admin',
                'name'          => 'Hospital Administrator',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'email'         => 'doctor@hms.com',
                'password_hash' => password_hash('doctor123', PASSWORD_DEFAULT),
                'role'          => 'doctor',
                'name'          => 'Dr. John Doe',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'email'         => 'nurse@hms.com',
                'password_hash' => password_hash('nurse123', PASSWORD_DEFAULT),
                'role'          => 'nurse',
                'name'          => 'Jane Smith',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
