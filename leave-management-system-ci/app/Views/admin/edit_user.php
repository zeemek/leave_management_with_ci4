<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit User<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit User: <?= esc($user['name']) ?></h5>
                <a href="<?= base_url('dashboard') ?>" class="btn btn-sm btn-secondary">Back to Users</a>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"> <?= session()->getFlashdata('error') ?> </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"> <?= session()->getFlashdata('success') ?> </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="<?= base_url('admin/update/' . $user['id']) ?>">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label class="form-label">User ID</label>
                                <input type="text" class="form-control" value="<?= esc($user['id']) ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="<?= esc($user['name']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" value="<?= esc($user['email']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" value="<?= $user['is_admin'] ? 'Admin' : 'Employee' ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control" value="<?= $user['is_active'] ? 'Active' : 'Inactive' ?>" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Reset Password</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?= base_url('admin/update/' . $user['id']) ?>">
                                    <?= csrf_field() ?>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" minlength="6">
                                        <small class="text-muted">Minimum 6 characters</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="6">
                                    </div>
                                    <input type="hidden" name="name" value="<?= esc($user['name']) ?>">
                                    <input type="hidden" name="email" value="<?= esc($user['email']) ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reset this user\'s password?')">Reset Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 