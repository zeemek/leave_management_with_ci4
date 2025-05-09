<?php

namespace App\Controllers;

use App\Models\LeaveRequestModel;
use App\Models\LeaveBalanceModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    protected $leaveRequestModel;
    protected $leaveBalanceModel;
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->leaveRequestModel = new LeaveRequestModel();
        $this->leaveBalanceModel = new LeaveBalanceModel();
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function index()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('userId');
        
        // Debug leave balances
        $leaveBalances = $this->leaveBalanceModel->getUserBalances($userId);
        log_message('debug', 'User ID: ' . $userId);
        log_message('debug', 'Leave Balances: ' . print_r($leaveBalances, true));

        $data = [
            'leaveRequests' => $this->leaveRequestModel->getUserRequests($userId),
            'leaveBalances' => $leaveBalances,
            'pendingRequests' => $this->session->get('isAdmin') ? $this->leaveRequestModel->getPendingRequests() : [],
            'allUsers' => [],
            'recentLeaveRequests' => $this->session->get('isAdmin') ? array_slice($this->leaveRequestModel->getAllRequests(), 0, 10) : []
        ];

        // If admin, enrich allUsers with leave balances
        if ($this->session->get('isAdmin')) {
            $userList = $this->userModel->where('is_admin', 0)->findAll();
            $leaveTypeModel = new \App\Models\LeaveTypeModel();
            $casualType = $leaveTypeModel->where('name', 'Casual Leave')->first();
            $earnedType = $leaveTypeModel->where('name', 'Earned Leave')->first();
            $currentYear = date('Y');
            foreach ($userList as &$user) {
                // Get leave balances for this user
                $balances = $this->leaveBalanceModel->getUserBalances($user['id'], $currentYear);
                $user['casual_remaining'] = 0;
                $user['earned_remaining'] = 0;
                foreach ($balances as $bal) {
                    if ($casualType && $bal['leave_type_id'] == $casualType['id']) {
                        $user['casual_remaining'] = $bal['total_days'] - $bal['used_days'];
                    }
                    if ($earnedType && $bal['leave_type_id'] == $earnedType['id']) {
                        $user['earned_remaining'] = $bal['total_days'] - $bal['used_days'];
                    }
                }
            }
            unset($user); // break reference
            $data['allUsers'] = $userList;
        }

        return view('dashboard', $data);
    }
} 