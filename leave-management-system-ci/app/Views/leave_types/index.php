<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Leave Types<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Leave Types</h4>
                <a href="<?= base_url('leave-types/create') ?>" class="btn btn-primary">Add Leave Type</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($leaveTypes as $type): ?>
                                <tr>
                                    <td><?= esc($type['name']) ?></td>
                                    <td><?= esc($type['description']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $type['is_active'] ? 'success' : 'danger' ?>">
                                            <?= $type['is_active'] ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('leave-types/edit/' . $type['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="<?= base_url('leave-types/delete/' . $type['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this leave type?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
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
<?= $this->endSection() ?> 