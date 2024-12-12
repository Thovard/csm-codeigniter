<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'user_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'nome'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'email'         => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'unique'         => true,
            ],
            'phone'         => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'segmento'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'created_at'  => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
            'updated_at'  => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
        ]);
        
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
