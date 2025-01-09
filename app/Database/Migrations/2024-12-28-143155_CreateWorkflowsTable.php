<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWorkflowsTable extends Migration
{
    public function up()
    {
        // Create the custom ENUM type workflow_status
        $this->db->query("
            DO $$ BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'workflow_status') THEN
                    CREATE TYPE workflow_status AS ENUM ('To Do', 'In Progress', 'In Evaluation', 'Finished');
                END IF;
            END $$;
        ");

        // Create the workflows table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'article_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'assigned_user_ids' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'workflow_status', // Use the custom ENUM type
                'default' => 'To Do',
                'null' => false,
            ],
        ]);

        // Add primary key
        $this->forge->addPrimaryKey('id');

        // Add foreign keys
        $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('article_id', 'articles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('workflows');
    }

    public function down()
    {
        // Drop the workflows table
        $this->forge->dropTable('workflows');

        // Drop the custom ENUM type workflow_status
        $this->db->query("DROP TYPE IF EXISTS workflow_status;");
    }
}
