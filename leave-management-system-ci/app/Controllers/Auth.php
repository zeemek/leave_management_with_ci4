<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function login()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->findByEmail($email);

        if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
            if (!$user['is_active']) {
                return redirect()->back()->with('error', 'Your account is pending admin approval.');
            }
            $this->session->set([
                'isLoggedIn' => true,
                'userId' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'isAdmin' => isset($user['is_admin']) ? (bool)$user['is_admin'] : false
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Invalid login credentials');
    }

    public function register()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/register');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirmation' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'is_admin' => 0,
            'is_active' => 0
        ]);

        // Initialize leave balances for the new user
        $userId = $this->userModel->getInsertID();
        $leaveTypeModel = new \App\Models\LeaveTypeModel();
        $leaveBalanceModel = new \App\Models\LeaveBalanceModel();
        $leaveTypes = $leaveTypeModel->findAll();
        $currentYear = date('Y');
        foreach ($leaveTypes as $leaveType) {
            $leaveBalanceModel->initializeBalance(
                $userId,
                $leaveType['id'],
                $currentYear,
                $leaveType['maximum_days_per_year']
            );
        }

        return redirect()->to('/login')->with('success', 'Registration successful. Waiting for admin approval.');
    }
    /// This function is used to display the user profile page
    public function profile()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('userId');
        $user = $this->userModel->find($userId);

        return view('profile/profile', ['user' => $user]);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }

    public function updateProfile()
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/profile');
        }
        $userId = $this->session->get('userId');
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->userModel->update($userId, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ]);
        // Update session values
        $this->session->set('name', $this->request->getPost('name'));
        $this->session->set('email', $this->request->getPost('email'));
        return redirect()->to('/profile')->with('success', 'Profile updated successfully.');
    }

    public function resetPassword()
    {
        if (!$this->session->get('isLoggedIn') || !$this->session->get('isAdmin')) {
            return redirect()->to('/profile');
        }
        $userId = $this->session->get('userId');
        $user = $this->userModel->find($userId);

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // Check current password
        if (!$this->userModel->verifyPassword($currentPassword, $user['password'])) {
            return redirect()->to('/profile')->with('error', 'Current password is incorrect.');
        }
        // Validate new password
        if (strlen($newPassword) < 6) {
            return redirect()->to('/profile')->with('error', 'New password must be at least 6 characters.');
        }
        if ($newPassword !== $confirmPassword) {
            return redirect()->to('/profile')->with('error', 'New password and confirmation do not match.');
        }
        // Update password
        $this->userModel->update($userId, [
            'password' => $newPassword
        ]);
        return redirect()->to('/profile')->with('success', 'Password updated successfully.');
    }
} 