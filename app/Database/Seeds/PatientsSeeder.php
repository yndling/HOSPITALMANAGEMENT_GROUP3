<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PatientsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'John Doe',  'age' => 30, 'gender' => 'Male',   'address' => 'City A', 'phone' => '09171234567'],
            ['name' => 'Jane Smith','age' => 27, 'gender' => 'Female', 'address' => 'City B', 'phone' => '09179876543'],
        ];

        $this->db->table('patients')->insertBatch($data);
    }
}
