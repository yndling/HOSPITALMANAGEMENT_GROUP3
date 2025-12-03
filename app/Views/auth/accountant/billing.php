<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Billing Overview</h1>
            <p class="lead">Overview of all bills, payments, and financial status.</p>

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

            <!-- Statistics Cards -->
            <div class="row mt-4">
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">Total Bills</h5>
                                    <h2 class="mb-0"><?= $totalBills ?? 0 ?></h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="bi bi-receipt" style="font-size: 2rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">Pending Payments</h5>
                                    <h2 class="mb-0"><?= $pendingPayments ?? 0 ?></h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="bi bi-cash-stack" style="font-size: 2rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">Total Revenue</h5>
                                    <h2 class="mb-0">₱<?= number_format($totalRevenue ?? 0, 2) ?></h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="bi bi-graph-up" style="font-size: 2rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">Paid Bills</h5>
                                    <h2 class="mb-0"><?= ($totalBills ?? 0) - ($pendingPayments ?? 0) ?></h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="bi bi-check-circle" style="font-size: 2rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Bills Table -->
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Bills</h5>
                    <a href="<?= base_url('accountant/manage-bills') ?>" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Manage All Bills
                    </a>
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
                                    <?php foreach (array_slice($bills, 0, 10) as $bill): ?>
                                        <tr>
                                            <td><?= esc($bill['id']) ?></td>
                                            <td>
                                                <a href="<?= base_url('accountant/patients/view/' . $bill['patient_id']) ?>" class="text-decoration-none">
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
                                                    <a href="<?= base_url('accountant/bills/edit/' . $bill['id']) ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="<?= base_url('accountant/bills/invoice/' . $bill['id']) ?>" class="btn btn-sm btn-outline-info" title="Generate Invoice">
                                                        <i class="bi bi-receipt"></i>
                                                    </a>
                                                    <?php if ($bill['status'] !== 'paid'): ?>
                                                        <a href="<?= base_url('accountant/bills/payment/' . $bill['id']) ?>" class="btn btn-sm btn-outline-success" title="Record Payment">
                                                            <i class="bi bi-cash"></i>
                                                        </a>
                                                    <?php endif; ?>
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
<?= $this->endSection() ?>
