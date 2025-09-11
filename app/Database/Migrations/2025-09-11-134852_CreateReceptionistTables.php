<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReceptionistTables extends Migration
{
    public function up()
    {
        // Patients table
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 150],
            'age'        => ['type' => 'INT', 'constraint' => 3, 'null' => true],
            'gender'     => ['type' => 'ENUM("Male","Female")', 'null' => true],
            'address'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'contact'    => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('patients', true);

        // Appointments table
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'patient_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'doctor'     => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'date'       => ['type' => 'DATE', 'null' => true],
            'time'       => ['type' => 'TIME', 'null' => true],
            'status'     => ['type' => 'ENUM("Pending","Approved","Completed","Cancelled")', 'default' => 'Pending'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('patient_id', 'patients', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('appointments', true);
    }

    public function down()
    {
        $this->forge->dropTable('appointments', true);
        $this->forge->dropTable('patients', true);
    }
}
