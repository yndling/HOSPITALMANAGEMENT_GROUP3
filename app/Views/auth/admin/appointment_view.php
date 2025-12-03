<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Appointment Details</h1>
            <p class="lead">View complete appointment information.</p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <!-- Appointment Information -->
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Appointment Information</h5>
                            <a href="<?= base_url('admin/appointments/edit/' . $appointment['id']) ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Appointment ID:</strong> <?= esc($appointment['id']) ?></p>
                                    <p><strong>Patient Name:</strong> <?= esc($appointment['patient_name']) ?></p>
                                    <p><strong>Patient Contact:</strong> <?= esc($appointment['contact'] ?? 'N/A') ?></p>
                                    <p><strong>Doctor:</strong> <?= esc($appointment['doctor']) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date:</strong> <?= date('l, F d, Y', strtotime($appointment['date'])) ?></p>
                                    <p><strong>Time:</strong> <?= date('h:i A', strtotime($appointment['time'])) ?></p>
                                    <p><strong>Status:</strong>
                                        <?php
                                        $statusClass = match($appointment['status']) {
                                            'Pending' => 'warning',
                                            'Confirmed' => 'success',
                                            'Completed' => 'info',
                                            'Cancelled' => 'danger',
                                            'No Show' => 'secondary',
                                            default => 'light'
                                        };
                                        ?>
                                        <span class="badge bg-<?= $statusClass ?> fs-6"><?= esc($appointment['status']) ?></span>
                                    </p>
                                    <p><strong>Created:</strong> <?= date('M d, Y H:i', strtotime($appointment['created_at'])) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Patient Information -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Patient Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> <?= esc($appointment['patient_name']) ?></p>
                                    <p><strong>Age:</strong> <?= esc($appointment['age'] ?? 'N/A') ?> years</p>
                                    <p><strong>Gender:</strong> <?= esc($appointment['gender']) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Contact:</strong> <?= esc($appointment['contact'] ?? 'N/A') ?></p>
                                    <p><strong>Address:</strong> <?= esc($appointment['address'] ?? 'N/A') ?></p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="<?= base_url('admin/patients/view/' . $appointment['patient_id']) ?>" class="btn btn-outline-primary">
                                    <i class="bi bi-person-circle"></i> View Full Patient Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Sidebar -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="<?= base_url('admin/appointments/edit/' . $appointment['id']) ?>" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit Appointment
                                </a>
                                <form action="<?= base_url('admin/appointments/status/' . $appointment['id']) ?>" method="post" class="mb-2">
                                    <?= csrf_field() ?>
                                    <label for="status" class="form-label">Update Status:</label>
                                    <select name="status" class="form-select mb-2" onchange="this.form.submit()">
                                        <option value="Pending" <?= $appointment['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="Confirmed" <?= $appointment['status'] == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                        <option value="Completed" <?= $appointment['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                        <option value="Cancelled" <?= $appointment['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                        <option value="No Show" <?= $appointment['status'] == 'No Show' ? 'selected' : '' ?>>No Show</option>
                                    </select>
                                </form>
                                <a href="<?= base_url('admin/appointments') ?>" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Appointments
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Timeline -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">Timeline</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <h6>Appointment Created</h6>
                                        <p class="text-muted small"><?= date('M d, Y H:i', strtotime($appointment['created_at'])) ?></p>
                                    </div>
                                </div>
                                <?php if ($appointment['status'] !== 'Pending'): ?>
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-success"></div>
                                        <div class="timeline-content">
                                            <h6>Status Updated to <?= esc($appointment['status']) ?></h6>
                                            <p class="text-muted small"><?= date('M d, Y H:i', strtotime($appointment['updated_at'])) ?></p>
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
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
}

.timeline-content h6 {
    margin-bottom: 5px;
    font-size: 0.9rem;
}
</style>
<?= $this->endSection() ?>
