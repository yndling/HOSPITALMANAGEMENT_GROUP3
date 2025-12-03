<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Financial Reports</h1>
            <p class="lead">Generate and view financial reports and analytics.</p>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total Revenue</h5>
                            <p class="card-text h4">₱<?= number_format($totalRevenue ?? 0, 2) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Payments Received</h5>
                            <p class="card-text h4">₱<?= number_format($totalPayments ?? 0, 2) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Outstanding</h5>
                            <p class="card-text h4">₱<?= number_format(($totalRevenue ?? 0) - ($totalPayments ?? 0), 2) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title">Monthly Growth</h5>
                            <p class="card-text h4"><?= $monthlyGrowth ?? '+12%' ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Transaction History</h5>
                    <button class="btn btn-primary" onclick="window.print()">Export Report</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Combine bills and payments for transaction history
                                $transactions = [];

                                // Add bills as transactions
                                if (!empty($bills ?? [])) {
                                    foreach ($bills as $bill) {
                                        $transactions[] = [
                                            'id' => 'B' . $bill['id'],
                                            'date' => $bill['created_at'] ?? date('Y-m-d'),
                                            'description' => 'Bill for ' . ($bill['patient_name'] ?? 'Patient'),
                                            'amount' => $bill['amount'],
                                            'type' => 'Income',
                                            'is_bill' => true
                                        ];
                                    }
                                }

                                // Add payments as transactions
                                if (!empty($payments ?? [])) {
                                    foreach ($payments as $payment) {
                                        $transactions[] = [
                                            'id' => 'P' . $payment['id'],
                                            'date' => $payment['payment_date'] ?? date('Y-m-d'),
                                            'description' => 'Payment from ' . ($payment['patient_name'] ?? 'Patient'),
                                            'amount' => $payment['amount_paid'],
                                            'type' => 'Income',
                                            'is_payment' => true
                                        ];
                                    }
                                }

                                // Sort transactions by date (most recent first)
                                usort($transactions, function($a, $b) {
                                    return strtotime($b['date']) - strtotime($a['date']);
                                });

                                if (!empty($transactions)):
                                    foreach (array_slice($transactions, 0, 10) as $transaction): // Show last 10 transactions
                                ?>
                                        <tr>
                                            <td><?= $transaction['id'] ?></td>
                                            <td><?= date('Y-m-d', strtotime($transaction['date'])) ?></td>
                                            <td><?= $transaction['description'] ?></td>
                                            <td>₱<?= number_format($transaction['amount'], 2) ?></td>
                                            <td>
                                                <span class="badge bg-success"><?= $transaction['type'] ?></span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-info">Download</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No transactions found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (!empty($transactions)): ?>
                        <nav aria-label="Reports pagination">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
