<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'           => 'Dr. John Smith',
                'email'          => 'john.smith@hospital.com',
                'role'           => 'doctor',
                'department'     => 'Cardiology',
                'specialization' => 'Cardiologist',
                'contact'        => '09171234567',
                'address'        => '123 Medical Center, City A',
                'salary'         => 150000.00,
                'status'         => 'active'
            ],
            [
                'name'           => 'Sarah Johnson',
                'email'          => 'sarah.johnson@hospital.com',
                'role'           => 'nurse',
                'department'     => 'Emergency',
                'specialization' => 'Emergency Care',
                'contact'        => '09179876543',
                'address'        => '456 Hospital Street, City B',
                'salary'         => 45000.00,
                'status'         => 'active'
            ],
            [
                'name'           => 'Mike Davis',
                'email'          => 'mike.davis@hospital.com',
                'role'           => 'receptionist',
                'department'     => 'Administration',
                'specialization' => null,
                'contact'        => '09175678901',
                'address'        => '789 Reception Ave, City C',
                'salary'         => 25000.00,
                'status'         => 'active'
            ],
            [
                'name'           => 'Dr. Emily Chen',
                'email'          => 'emily.chen@hospital.com',
                'role'           => 'doctor',
                'department'     => 'Pediatrics',
                'specialization' => 'Pediatrician',
                'contact'        => '09173456789',
                'address'        => '321 Children\'s Wing, City D',
                'salary'         => 140000.00,
                'status'         => 'active'
            ],
            [
                'name'           => 'Robert Wilson',
                'email'          => 'robert.wilson@hospital.com',
                'role'           => 'accountant',
                'department'     => 'Finance',
                'specialization' => null,
                'contact'        => '09172345678',
                'address'        => '654 Finance Dept, City E',
                'salary'         => 55000.00,
                'status'         => 'active'
            ],
            [
                'name'           => 'Lisa Brown',
                'email'          => 'lisa.brown@hospital.com',
                'role'           => 'pharmacist',
                'department'     => 'Pharmacy',
                'specialization' => 'Clinical Pharmacy',
                'contact'        => '09171239876',
                'address'        => '987 Pharmacy Lane, City F',
                'salary'         => 60000.00,
                'status'         => 'active'
            ],
            [
                'name'           => 'Admin User',
                'email'          => 'admin@hospital.com',
                'role'           => 'admin',
                'department'     => 'Administration',
                'specialization' => null,
                'contact'        => '09170000000',
                'address'        => '1 Admin Building, City G',
                'salary'         => 80000.00,
                'status'         => 'active'
            ]
        ];

        $this->db->table('staff')->insertBatch($data);
    }
}
