<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Patient Details</h1>
            <p class="lead">View complete patient information and appointment history.</p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <!-- Patient Information -->
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Patient Information</h5>
                            <a href="<?= base_url('doctor/patients/edit/' . $patient['id']) ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Patient ID:</strong> <?= esc($patient['id']) ?></p>
                                    <p><strong>Name:</strong> <?= esc($patient['name']) ?></p>
                                    <p><strong>Age:</strong> <?= esc($patient['age'] ?? 'N/A') ?> years</p>
                                    <p><strong>Gender:</strong> <?= esc($patient['gender']) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Contact:</strong> <?= esc($patient['contact'] ?? 'N/A') ?></p>
                                    <p><strong>Address:</strong> <?= esc($patient['address'] ?? 'N/A') ?></p>
                                    <p><strong>Registered:</strong> <?= date('M d, Y', strtotime($patient['created_at'])) ?></p>
                                    <p><strong>Last Updated:</strong> <?= date('M d, Y', strtotime($patient['updated_at'])) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment History -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Appointment History</h5>
                            <a href="<?= base_url('doctor/appointments/create?patient_id=' . $patient['id']) ?>" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-circle"></i> Book Appointment
                            </a>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($appointments)): ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Doctor</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($appointments as $appointment): ?>
                                                <tr>
                                                    <td>
                                                        <?= date('M d, Y', strtotime($appointment['date'])) ?><br>
                                                        <small class="text-muted"><?= date('h:i A', strtotime($appointment['time'])) ?></small>
                                                    </td>
                                                    <td><?= esc($appointment['doctor']) ?></td>
                                                    <td>
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
                                                        <span class="badge bg-<?= $statusClass ?>"><?= esc($appointment['status']) ?></span>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('doctor/appointments/view/' . $appointment['id']) ?>" class="btn btn-sm btn-outline-primary" title="View Details">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="<?= base_url('doctor/appointments/edit/' . $appointment['id']) ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-2">No appointments found for this patient.</p>
                                    <a href="<?= base_url('doctor/appointments/create?patient_id=' . $patient['id']) ?>" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Book First Appointment
                                    </a>
                                </div>
                            <?php endif; ?>
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
                                <a href="<?= base_url('doctor/appointments/create?patient_id=' . $patient['id']) ?>" class="btn btn-success">
                                    <i class="bi bi-calendar-plus"></i> Book Appointment
                                </a>
                                <a href="<?= base_url('doctor/patients/edit/' . $patient['id']) ?>" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit Patient
                                </a>
                                <a href="<?= base_url('doctor/patients') ?>" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Patients
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Patient Stats -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">Statistics</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <h4 class="text-primary"><?= count($appointments) ?></h4>
                                    <small class="text-muted">Total Appointments</small>
                                </div>
                                <div class="col-6">
                                    <h4 class="text-success">
                                        <?= count(array_filter($appointments, fn($a) => $a['status'] === 'Completed')) ?>
                                    </h4>
                                    <small class="text-muted">Completed</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
