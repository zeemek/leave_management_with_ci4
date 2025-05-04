<?php

namespace App\Models;

use CodeIgniter\Model;

class LeaveRequestModel extends Model
{
    protected $table = 'leave_requests';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'leave_type_id', 'start_date', 'end_date', 'reason', 'status'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUserRequests($userId)
    {
        return $this->select('leave_requests.*, leave_types.name as leave_type_name')
                    ->join('leave_types', 'leave_types.id = leave_requests.leave_type_id')
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getAllRequests()
    {
        return $this->select('leave_requests.*, users.name as user_name, leave_types.name as leave_type_name')
                    ->join('users', 'users.id = leave_requests.user_id')
                    ->join('leave_types', 'leave_types.id = leave_requests.leave_type_id')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getPendingRequests()
    {
        return $this->select('leave_requests.*, users.name as user_name, leave_types.name as leave_type_name')
                    ->join('users', 'users.id = leave_requests.user_id')
                    ->join('leave_types', 'leave_types.id = leave_requests.leave_type_id')
                    ->where('status', 'pending')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
} 