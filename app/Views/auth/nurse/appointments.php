<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Appointment Management</h1>
            <p class="lead">View and manage appointments requiring nurse assistance.</p>

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

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Appointments List (Total: <?= $total ?? 0 ?>)</h5>
                    <div>
                        <form action="<?= base_url('nurse/appointments/search') ?>" method="get" class="d-inline-block me-2">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search by patient name or doctor" value="<?= esc($keyword ?? '') ?>">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </form>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add New Task
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Patient Name</th>
                                    <th>Date & Time</th>
                                    <th>Doctor</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($appointments)): ?>
                                    <?php foreach ($appointments as $appointment): ?>
                                        <tr>
                                            <td><?= esc($appointment['id']) ?></td>
                                            <td>
                                                <a href="<?= base_url('nurse/patients/view/' . $appointment['patient_id']) ?>" class="text-decoration-none">
                                                    <?= esc($appointment['patient_name']) ?>
                                                </a>
                                                <?php if (!empty($appointment['contact'])): ?>
                                                    <br><small class="text-muted"><?= esc($appointment['contact']) ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?= date('M d, Y', strtotime($appointment['date'])) ?><br>
                                                <small class="text-muted"><?= date('h:i A', strtotime($appointment['time'])) ?></small>
                                            </td>
                                            <td><?= esc($appointment['doctor']) ?></td>
                                            <td>
                                                <?php
                                                $status = $appointment['status'] ?? 'Pending';
                                                $statusClass = match($status) {
                                                    'Pending' => 'warning',
                                                    'Confirmed' => 'success',
                                                    'Completed' => 'info',
                                                    'Cancelled' => 'danger',
                                                    'No Show' => 'secondary',
                                                    default => 'light'
                                                };
                                                ?>
                                                <span class="badge bg-<?= $statusClass ?>"><?= esc($status) ?></span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('nurse/appointments/view/' . $appointment['id']) ?>" class="btn btn-sm btn-outline-primary" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-outline-warning" title="Update Status">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button onclick="confirmUpdate(<?= $appointment['id'] ?>)" class="btn btn-sm btn-outline-success" title="Mark Complete">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No appointments found. Please check with reception for assigned appointments.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmUpdate(id) {
    if (confirm('Are you sure you want to mark this appointment task as complete?')) {
        // Add your update logic here
        alert('Appointment task marked as complete for ID: ' + id);
    }
}
</script>

<?= $this->endSection() ?>
