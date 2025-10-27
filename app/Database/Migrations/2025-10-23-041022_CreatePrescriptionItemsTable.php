<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePrescriptionItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'prescription_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'medicine_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'dosage' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'frequency' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'duration' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'instructions' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'unit_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'total_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'dispensed_quantity' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'partial', 'dispensed'],
                'default' => 'pending',
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
        $this->forge->addForeignKey('prescription_id', 'prescriptions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('medicine_id', 'medicines', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('prescription_items');
    }

    public function down()
    {
        $this->forge->dropTable('prescription_items');
    }
}
