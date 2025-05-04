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
            'allUsers' => $this->session->get('isAdmin') ? $this->userModel->where('is_admin', 0)->findAll() : []
        ];

        return view('dashboard', $data);
    }
} 