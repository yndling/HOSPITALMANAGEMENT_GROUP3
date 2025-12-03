<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Staff Management</h1>
            <p class="lead">Manage hospital staff members and their information.</p>

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
                    <h5 class="mb-0">Staff List (Total: <?= $total ?? 0 ?>)</h5>
                    <div>
                        <form action="<?= base_url('admin/staff/search') ?>" method="get" class="d-inline-block me-2">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search by name or email" value="<?= esc($keyword ?? '') ?>">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </form>
                        <a href="<?= base_url('admin/staff/create') ?>" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add Staff Member
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
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th>Specialization</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($staff)): ?>
                                    <?php foreach ($staff as $member): ?>
                                        <tr>
                                            <td><?= esc($member['id']) ?></td>
                                            <td><?= esc($member['name']) ?></td>
                                            <td><?= esc($member['email']) ?></td>
                                            <td>
                                                <span class="badge bg-primary"><?= esc(ucfirst($member['role'])) ?></span>
                                            </td>
                                            <td><?= esc($member['department'] ?? 'N/A') ?></td>
                                            <td><?= esc($member['specialization'] ?? 'N/A') ?></td>
                                            <td><?= esc($member['contact'] ?? 'N/A') ?></td>
                                            <td>
                                                <?php
                                                $status = $member['status'] ?? 'active';
                                                $statusClass = match($status) {
                                                    'active' => 'success',
                                                    'inactive' => 'secondary',
                                                    'suspended' => 'danger',
                                                    default => 'light'
                                                };
                                                ?>
                                                <span class="badge bg-<?= $statusClass ?>"><?= esc(ucfirst($status)) ?></span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('admin/staff/edit/' . $member['id']) ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button onclick="confirmDelete(<?= $member['id'] ?>)" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center">No staff members found. Please add a new staff member.</td>
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
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this staff member? This action cannot be undone.')) {
        window.location.href = '<?= base_url('admin/staff/delete/') ?>' + id;
    }
}
</script>

<?= $this->endSection() ?>
