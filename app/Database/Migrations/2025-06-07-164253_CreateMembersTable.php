<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMembersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
             'id'=> ['type' => 'INT', 'auto_increment' => true],
             'membership_number' => ['type' => 'VARCHAR', 'constraint' => '50'],
             'first_name' => ['type' => "VARCHAR", 'constraint' => '100'],
             'surname'           => ['type' => 'VARCHAR', 'constraint' => '100'],
             'email'             => ['type' => 'VARCHAR', 'constraint' => '150'],
             'phone'             => ['type' => 'VARCHAR', 'constraint' => '50'],
             'idta_pin'          => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
             'role'              => ['type' => 'ENUM', 'constraint' => ['Leader', 'Follower', 'Both']],
             'class_attended'    => ['type' => 'VARCHAR', 'constraint' => '100'],
             'notes'             => ['type' => 'TEXT', 'null' => true],
             'created_at'        => ['type' => 'DATETIME', 'null' => true],
             'updated_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('members');
    }

    public function down()
    {
        $this->forge->dropTable('members');
    }
}
