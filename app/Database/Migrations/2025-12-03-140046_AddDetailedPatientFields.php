<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetailedPatientFields extends Migration
{
    public function up()
    {
        $this->forge->addColumn('patients', [
            'patient_id' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => true,
                'null' => true,
                'after' => 'id'
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
                'after' => 'patient_id'
            ],
            'middle_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
                'after' => 'first_name'
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
                'after' => 'middle_name'
            ],
            'date_of_birth' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'last_name'
            ],
            'blood_type' => [
                'type' => 'ENUM',
                'constraint' => ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'],
                'null' => true,
                'after' => 'gender'
            ],
            'civil_status' => [
                'type' => 'ENUM',
                'constraint' => ['Single', 'Married', 'Divorced', 'Widowed'],
                'null' => true,
                'after' => 'blood_type'
            ],
            'nationality' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
                'after' => 'civil_status'
            ],
            'contact_number' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
                'after' => 'nationality'
            ],
            'email_address' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
                'after' => 'contact_number'
            ],
            'home_address' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'email_address'
            ],
            'emergency_contact_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
                'after' => 'home_address'
            ],
            'emergency_relationship' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
                'after' => 'emergency_contact_name'
            ],
            'emergency_contact_number' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
                'after' => 'emergency_relationship'
            ],
            'emergency_address' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'emergency_contact_number'
            ],
            'medical_history' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'emergency_address'
            ],
            'current_medications' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'medical_history'
            ],
            'allergies' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'current_medications'
            ],
            'past_surgeries' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'allergies'
            ],
            'chronic_conditions' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'past_surgeries'
            ],
            'family_medical_history' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'chronic_conditions'
            ]
        ]);

        // Drop old columns that are being replaced
        $this->forge->dropColumn('patients', 'name');
        $this->forge->dropColumn('patients', 'address');
        $this->forge->dropColumn('patients', 'contact');
    }

    public function down()
    {
        // Add back the old columns
        $this->forge->addColumn('patients', [
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'after' => 'id'
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
                'after' => 'gender'
            ],
            'contact' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
                'after' => 'address'
            ]
        ]);

        // Drop the new columns
        $this->forge->dropColumn('patients', [
            'patient_id',
            'first_name',
            'middle_name',
            'last_name',
            'date_of_birth',
            'blood_type',
            'civil_status',
            'nationality',
            'contact_number',
            'email_address',
            'home_address',
            'emergency_contact_name',
            'emergency_relationship',
            'emergency_contact_number',
            'emergency_address',
            'medical_history',
            'current_medications',
            'allergies',
            'past_surgeries',
            'chronic_conditions',
            'family_medical_history'
        ]);
    }
}
