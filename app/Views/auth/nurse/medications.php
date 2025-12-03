<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Medication Management</h1>
            <p class="lead">Log and track medication administration for patients.</p>

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
                    <h5 class="mb-0">Prescriptions List (Total: <?= isset($prescriptions) ? count($prescriptions) : 0 ?>)</h5>
                    <div>
                        <form action="<?= base_url('nurse/medications/search') ?>" method="get" class="d-inline-block me-2">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search by patient name or medication" value="<?= esc($keyword ?? '') ?>">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </form>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Administer Medication
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
                                    <th>Prescription Date</th>
                                    <th>Doctor</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($prescriptions)): ?>
                                    <?php foreach ($prescriptions as $prescription): ?>
                                        <tr>
                                            <td><?= esc($prescription['id']) ?></td>
                                            <td>
                                                <a href="<?= base_url('nurse/patients/view/' . $prescription['patient_id']) ?>" class="text-decoration-none">
                                                    <?= esc($prescription['patient_name']) ?>
                                                </a>
                                                <?php if (!empty($prescription['age'])): ?>
                                                    <br><small class="text-muted">Age: <?= esc($prescription['age']) ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?= date('M d, Y', strtotime($prescription['prescription_date'])) ?><br>
                                                <small class="text-muted"><?= date('h:i A', strtotime($prescription['prescription_date'])) ?></small>
                                            </td>
                                            <td><?= esc($prescription['doctor_name'] ?? 'Dr. Unknown') ?></td>
                                            <td>
                                                <?php
                                                $status = $prescription['status'] ?? 'Pending';
                                                $statusClass = match($status) {
                                                    'Pending' => 'warning',
                                                    'Administered' => 'success',
                                                    'In Progress' => 'info',
                                                    'Cancelled' => 'danger',
                                                    'Completed' => 'primary',
                                                    default => 'light'
                                                };
                                                ?>
                                                <span class="badge bg-<?= $statusClass ?>"><?= esc($status) ?></span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('nurse/medications/view/' . $prescription['id']) ?>" class="btn btn-sm btn-outline-primary" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-outline-warning" title="Update Status">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button onclick="confirmAdminister(<?= $prescription['id'] ?>)" class="btn btn-sm btn-outline-success" title="Mark Administered">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No prescriptions found. Please check with pharmacy for assigned medications.</td>
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
function confirmAdminister(id) {
    if (confirm('Are you sure you want to mark this medication as administered?')) {
        // Add your administration logic here
        alert('Medication marked as administered for prescription ID: ' + id);
    }
}
</script>

<?= $this->endSection() ?>
