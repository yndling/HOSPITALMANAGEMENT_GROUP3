<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1><?= isset($bill) ? 'Edit Bill' : 'Create New Bill' ?></h1>
            <p class="lead">Manage patient billing information.</p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form action="<?= isset($bill) ? base_url('accountant/bills/update/' . $bill['id']) : base_url('accountant/bills/store') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="patient_id" class="form-label">Patient *</label>
                                    <select class="form-select" id="patient_id" name="patient_id" required>
                                        <option value="">Select Patient</option>
                                        <?php foreach ($patients as $patient): ?>
                                            <option value="<?= $patient['id'] ?>" <?= (isset($bill) && $bill['patient_id'] == $patient['id']) ? 'selected' : '' ?>>
                                                <?= esc($patient['name']) ?> (ID: <?= $patient['id'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount (₱) *</label>
                                    <input type="number" class="form-control" id="amount" name="amount" step="0.01" min="0" value="<?= isset($bill) ? $bill['amount'] : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="unpaid" <?= (isset($bill) && $bill['status'] == 'unpaid') ? 'selected' : '' ?>>Unpaid</option>
                                        <option value="paid" <?= (isset($bill) && $bill['status'] == 'paid') ? 'selected' : '' ?>>Paid</option>
                                        <option value="pending" <?= (isset($bill) && $bill['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="due_date" class="form-label">Due Date</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" value="<?= isset($bill) ? $bill['due_date'] : '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('accountant/manage-bills') ?>" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <?= isset($bill) ? 'Update Bill' : 'Create Bill' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
