<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'patient_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'doctor' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'time' => [
                'type' => 'TIME',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'Pending',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('patient_id', 'patients', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('appointments');
    }

    public function down()
    {
        $this->forge->dropTable('appointments');
    }
}
