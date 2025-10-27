<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Patient Management</h1>
            <p class="lead">Monitor and update patient vitals and nursing tasks.</p>

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
                    <h5 class="mb-0">Patients List (Total: <?= $total ?? 0 ?>)</h5>
                    <div>
                        <form action="<?= base_url('nurse/patients/search') ?>" method="get" class="d-inline-block me-2">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search by name or contact" value="<?= esc($keyword ?? '') ?>">
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
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Contact</th>
                                    <th>Room</th>
                                    <th>Vitals Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($patients)): ?>
                                    <?php foreach ($patients as $patient): ?>
                                        <tr>
                                            <td><?= esc($patient['id']) ?></td>
                                            <td><?= esc($patient['name']) ?></td>
                                            <td><?= esc($patient['age'] ?? 'N/A') ?></td>
                                            <td><?= esc($patient['gender']) ?></td>
                                            <td><?= esc($patient['contact'] ?? 'N/A') ?></td>
                                            <td>
                                                <span class="badge bg-secondary">101</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Normal</span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('nurse/patients/view/' . $patient['id']) ?>" class="btn btn-sm btn-outline-primary" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-outline-warning" title="Update Vitals">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button onclick="confirmUpdate(<?= $patient['id'] ?>)" class="btn btn-sm btn-outline-success" title="Mark Complete">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No patients found. Please check with reception for patient assignments.</td>
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
    if (confirm('Are you sure you want to mark this task as complete?')) {
        // Add your update logic here
        alert('Task marked as complete for patient ID: ' + id);
    }
}
</script>

<?= $this->endSection() ?>
