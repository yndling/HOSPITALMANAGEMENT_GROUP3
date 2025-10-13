<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Record Payment</h1>
            <p class="lead">Record a payment for bill ID: <?= esc($bill['id']) ?>.</p>

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

            <!-- Bill Summary -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Bill Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Patient:</strong> <?= esc($bill['patient_name']) ?></p>
                            <p><strong>Bill Amount:</strong> ₱<?= number_format($bill['amount'], 2) ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong>
                                <span class="badge bg-<?= $bill['status'] == 'paid' ? 'success' : 'danger' ?>">
                                    <?= esc(ucfirst($bill['status'])) ?>
                                </span>
                            </p>
                            <p><strong>Due Date:</strong> <?= $bill['due_date'] ? date('M d, Y', strtotime($bill['due_date'])) : 'N/A' ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Payment Details</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('accountant/payments/store') ?>" method="post">
                        <input type="hidden" name="bill_id" value="<?= esc($bill['id']) ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="amount_paid" class="form-label">Payment Amount (₱) *</label>
                                <input type="number" class="form-control" id="amount_paid" name="amount_paid" value="<?= old('amount_paid') ?>" placeholder="2500.00" step="0.01" min="0.01" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="payment_date" class="form-label">Payment Date *</label>
                                <input type="datetime-local" class="form-control" id="payment_date" name="payment_date" value="<?= old('payment_date', date('Y-m-d\TH:i')) ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="method" class="form-label">Payment Method</label>
                            <select class="form-select" id="method" name="method">
                                <option value="Cash" <?= old('method') == 'Cash' ? 'selected' : '' ?>>Cash</option>
                                <option value="Card" <?= old('method') == 'Card' ? 'selected' : '' ?>>Card</option>
                                <option value="Bank Transfer" <?= old('method') == 'Bank Transfer' ? 'selected' : '' ?>>Bank Transfer</option>
                                <option value="Online" <?= old('method') == 'Online' ? 'selected' : '' ?>>Online</option>
                                <option value="UPI" <?= old('method') == 'UPI' ? 'selected' : '' ?>>UPI</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-cash"></i> Record Payment
                            </button>
                            <a href="<?= base_url('accountant/manage-bills') ?>" class="btn btn-secondary">
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
