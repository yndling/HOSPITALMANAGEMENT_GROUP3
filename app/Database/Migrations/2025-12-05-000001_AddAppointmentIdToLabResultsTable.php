<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAppointmentIdToLabResultsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('lab_results', [
            'appointment_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id',
            ],
        ]);

        // Add foreign key constraint
        $this->forge->addForeignKey('appointment_id', 'appointments', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        // Drop foreign key first
        $this->forge->dropForeignKey('lab_results', 'lab_results_appointment_id_foreign');

        // Drop the column
        $this->forge->dropColumn('lab_results', 'appointment_id');
    }
}
