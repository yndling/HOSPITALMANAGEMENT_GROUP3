<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMedicinesTable extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'generic_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'dosage_form' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'strength' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'manufacturer' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'batch_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'expiry_date' => [
                'type' => 'DATE',
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'unit_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'selling_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'min_stock_level' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 10,
            ],
            'supplier' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive', 'expired'],
                'default' => 'active',
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
        $this->forge->createTable('medicines');
    }

    public function down()
    {
        $this->forge->dropTable('medicines');
    }
}
