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

    public function edit($id)
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/dashboard');
        }
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/dashboard')->with('error', 'User not found.');
        }
        return view('admin/edit_user', ['user' => $user]);
    }

    public function update($id)
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/dashboard');
        }
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/dashboard')->with('error', 'User not found.');
        }
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->userModel->update($id, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ]);
        // Password reset logic
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');
        if ($newPassword || $confirmPassword) {
            if (strlen($newPassword) < 6) {
                return redirect()->back()->with('error', 'Password must be at least 6 characters long.');
            }
            if ($newPassword !== $confirmPassword) {
                return redirect()->back()->with('error', 'Passwords do not match.');
            }
            $this->userModel->update($id, [
                'password' => $newPassword
            ]);
            return redirect()->to('/admin/edit/' . $id)->with('success', 'User "' . $user['name'] . '" updated and password reset successfully.');
        }
        return redirect()->to('/admin/edit/' . $id)->with('success', 'User updated successfully.');
    }
} 