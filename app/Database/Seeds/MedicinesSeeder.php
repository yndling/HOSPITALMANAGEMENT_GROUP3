<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MedicinesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Paracetamol',
                'generic_name' => 'Acetaminophen',
                'category' => 'Analgesic',
                'dosage_form' => 'Tablet',
                'strength' => '500mg',
                'manufacturer' => 'PharmaCorp',
                'batch_number' => 'PC2024001',
                'expiry_date' => '2026-12-31',
                'quantity' => 1000,
                'unit_price' => 0.50,
                'selling_price' => 1.00,
                'min_stock_level' => 100,
                'supplier' => 'Medical Supplies Ltd',
                'location' => 'Shelf A1',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Amoxicillin',
                'generic_name' => 'Amoxicillin',
                'category' => 'Antibiotic',
                'dosage_form' => 'Capsule',
                'strength' => '250mg',
                'manufacturer' => 'BioPharm',
                'batch_number' => 'BP2024002',
                'expiry_date' => '2026-06-30',
                'quantity' => 500,
                'unit_price' => 1.20,
                'selling_price' => 2.50,
                'min_stock_level' => 50,
                'supplier' => 'Pharma Distributors',
                'location' => 'Shelf B2',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Ibuprofen',
                'generic_name' => 'Ibuprofen',
                'category' => 'NSAID',
                'dosage_form' => 'Tablet',
                'strength' => '200mg',
                'manufacturer' => 'HealthMed',
                'batch_number' => 'HM2024003',
                'expiry_date' => '2026-08-15',
                'quantity' => 800,
                'unit_price' => 0.30,
                'selling_price' => 0.80,
                'min_stock_level' => 80,
                'supplier' => 'Medical Supplies Ltd',
                'location' => 'Shelf A3',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Omeprazole',
                'generic_name' => 'Omeprazole',
                'category' => 'Proton Pump Inhibitor',
                'dosage_form' => 'Capsule',
                'strength' => '20mg',
                'manufacturer' => 'GastroMed',
                'batch_number' => 'GM2024004',
                'expiry_date' => '2026-11-20',
                'quantity' => 300,
                'unit_price' => 2.00,
                'selling_price' => 4.00,
                'min_stock_level' => 30,
                'supplier' => 'Pharma Distributors',
                'location' => 'Shelf C1',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Aspirin',
                'generic_name' => 'Acetylsalicylic Acid',
                'category' => 'Analgesic',
                'dosage_form' => 'Tablet',
                'strength' => '75mg',
                'manufacturer' => 'CardioPharm',
                'batch_number' => 'CP2024005',
                'expiry_date' => '2026-09-10',
                'quantity' => 600,
                'unit_price' => 0.25,
                'selling_price' => 0.60,
                'min_stock_level' => 60,
                'supplier' => 'Medical Supplies Ltd',
                'location' => 'Shelf A2',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('medicines')->insertBatch($data);
    }
}
