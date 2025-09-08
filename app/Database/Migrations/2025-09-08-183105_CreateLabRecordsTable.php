<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLabRecordsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT','constraint' => 11,'unsigned' => true,'auto_increment' => true],
            'patient'    => ['type' => 'VARCHAR','constraint' => 100],
            'test'       => ['type' => 'VARCHAR','constraint' => 100],
            'date'       => ['type' => 'DATE'],
            'created_at' => ['type' => 'DATETIME','null' => true],
            'updated_at' => ['type' => 'DATETIME','null' => true],
            'deleted_at' => ['type' => 'DATETIME','null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('lab_records');
    }

    public function down()
    {
        $this->forge->dropTable('lab_records');
    }
}
