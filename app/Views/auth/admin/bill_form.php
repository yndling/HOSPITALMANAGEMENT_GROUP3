<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1><?= isset($bill) ? 'Edit Bill' : 'Create New Bill' ?></h1>
            <p class="lead"><?= isset($bill) ? 'Update bill details' : 'Create a new bill for a patient' ?>.</p>

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
                <div class="card-header">
                    <h5 class="mb-0">Bill Details</h5>
                </div>
                <div class="card-body">
                    <form action="<?= isset($bill) ? base_url('admin/bills/update/' . $bill['id']) : base_url('admin/bills/store') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="patient_id" class="form-label">Patient *</label>
                                <select class="form-select" id="patient_id" name="patient_id" required>
                                    <option value="">Select Patient</option>
                                    <?php if (!empty($patients)): ?>
                                        <?php foreach ($patients as $patient): ?>
                                            <option value="<?= $patient['id'] ?>" <?= old('patient_id', $bill['patient_id'] ?? '') == $patient['id'] ? 'selected' : '' ?>>
                                                <?= esc($patient['name']) ?> (ID: <?= $patient['id'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Bill Amount (₱) *</label>
                                <input type="number" class="form-control" id="amount" name="amount" value="<?= old('amount', $bill['amount'] ?? '') ?>" placeholder="5000.00" step="0.01" min="0.01" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="unpaid" <?= old('status', $bill['status'] ?? 'unpaid') == 'unpaid' ? 'selected' : '' ?>>Unpaid</option>
                                    <option value="paid" <?= old('status', $bill['status'] ?? '') == 'paid' ? 'selected' : '' ?>>Paid</option>
                                    <option value="pending" <?= old('status', $bill['status'] ?? '') == 'pending' ? 'selected' : '' ?>>Pending</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" value="<?= old('due_date', $bill['due_date'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-receipt"></i> <?= isset($bill) ? 'Update Bill' : 'Create Bill' ?>
                            </button>
                            <a href="<?= base_url('admin/bills') ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
