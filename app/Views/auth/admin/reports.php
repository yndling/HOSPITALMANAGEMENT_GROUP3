<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Reports & Analytics</h1>
            <p class="lead">Generate and view comprehensive reports on hospital operations.</p>
            
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Total Revenue</h5>
                            <h2 class="card-text mt-auto">₱<?= number_format($totalRevenue ?? 0, 2) ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
                    <div class="card text-white bg-success h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Total Appointments</h5>
                            <h2 class="card-text mt-auto"><?= number_format($totalAppointments ?? 0) ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-3 mb-sm-0">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Total Patients</h5>
                            <h2 class="card-text mt-auto"><?= number_format($totalPatients ?? 0) ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Pending Bills Amount</h5>
                            <h2 class="card-text mt-auto">₱<?= number_format($pendingBills ?? 0, 2) ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Monthly Reports Overview (Last 6 Months)</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:400px;">
                        <canvas id="reportsChart"></canvas>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const ctx = document.getElementById('reportsChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: <?= json_encode($months ?? []) ?>,
                                    datasets: [{
                                        label: 'Appointments',
                                        data: <?= json_encode($monthlyAppointments ?? []) ?>,
                                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1,
                                        yAxisID: 'y'
                                    }, {
                                        label: 'Revenue (₱)',
                                        data: <?= json_encode($monthlyRevenue ?? []) ?>,
                                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1,
                                        type: 'line',
                                        yAxisID: 'y1'
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    interaction: {
                                        mode: 'index',
                                        intersect: false,
                                    },
                                    scales: {
                                        y: {
                                            type: 'linear',
                                            display: true,
                                            position: 'left',
                                            title: {
                                                display: true,
                                                text: 'Number of Appointments'
                                            }
                                        },
                                        y1: {
                                            type: 'linear',
                                            display: true,
                                            position: 'right',
                                            grid: {
                                                drawOnChartArea: false,
                                            },
                                            title: {
                                                display: true,
                                                text: 'Revenue (₱)'
                                            }
                                        }
                                    },
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    let label = context.dataset.label || '';
                                                    if (label.includes('Revenue')) {
                                                        return label + ': ₱' + context.raw.toLocaleString('en-PH', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                                                    }
                                                    return label + ': ' + context.raw;
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0">Recent Bills</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Bill #</th>
                                            <th>Patient</th>
                                            <th class="text-end">Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($recentBills)): ?>
                                            <?php foreach ($recentBills as $bill): ?>
                                                <tr>
                                                    <td>#<?= $bill['id'] ?></td>
                                                    <td><?= $bill['patient_name'] ?? 'N/A' ?></td>
                                                    <td class="text-end">₱<?= number_format($bill['total_amount'] ?? 0, 2) ?></td>
                                                    <td>
                                                        <span class="badge bg-<?= $bill['status'] === 'paid' ? 'success' : 'warning' ?>">
                                                            <?= ucfirst($bill['status'] ?? 'pending') ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No recent bills found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0">Recent Appointments</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Patient</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($recentAppointments)): ?>
                                            <?php foreach ($recentAppointments as $appointment): ?>
                                                <tr>
                                                    <td><?= date('M d, Y', strtotime($appointment['date'])) ?></td>
                                                    <td><?= $appointment['patient_name'] ?? 'N/A' ?></td>
                                                    <td><?= ucfirst($appointment['type'] ?? 'checkup') ?></td>
                                                    <td>
                                                        <span class="badge bg-<?= $appointment['status'] === 'completed' ? 'success' : ($appointment['status'] === 'cancelled' ? 'danger' : 'info') ?>">
                                                            <?= ucfirst($appointment['status'] ?? 'scheduled') ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No recent appointments found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Generated Reports</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Report #</th>
                                    <th>Report Type</th>
                                    <th>Generated Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>RPT-001</td>
                                    <td>Monthly Revenue</td>
                                    <td>2024-01-01</td>
                                    <td><span class="badge bg-success">Ready</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
                                        <a href="#" class="btn btn-sm btn-outline-secondary">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>RPT-002</td>
                                    <td>Patient Statistics</td>
                                    <td>2024-01-05</td>
                                    <td><span class="badge bg-info">Processing</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-secondary disabled">Download</a>
                                        <a href="#" class="btn btn-sm btn-outline-secondary">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>RPT-003</td>
                                    <td>Appointment Summary</td>
                                    <td>2024-01-10</td>
                                    <td><span class="badge bg-success">Ready</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
                                        <a href="#" class="btn btn-sm btn-outline-secondary">View</a>
                                    </td>
                                </tr>
                                <!-- Add more dummy rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
