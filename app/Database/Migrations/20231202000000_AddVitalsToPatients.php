<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVitalsToPatients extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $columns = $db->getFieldNames('patients');
        
        $fields = [
            'blood_pressure' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'contact'
            ],
            'temperature' => [
                'type' => 'DECIMAL',
                'constraint' => '4,1',
                'null' => true,
                'after' => 'blood_pressure'
            ],
            'pulse' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true,
                'after' => 'temperature'
            ],
            'respiratory_rate' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true,
                'after' => 'pulse'
            ],
            'oxygen_level' => [
                'type' => 'TINYINT',
                'constraint' => 3,
                'null' => true,
                'after' => 'respiratory_rate'
            ],
            'weight' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => true,
                'after' => 'oxygen_level'
            ],
            'height' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => true,
                'after' => 'weight'
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'height'
            ]
        ];
        
        foreach ($fields as $column => $definition) {
            if (!in_array($column, $columns)) {
                $this->forge->addColumn('patients', [$column => $definition]);
            }
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $columns = $db->getFieldNames('patients');
        
        $fieldsToDrop = [
            'blood_pressure',
            'temperature',
            'pulse',
            'respiratory_rate',
            'oxygen_level',
            'weight',
            'height',
            'notes'
        ];
        
        foreach ($fieldsToDrop as $column) {
            if (in_array($column, $columns)) {
                $this->forge->dropColumn('patients', $column);
            }
        }
    }
}
