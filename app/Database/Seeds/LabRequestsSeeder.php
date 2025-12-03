<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LabRequestsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['patient' => 'Erin Pogi', 'test' => 'Blood Test', 'status' => 'Pending'],
            ['patient' => 'Jane Smith', 'test' => 'Urine Test', 'status' => 'Pending'],
        ];

        $this->db->table('lab_requests')->insertBatch($data);
    }
}
