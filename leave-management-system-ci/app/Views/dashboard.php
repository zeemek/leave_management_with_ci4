<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h2>Welcome, <?= session()->get('name') ?></h2>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Leave Balances</h5>
                <a href="<?= base_url('leave-request/create') ?>" class="btn btn-primary btn-sm">Request Leave</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Leave Type</th>
                                <th>Total Days</th>
                                <th>Used Days</th>
                                <th>Remaining</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($leaveBalances as $balance): ?>
                                <tr>
                                    <td><?= esc($balance['leave_type_name']) ?></td>
                                    <td><?= esc($balance['total_days']) ?></td>
                                    <td><?= esc($balance['used_days']) ?></td>
                                    <td><?= esc($balance['total_days'] - $balance['used_days']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">My Leave Requests</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($leaveRequests as $request): ?>
                                <tr>
                                    <td><?= esc($request['leave_type_name']) ?></td>
                                    <td><?= date('M d, Y', strtotime($request['start_date'])) ?></td>
                                    <td><?= date('M d, Y', strtotime($request['end_date'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $request['status'] == 'approved' ? 'success' : ($request['status'] == 'rejected' ? 'danger' : 'warning') ?>">
                                            <?= ucfirst($request['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (session()->get('isAdmin')): ?>
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Pending Leave Requests</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Reason</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pendingRequests as $request): ?>
                                <tr>
                                    <td><?= esc($request['user_name']) ?></td>
                                    <td><?= esc($request['leave_type_name']) ?></td>
                                    <td><?= date('M d, Y', strtotime($request['start_date'])) ?></td>
                                    <td><?= date('M d, Y', strtotime($request['end_date'])) ?></td>
                                    <td><?= esc($request['reason']) ?></td>
                                    <td>
                                        <form action="<?= base_url('leave-request/approve/' . $request['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                        <form action="<?= base_url('leave-request/reject/' . $request['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                        <a href="<?= base_url('leave-request/view/' . $request['id']) ?>" class="btn btn-info btn-sm">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">All Employees</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allUsers as $user): ?>
                                <tr>
                                    <td><?= esc($user['name']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td>
                                        <?php if ($user['is_active']): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!$user['is_active']): ?>
                                            <button onclick="toggleActivation(<?= $user['id'] ?>, 'activate')" class="btn btn-success btn-sm">Activate</button>
                                        <?php else: ?>
                                            <button onclick="toggleActivation(<?= $user['id'] ?>, 'deactivate')" class="btn btn-warning btn-sm">Deactivate</button>
                                        <?php endif; ?>
                                        <a href="<?= base_url('admin/edit/' . $user['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="<?= base_url('admin/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
function toggleActivation(userId, action) {
    fetch('<?= base_url('admin/') ?>' + action + '/' + userId, {
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload the page or update the row
            location.reload();
        } else {
            alert('Failed to update user status.');
        }
    });
}
</script>
<?= $this->endSection() ?> 