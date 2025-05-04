<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaveBalanceModel extends Model
{
    protected $table = 'leave_balances';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'leave_type_id', 'year', 'total_days', 'used_days'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUserBalances($userId, $year = null)
    {
        if ($year === null) {
            $year = date('Y');
        }

        // Debug the query
        $query = $this->db->table('leave_balances')
                    ->select('leave_balances.*, leave_types.name as leave_type_name')
                    ->join('leave_types', 'leave_types.id = leave_balances.leave_type_id')
                    ->where('leave_balances.user_id', $userId)
                    ->where('leave_balances.year', $year);
        
        log_message('debug', 'Leave Balance Query: ' . $this->db->getLastQuery());
        
        $result = $query->get()->getResultArray();
        log_message('debug', 'Leave Balance Result: ' . print_r($result, true));
        
        return $result;
    }

    public function updateBalance($userId, $leaveTypeId, $year, $usedDays)
    {
        $balance = $this->where([
            'user_id' => $userId,
            'leave_type_id' => $leaveTypeId,
            'year' => $year
        ])->first();

        if ($balance) {
            $this->update($balance['id'], [
                'used_days' => $usedDays
            ]);
        }
    }

    public function initializeBalance($userId, $leaveTypeId, $year, $totalDays)
    {
        $existingBalance = $this->where([
            'user_id' => $userId,
            'leave_type_id' => $leaveTypeId,
            'year' => $year
        ])->first();

        if (!$existingBalance) {
            $this->insert([
                'user_id' => $userId,
                'leave_type_id' => $leaveTypeId,
                'year' => $year,
                'total_days' => $totalDays,
                'used_days' => 0
            ]);
        }
    }
} 