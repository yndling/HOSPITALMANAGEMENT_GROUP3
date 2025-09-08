<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLabResultsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT','constraint' => 11,'unsigned' => true,'auto_increment' => true],
            'patient'    => ['type' => 'VARCHAR','constraint' => 100],
            'test'       => ['type' => 'VARCHAR','constraint' => 100],
            'result'     => ['type' => 'TEXT','null' => true],
            'created_at' => ['type' => 'DATETIME','null' => true],
            'updated_at' => ['type' => 'DATETIME','null' => true],
            'deleted_at' => ['type' => 'DATETIME','null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('lab_results');
    }

    public function down()
    {
        $this->forge->dropTable('lab_results');
    }
}
