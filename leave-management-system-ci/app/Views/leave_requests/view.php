<?php
/** @var array $request */
?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Leave Request Details<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Leave Request Details</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6>Employee Information</h6>
                    <p class="mb-1"><strong>Name:</strong> <?= esc($request['user_name']) ?></p>
                    <p class="mb-1"><strong>Email:</strong> <?= esc($request['email']) ?></p>
                </div>
                <div class="mb-4">
                    <h6>Leave Details</h6>
                    <p class="mb-1"><strong>Leave Type:</strong> <?= esc($request['leave_type_name']) ?></p>
                    <p class="mb-1"><strong>Start Date:</strong> <?= date('M d, Y', strtotime($request['start_date'])) ?></p>
                    <p class="mb-1"><strong>End Date:</strong> <?= date('M d, Y', strtotime($request['end_date'])) ?></p>
                    <p class="mb-1"><strong>Duration:</strong> <?php 
                        $start = new DateTime($request['start_date']);
                        $end = new DateTime($request['end_date']);
                        echo $start->diff($end)->days + 1 . ' days';
                    ?></p>
                    <p class="mb-1"><strong>Reason:</strong><br><?= nl2br(esc($request['reason'])) ?></p>
                    <p class="mb-1"><strong>Status:</strong> <span class="badge bg-<?= $request['status'] === 'approved' ? 'success' : ($request['status'] === 'rejected' ? 'danger' : 'warning') ?>"><?= ucfirst($request['status']) ?></span></p>
                    
                </div>
                <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 