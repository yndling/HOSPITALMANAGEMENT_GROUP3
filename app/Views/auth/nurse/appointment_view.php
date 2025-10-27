<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1">Appointment Details</h1>
                    <p class="text-muted mb-0">View and manage appointment information and nursing tasks</p>
                </div>
                <div>
                    <a href="/nurse/appointments" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Appointments
                    </a>
                </div>
            </div>

            <?php if (isset($appointment) && $appointment): ?>
                <!-- Appointment Information Card -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-calendar-check me-2"></i>Appointment Information
                                </h5>
                                <div>
                                    <a href="#" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit me-1"></i>Update Status
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Patient Name</label>
                                            <p class="form-control-plaintext"><?= esc($appointment['patient_name'] ?? 'Unknown Patient') ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Doctor</label>
                                            <p class="form-control-plaintext"><?= esc($appointment['doctor_name'] ?? 'Dr. Unknown') ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Appointment Date</label>
                                            <p class="form-control-plaintext"><?= esc(date('M j, Y', strtotime($appointment['appointment_date'] ?? 'now'))) ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Appointment Time</label>
                                            <p class="form-control-plaintext"><?= esc(date('g:i A', strtotime($appointment['appointment_time'] ?? 'now'))) ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Room Number</label>
                                            <p class="form-control-plaintext">
                                                <span class="badge bg-primary"><?= esc($appointment['room_number'] ?? '101') ?></span>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Status</label>
                                            <p class="form-control-plaintext">
                                                <?php 
                                                $status = $appointment['status'] ?? 'scheduled';
                                                $statusClass = match($status) {
                                                    'scheduled' => 'bg-info',
                                                    'pending_prep' => 'bg-warning',
                                                    'completed' => 'bg-success',
                                                    'cancelled' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                                $statusText = match($status) {
                                                    'scheduled' => 'Scheduled',
                                                    'pending_prep' => 'Pending Prep',
                                                    'completed' => 'Completed',
                                                    'cancelled' => 'Cancelled',
                                                    default => ucfirst($status)
                                                };
                                                ?>
                                                <span class="badge <?= $statusClass ?>"><?= $statusText ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Purpose</label>
                                    <p class="form-control-plaintext"><?= esc($appointment['purpose'] ?? 'General Checkup') ?></p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Notes</label>
                                    <p class="form-control-plaintext"><?= esc($appointment['notes'] ?? 'No notes available') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-tasks me-2"></i>Nursing Tasks
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-check-circle text-success"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Prepare Patient Room</div>
                                            <small class="text-muted">Room setup completed</small>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-clock text-warning"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Assist with Vitals</div>
                                            <small class="text-muted">Pending - Due in 15 min</small>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-clock text-info"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Post-appointment Care</div>
                                            <small class="text-muted">Scheduled for after visit</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Update Form -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-edit me-2"></i>Update Appointment Status
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="/nurse/appointments/status/<?= esc($appointment['id']) ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="scheduled" <?= ($appointment['status'] ?? '') === 'scheduled' ? 'selected' : '' ?>>Scheduled</option>
                                                    <option value="pending_prep" <?= ($appointment['status'] ?? '') === 'pending_prep' ? 'selected' : '' ?>>Pending Prep</option>
                                                    <option value="in_progress" <?= ($appointment['status'] ?? '') === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                                                    <option value="completed" <?= ($appointment['status'] ?? '') === 'completed' ? 'selected' : '' ?>>Completed</option>
                                                    <option value="cancelled" <?= ($appointment['status'] ?? '') === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nurse_notes" class="form-label">Nurse Notes</label>
                                                <textarea class="form-control" id="nurse_notes" name="nurse_notes" rows="3" placeholder="Add any notes about the appointment..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Update Status
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            <?php else: ?>
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h4>Appointment Not Found</h4>
                        <p class="text-muted">The requested appointment could not be found.</p>
                        <a href="/nurse/appointments" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Appointments
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
