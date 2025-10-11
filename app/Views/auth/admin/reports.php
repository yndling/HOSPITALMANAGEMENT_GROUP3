<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Reports & Analytics</h1>
            <p class="lead">Generate and view comprehensive reports on hospital operations.</p>
            
            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title">Monthly Revenue</h5>
                            <h2 class="card-text">$45,000</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Total Appointments</h5>
                            <h2 class="card-text">320</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Active Patients</h5>
                            <h2 class="card-text">150</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Pending Bills</h5>
                            <h2 class="card-text">20</h2>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Monthly Reports Overview</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="reportsChart"></canvas>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const ctx = document.getElementById('reportsChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                                    datasets: [{
                                        label: 'Appointments',
                                        data: [65, 59, 80, 81, 56, 55],
                                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1
                                    }, {
                                        label: 'Revenue ($K)',
                                        data: [28, 48, 40, 19, 86, 27],
                                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Reports</h5>
                    <a href="#" class="btn btn-primary">Generate Report</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Report ID</th>
                                    <th>Type</th>
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
