<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLeaveBalancesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'leave_type_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'year' => [
                'type' => 'INT',
                'constraint' => 4,
            ],
            'total_days' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'used_days' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
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
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('leave_type_id', 'leave_types', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('leave_balances');
    }

    public function down()
    {
        $this->forge->dropTable('leave_balances');
    }
} 