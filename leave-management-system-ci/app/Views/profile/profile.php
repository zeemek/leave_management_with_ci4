<!-- filepath: c:\xampp\htdocs\test\leave-management-system-ci\app\Views\profile\profile.php -->
<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Profile
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">User Profile</h4>
                </div>
                <div class="card-body">
                    <?php if ($user['is_admin']): ?>
                        <!-- Admin can edit their profile -->
                        <form method="POST" action="<?= base_url('profile/update') ?>">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="<?= esc($user['name']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?= esc($user['email']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Role</label>
                                <input type="text" class="form-control" value="Administrator" readonly>
                            </div>
                            <div class="mb-3">
                                <label>Account Status</label>
                                <input type="text" class="form-control" value="<?= $user['is_active'] ? 'Active' : 'Pending Approval' ?>" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                        <div class="mt-4">
                            <a href="<?= base_url('change-password') ?>" class="btn btn-secondary">Change Password</a>
                        </div>
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">Reset Password</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?= base_url('profile/reset-password') ?>">
                                    <?= csrf_field() ?>
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" minlength="6" required>
                                        <small class="text-muted">Minimum 6 characters</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="6" required>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Reset Password</button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Regular user: view only -->
                        <div class="mb-3">
                            <h5>Name</h5>
                            <p><?= esc($user['name']) ?></p>
                        </div>
                        <div class="mb-3">
                            <h5>Email</h5>
                            <p><?= esc($user['email']) ?></p>
                        </div>
                        <div class="mb-3">
                            <h5>Role</h5>
                            <p>Employee</p>
                        </div>
                        <div class="mb-3">
                            <h5>Account Status</h5>
                            <p><?= $user['is_active'] ? 'Active' : 'Pending Approval' ?></p>
                        </div>
                       
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>