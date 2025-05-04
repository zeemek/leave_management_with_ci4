<h2>All Employees</h2>
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
        <?php foreach (
$users as $user): ?>
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
                        <a href="<?= base_url('admin/activate/' . $user['id']) ?>" class="btn btn-success btn-sm">Activate</a>
                    <?php else: ?>
                        <a href="<?= base_url('admin/deactivate/' . $user['id']) ?>" class="btn btn-warning btn-sm">Deactivate</a>
                    <?php endif; ?>
                    <a href="<?= base_url('admin/edit/' . $user['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="<?= base_url('admin/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?")">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> 