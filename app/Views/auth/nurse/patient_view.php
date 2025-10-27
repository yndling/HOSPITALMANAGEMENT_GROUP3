<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1">Patient Details</h1>
                    <p class="text-muted mb-0">View and manage patient information and nursing tasks</p>
                </div>
                <div>
                    <a href="/nurse/patients" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Patients
                    </a>
                </div>
            </div>

            <?php if (isset($patient) && $patient): ?>
                <!-- Patient Information Card -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-user me-2"></i>Patient Information
                                </h5>
                                <div>
                                    <a href="#" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit me-1"></i>Update Vitals
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Patient Name</label>
                                            <p class="form-control-plaintext"><?= esc($patient['name']) ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Age</label>
                                            <p class="form-control-plaintext"><?= esc($patient['age'] ?? 'N/A') ?> years</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Gender</label>
                                            <p class="form-control-plaintext"><?= esc($patient['gender'] ?? 'N/A') ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Room Number</label>
                                            <p class="form-control-plaintext">
                                                <span class="badge bg-primary">101</span>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Admission Date</label>
                                            <p class="form-control-plaintext"><?= esc(date('M j, Y', strtotime($patient['created_at'] ?? 'now'))) ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Status</label>
                                            <p class="form-control-plaintext">
                                                <span class="badge bg-success">Active</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nursing Tasks -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-tasks me-2"></i>Nursing Tasks
                                </h5>
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i>Add Task
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Task</th>
                                                <th>Assigned Time</th>
                                                <th>Due Time</th>
                                                <th>Status</th>
                                                <th>Notes</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold">Check Vitals</div>
                                                    <small class="text-muted">Routine monitoring</small>
                                                </td>
                                                <td>08:00 AM</td>
                                                <td>08:30 AM</td>
                                                <td><span class="badge bg-success">Completed</span></td>
                                                <td>All vitals normal</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold">Administer Medication</div>
                                                    <small class="text-muted">Paracetamol 500mg</small>
                                                </td>
                                                <td>09:00 AM</td>
                                                <td>09:15 AM</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>Due for administration</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold">Change Dressing</div>
                                                    <small class="text-muted">Post-surgery care</small>
                                                </td>
                                                <td>10:00 AM</td>
                                                <td>10:30 AM</td>
                                                <td><span class="badge bg-primary">In Progress</span></td>
                                                <td>Wound healing well</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Appointments -->
                <?php if (isset($appointments) && !empty($appointments)): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-calendar-alt me-2"></i>Recent Appointments
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Doctor</th>
                                                <th>Purpose</th>
                                                <th>Status</th>
                                                <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($appointments as $appointment): ?>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold"><?= esc(date('M j, Y', strtotime($appointment['appointment_date'] ?? 'now'))) ?></div>
                                                    <small class="text-muted"><?= esc(date('g:i A', strtotime($appointment['appointment_time'] ?? 'now'))) ?></small>
                                                </td>
                                                <td><?= esc($appointment['doctor_name'] ?? 'Dr. Unknown') ?></td>
                                                <td><?= esc($appointment['purpose'] ?? 'General Checkup') ?></td>
                                                <td>
                                                    <span class="badge bg-info">Scheduled</span>
                                                </td>
                                                <td><?= esc($appointment['notes'] ?? 'No notes') ?></td>
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

            <?php else: ?>
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                        <h4>Patient Not Found</h4>
                        <p class="text-muted">The requested patient could not be found.</p>
                        <a href="/nurse/patients" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Patients
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
