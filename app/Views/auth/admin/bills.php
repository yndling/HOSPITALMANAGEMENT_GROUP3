<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Billing Management</h1>
            <p class="lead">Manage patient bills, invoices, and payments.</p>

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
                    <h5 class="mb-0">Bills List (Total: <?= $total ?? 0 ?>)</h5>
                    <div>
                        <a href="<?= base_url('admin/bills/create') ?>" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Create New Bill
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
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Due Date</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($bills)): ?>
                                    <?php foreach ($bills as $bill): ?>
                                        <tr>
                                            <td><?= esc($bill['id']) ?></td>
                                            <td>
                                                <a href="<?= base_url('receptionist/patients/view/' . $bill['patient_id']) ?>" class="text-decoration-none">
                                                    <?= esc($bill['patient_name']) ?>
                                                </a>
                                            </td>
                                            <td>₱<?= number_format($bill['amount'], 2) ?></td>
                                            <td>
                                                <?php
                                                $status = $bill['status'] ?? 'unpaid';
                                                $statusClass = match($status) {
                                                    'paid' => 'success',
                                                    'unpaid' => 'danger',
                                                    'pending' => 'warning',
                                                    default => 'light'
                                                };
                                                ?>
                                                <span class="badge bg-<?= $statusClass ?>"><?= esc(ucfirst($status)) ?></span>
                                            </td>
                                            <td>
                                                <?php if ($bill['due_date']): ?>
                                                    <?= date('M d, Y', strtotime($bill['due_date'])) ?>
                                                <?php else: ?>
                                                    N/A
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    <?= date('M d, Y', strtotime($bill['created_at'])) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('admin/bills/edit/' . $bill['id']) ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="<?= base_url('admin/bills/invoice/' . $bill['id']) ?>" class="btn btn-sm btn-outline-info" title="Generate Invoice">
                                                        <i class="bi bi-receipt"></i>
                                                    </a>
                                                    <?php if ($bill['status'] !== 'paid'): ?>
                                                        <a href="<?= base_url('admin/bills/payment/' . $bill['id']) ?>" class="btn btn-sm btn-outline-success" title="Record Payment">
                                                            <i class="bi bi-cash"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    <button onclick="confirmDelete(<?= $bill['id'] ?>)" class="btn btn-sm btn-outline-danger" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No bills found. Please create a new bill.</td>
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
    if (confirm('Are you sure you want to delete this bill? This action cannot be undone.')) {
        window.location.href = '<?= base_url('admin/bills/delete/') ?>' + id;
    }
}
</script>

<?= $this->endSection() ?>
