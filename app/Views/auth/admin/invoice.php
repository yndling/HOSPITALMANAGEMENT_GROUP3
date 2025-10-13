<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1 class="mb-0">Invoice #<?= $bill['id'] ?></h1>
                    <div>
                        <button onclick="window.print()" class="btn btn-primary">
                            <i class="bi bi-printer"></i> Print Invoice
                        </button>
                        <a href="<?= base_url('admin/bills') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Bills
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="invoice-header mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Hospital Management System</h3>
                                <p class="mb-1">123 Medical Center Drive</p>
                                <p class="mb-1">Healthcare City, HC 12345</p>
                                <p class="mb-1">Phone: (555) 123-4567</p>
                                <p class="mb-0">Email: billing@hms.com</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h4>INVOICE</h4>
                                <p class="mb-1"><strong>Invoice #:</strong> INV-<?= str_pad($bill['id'], 6, '0', STR_PAD_LEFT) ?></p>
                                <p class="mb-1"><strong>Date:</strong> <?= date('M d, Y') ?></p>
                                <p class="mb-1"><strong>Due Date:</strong> <?= $bill['due_date'] ? date('M d, Y', strtotime($bill['due_date'])) : 'N/A' ?></p>
                                <p class="mb-0"><strong>Status:</strong>
                                    <span class="badge bg-<?= $bill['status'] == 'paid' ? 'success' : ($bill['status'] == 'pending' ? 'warning' : 'danger') ?>">
                                        <?= ucfirst($bill['status']) ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="invoice-details mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Bill To:</h5>
                                <p class="mb-1"><strong>Patient Name:</strong> <?= esc($bill['patient_name']) ?></p>
                                <p class="mb-1"><strong>Patient ID:</strong> #<?= $bill['patient_id'] ?></p>
                                <p class="mb-0"><strong>Bill Date:</strong> <?= date('M d, Y', strtotime($bill['created_at'])) ?></p>
                            </div>
                            <div class="col-md-6">
                                <h5>Payment Information:</h5>
                                <?php
                                $totalPaid = 0;
                                foreach ($payments as $payment) {
                                    $totalPaid += $payment['amount_paid'];
                                }
                                ?>
                                <p class="mb-1"><strong>Total Amount:</strong> ₱<?= number_format($bill['amount'], 2) ?></p>
                                <p class="mb-1"><strong>Amount Paid:</strong> ₱<?= number_format($totalPaid, 2) ?></p>
                                <p class="mb-0"><strong>Balance Due:</strong> ₱<?= number_format($bill['amount'] - $totalPaid, 2) ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="invoice-items mb-4">
                        <h5>Bill Details</h5>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Description</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Medical Services - Bill #<?= $bill['id'] ?></td>
                                    <td class="text-end">₱<?= number_format($bill['amount'], 2) ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-end">Total Amount:</th>
                                    <th class="text-end">₱<?= number_format($bill['amount'], 2) ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <?php if (!empty($payments)): ?>
                    <div class="payment-history mb-4">
                        <h5>Payment History</h5>
                        <table class="table table-sm table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Method</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td><?= date('M d, Y H:i', strtotime($payment['payment_date'])) ?></td>
                                    <td><?= $payment['method'] ?></td>
                                    <td class="text-end">₱<?= number_format($payment['amount_paid'], 2) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>

                    <div class="invoice-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Terms & Conditions:</h6>
                                <ul class="small">
                                    <li>Payment is due within 30 days of invoice date</li>
                                    <li>Late payments may incur additional fees</li>
                                    <li>Please include invoice number on all payments</li>
                                </ul>
                            </div>
                            <div class="col-md-6 text-end">
                                <p class="mb-0">Thank you for choosing our services!</p>
                                <p class="mb-0">For questions, contact billing@hms.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .btn, .card-header .btn {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .card-header {
        border-bottom: 2px solid #000 !important;
        background-color: #f8f9fa !important;
    }
}
</style>

<script>
function printInvoice() {
    window.print();
}
</script>

<?= $this->endSection() ?>
