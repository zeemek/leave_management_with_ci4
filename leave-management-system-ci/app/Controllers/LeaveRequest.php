<?php

namespace App\Controllers;

use App\Models\LeaveRequestModel;
use App\Models\LeaveTypeModel;
use App\Models\LeaveBalanceModel;
use CodeIgniter\Controller;

class LeaveRequest extends Controller
{
    protected $leaveRequestModel;
    protected $leaveTypeModel;
    protected $leaveBalanceModel;
    protected $session;

    public function __construct()
    {
        $this->leaveRequestModel = new LeaveRequestModel();
        $this->leaveTypeModel = new LeaveTypeModel();
        $this->leaveBalanceModel = new LeaveBalanceModel();
        $this->session = session();
    }

    public function create()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data = [
            'leaveTypes' => $this->leaveTypeModel->getActiveTypes()
        ];

        return view('leave_requests/create', $data);
    }

    public function store()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $rules = [
            'leave_type_id' => 'required|numeric',
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date',
            'reason' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->leaveRequestModel->insert([
            'user_id' => $this->session->get('userId'),
            'leave_type_id' => $this->request->getPost('leave_type_id'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'reason' => $this->request->getPost('reason'),
            'status' => 'pending'
        ]);

        return redirect()->to('/dashboard')->with('success', 'Leave request submitted successfully.');
    }

    public function approve($id)
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/dashboard');
        }

        $request = $this->leaveRequestModel->find($id);
        if (!$request) {
            return redirect()->to('/dashboard')->with('error', 'Leave request not found.');
        }

        $this->leaveRequestModel->update($id, ['status' => 'approved']);

        // Update leave balance
        $startDate = new \DateTime($request['start_date']);
        $endDate = new \DateTime($request['end_date']);
        $days = $endDate->diff($startDate)->days + 1;

        $balance = $this->leaveBalanceModel->getUserBalances($request['user_id'], date('Y', strtotime($request['start_date'])));
        foreach ($balance as $b) {
            if ($b['leave_type_id'] == $request['leave_type_id']) {
                $this->leaveBalanceModel->updateBalance(
                    $request['user_id'],
                    $request['leave_type_id'],
                    date('Y', strtotime($request['start_date'])),
                    $b['used_days'] + $days
                );
                break;
            }
        }

        return redirect()->to('/dashboard')->with('success', 'Leave request approved successfully.');
    }

    public function reject($id)
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/dashboard');
        }

        $request = $this->leaveRequestModel->find($id);
        if (!$request) {
            return redirect()->to('/dashboard')->with('error', 'Leave request not found.');
        }

        $this->leaveRequestModel->update($id, ['status' => 'rejected']);
        return redirect()->to('/dashboard')->with('success', 'Leave request rejected successfully.');
    }
} 