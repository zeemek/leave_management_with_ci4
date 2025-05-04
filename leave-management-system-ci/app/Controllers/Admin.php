<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function activate($id)
    {
        $userUpdated = $this->userModel->update($id, ['is_active' => 1]);
        $leaveTypeModel = new \App\Models\LeaveTypeModel();
        $leaveTypeModel->update($id, ['is_active' => 1]);
        return $this->response->setJSON(['success' => $userUpdated]);
    }

    public function deactivate($id)
    {
        $userUpdated = $this->userModel->update($id, ['is_active' => 0]);
        $leaveTypeModel = new \App\Models\LeaveTypeModel();
        $leaveTypeModel->update($id, ['is_active' => 0]);
        return $this->response->setJSON(['success' => $userUpdated]);
    }
} 