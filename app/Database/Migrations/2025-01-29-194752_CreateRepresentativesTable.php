<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRepresentativesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'customer_id' => ['type' => 'INT'],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'surname'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone'       => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'email'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('representatives');
    }

    public function down()
    {
        $this->forge->dropTable('representatives');
    }
}
