<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApprovalsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'SERIAL',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'article_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'approver_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => 'pending',
            ],
            'comments' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('article_id', 'articles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('approver_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('approvals');
    }

    public function down()
    {
        $this->forge->dropTable('approvals');
    }
}
