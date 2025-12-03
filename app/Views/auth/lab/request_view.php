<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-flask"></i> Lab Request Details
                    </h3>
                    <a href="<?= base_url('lab/requests') ?>" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Back to Requests
                    </a>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Request Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Request ID</h6>
                                            <p class="text-muted">#<?= esc($request['id']) ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Status</h6>
                                            <?php
                                            $status = $request['status'] ?? 'Unknown';
                                            $statusClass = 'secondary';
                                            $statusIcon = 'circle';
                                            
                                            if (stripos($status, 'pending') !== false) {
                                                $statusClass = 'warning';
                                                $statusIcon = 'clock';
                                                $status = 'Pending';
                                            } elseif (stripos($status, 'progress') !== false || stripos($status, 'in_progress') !== false) {
                                                $statusClass = 'primary';
                                                $statusIcon = 'arrow-repeat';
                                                $status = 'In Progress';
                                            } elseif (stripos($status, 'complete') !== false) {
                                                $statusClass = 'success';
                                                $statusIcon = 'check-circle';
                                                $status = 'Completed';
                                            }
                                            ?>
                                            <span class="badge bg-<?= $statusClass ?> rounded-pill fs-6">
                                                <i class="bi bi-<?= $statusIcon ?>"></i> <?= esc($status) ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <h6>Patient Name</h6>
                                            <p class="text-muted">
                                                <i class="bi bi-person"></i> <?= esc($request['patient'] ?? 'Unknown Patient') ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Test Type</h6>
                                            <p class="text-muted">
                                                <i class="bi bi-flask"></i> <?= esc($request['test'] ?? 'Unknown Test') ?>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <h6>Requested Date</h6>
                                            <p class="text-muted">
                                                <i class="bi bi-calendar"></i> <?= date('M d, Y', strtotime($request['created_at'])) ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Requested Time</h6>
                                            <p class="text-muted">
                                                <i class="bi bi-clock"></i> <?= date('h:i A', strtotime($request['created_at'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <?php if (!empty($request['notes'])): ?>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <h6>Notes</h6>
                                            <p class="text-muted"><?= esc($request['notes']) ?></p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Actions</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $status = $request['status'] ?? '';
                                    $isPending = (stripos($status, 'pending') !== false);
                                    $isInProgress = (stripos($status, 'progress') !== false || stripos($status, 'in_progress') !== false);
                                    $isCompleted = (stripos($status, 'complete') !== false);
                                    ?>
                                    
                                    <?php if ($isPending): ?>
                                        <form method="post" action="<?= base_url('lab/requests/status/' . $request['id']) ?>" class="mb-3">
                                            <input type="hidden" name="status" value="In Progress">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="bi bi-play"></i> Start Processing
                                            </button>
                                        </form>
                                    <?php elseif ($isInProgress): ?>
                                        <a href="<?= base_url('lab/results/add/' . $request['id']) ?>" class="btn btn-success w-100 mb-3">
                                            <i class="bi bi-plus"></i> Add Test Result
                                        </a>
                                    <?php elseif ($isCompleted): ?>
                                        <div class="alert alert-success text-center">
                                            <i class="bi bi-check-circle"></i><br>
                                            <strong>Test Completed</strong><br>
                                            <small>Result has been added</small>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <a href="<?= base_url('lab/requests') ?>" class="btn btn-outline-secondary w-100">
                                        <i class="bi bi-arrow-left"></i> Back to Requests
                                    </a>
                                </div>
                            </div>
                            
                            <?php if ($isCompleted): ?>
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="mb-0">Test Results</h5>
                                </div>
                                <div class="card-body">
                                    <a href="<?= base_url('lab/results') ?>" class="btn btn-info w-100">
                                        <i class="bi bi-eye"></i> View Results
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
