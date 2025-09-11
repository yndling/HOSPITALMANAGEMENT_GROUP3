<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PatientsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Erin Pogi',  'age' => 20, 'gender' => 'Male',   'address' => 'City A', 'phone' => '09171234567'],
            ['name' => 'Jane Smith','age' => 19, 'gender' => 'Female', 'address' => 'City B', 'phone' => '09179876543'],
        ];

        $this->db->table('patients')->insertBatch($data);
    }
}
