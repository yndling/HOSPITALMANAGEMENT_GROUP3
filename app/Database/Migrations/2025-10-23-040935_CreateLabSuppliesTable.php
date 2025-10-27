<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLabSuppliesTable extends Migration
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
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['consumable', 'equipment', 'reagent', 'disposable'],
            ],
            'manufacturer' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'batch_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'expiry_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'unit' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'pieces',
            ],
            'unit_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'min_stock_level' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 5,
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
            'storage_conditions' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive', 'expired', 'damaged'],
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
        $this->forge->createTable('lab_supplies');
    }

    public function down()
    {
        $this->forge->dropTable('lab_supplies');
    }
}
