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
                        <p><?= $user['is_admin'] ? 'Administrator' : 'Employee' ?></p>
                    </div>
                    <div class="mb-3">
                        <h5>Account Status</h5>
                        <p><?= $user['is_active'] ? 'Active' : 'Pending Approval' ?></p>
                    </div>
                    <div class="mt-4">
                        <a href="<?= base_url('change-password') ?>" class="btn btn-primary">Change Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>