<?= $this->extend('templates/dashboard') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Chart Container -->
    <div class="card shadow mb-4">
        <div class="card-body p-0">
            <div class="chart-container" style="position: relative; height: 300px; width: 100%;">
                <canvas id="emergencyVisitsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-left-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Patients</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($totalPatients ?? 0) ?></div>
                        </div>
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-user-injured text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-left-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Today's Appointments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $todayAppointments ?? 0 ?></div>
                        </div>
                        <div class="icon-circle bg-success">
                            <i class="fas fa-calendar-check text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-left-info h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Pending Appointments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pendingAppointments ?? 0 ?></div>
                        </div>
                        <div class="icon-circle bg-info">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-left-warning h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$<?= number_format($totalRevenue ?? 0, 2) ?></div>
                        </div>
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-dollar-sign text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Add Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('emergencyVisitsChart').getContext('2d');
        
        // Chart data from the image
        const data = {
            labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                {
                    label: 'JUN',
                    data: [1000, 0, 0, 0, 0, 0, 0],
                    backgroundColor: '#FF6384',
                    borderWidth: 0,
                    barPercentage: 0.6
                },
                {
                    label: 'JUL',
                    data: [0, 2000, 0, 0, 0, 0, 0],
                    backgroundColor: '#36A2EB',
                    borderWidth: 0,
                    barPercentage: 0.6
                },
                {
                    label: 'AUG',
                    data: [0, 0, 1500, 0, 0, 0, 0],
                    backgroundColor: '#FFCE56',
                    borderWidth: 0,
                    barPercentage: 0.6
                },
                {
                    label: 'SEP',
                    data: [0, 0, 0, 4000, 0, 0, 0],
                    backgroundColor: '#4BC0C0',
                    borderWidth: 0,
                    barPercentage: 0.6
                },
                {
                    label: 'OCT',
                    data: [0, 0, 0, 0, 3000, 0, 0],
                    backgroundColor: '#9966FF',
                    borderWidth: 0,
                    barPercentage: 0.6
                },
                {
                    label: 'NOV',
                    data: [0, 0, 0, 0, 0, 2500, 0],
                    backgroundColor: '#FF9F40',
                    borderWidth: 0,
                    barPercentage: 0.6
                },
                {
                    label: 'DEC',
                    data: [0, 0, 0, 0, 0, 0, 5000],
                    backgroundColor: '#C9CBCF',
                    borderWidth: 0,
                    barPercentage: 0.6
                }
            ]
        };

        // Chart configuration
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6c757d',
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f1f1',
                            borderDash: [5, 5],
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6c757d',
                            font: {
                                size: 12
                            },
                            maxTicksLimit: 6,
                            callback: function(value) {
                                return value === 20000 ? '20,000' : value;
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                layout: {
                    padding: {
                        top: 20,
                        right: 20,
                        bottom: 20,
                        left: 20
                    }
                }
            }
        };

        // Create the chart
        new Chart(ctx, config);

        // Chart created without play button
    });
</script>

<style>
    .icon-circle {
        height: 2.5rem;
        width: 2.5rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
    }
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #e3e6f0;
        font-weight: 600;
        color: #4e73df;
    }
    .list-group-item {
        border-left: 0;
        border-right: 0;
        padding: 1rem 1.25rem;
    }
    .list-group-item:first-child {
        border-top: 0;
    }
    .list-group-item:last-child {
        border-bottom: 0;
    }
</style>
<?= $this->endSection() ?>
