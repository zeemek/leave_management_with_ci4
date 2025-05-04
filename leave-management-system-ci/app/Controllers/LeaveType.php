<?php

namespace App\Controllers;

use App\Models\LeaveTypeModel;
use CodeIgniter\Controller;

class LeaveType extends Controller
{
    protected $leaveTypeModel;
    protected $session;

    public function __construct()
    {
        $this->leaveTypeModel = new LeaveTypeModel();
        $this->session = session();
    }

    public function index()
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'leaveTypes' => $this->leaveTypeModel->findAll()
        ];

        return view('leave_types/index', $data);
    }

    public function create()
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/dashboard');
        }

        return view('leave_types/create');
    }

    public function store()
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/dashboard');
        }

        $rules = [
            'name' => 'required|min_length[3]|is_unique[leave_types.name]',
            'description' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->leaveTypeModel->insert([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'is_active' => 1
        ]);

        return redirect()->to('/leave-types')->with('success', 'Leave type created successfully.');
    }

    public function edit($id)
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'leaveType' => $this->leaveTypeModel->find($id)
        ];

        if (!$data['leaveType']) {
            return redirect()->to('/leave-types')->with('error', 'Leave type not found.');
        }

        return view('leave_types/edit', $data);
    }

    public function update($id)
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/dashboard');
        }

        $rules = [
            'name' => 'required|min_length[3]',
            'description' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->leaveTypeModel->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ]);

        return redirect()->to('/leave-types')->with('success', 'Leave type updated successfully.');
    }

    public function delete($id)
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/dashboard');
        }

        $this->leaveTypeModel->delete($id);
        return redirect()->to('/leave-types')->with('success', 'Leave type deleted successfully.');
    }
} 