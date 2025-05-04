<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $this->db->table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'is_admin' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create default leave types
        $leaveTypes = [
            [
                'name' => 'Casual Leave',
                'description' => 'Regular paid time off for personal reasons',
                'maximum_days_per_year' => 12,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Earned Leave',
                'description' => 'Accumulated leave based on service period',
                'maximum_days_per_year' => 30,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('leave_types')->insertBatch($leaveTypes);

        // Initialize leave balances for admin
        $leaveBalances = [];
        $userId = $this->db->insertID();
        $year = date('Y');

        foreach ($this->db->table('leave_types')->get()->getResult() as $leaveType) {
            $leaveBalances[] = [
                'user_id' => $userId,
                'leave_type_id' => $leaveType->id,
                'year' => $year,
                'total_days' => $leaveType->maximum_days_per_year,
                'used_days' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->db->table('leave_balances')->insertBatch($leaveBalances);
    }
} 