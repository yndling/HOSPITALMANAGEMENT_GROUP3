<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAppointmentIdToLabRequestsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('lab_requests', [
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
        $this->forge->dropForeignKey('lab_requests', 'lab_requests_appointment_id_foreign');

        // Drop the column
        $this->forge->dropColumn('lab_requests', 'appointment_id');
    }
}
