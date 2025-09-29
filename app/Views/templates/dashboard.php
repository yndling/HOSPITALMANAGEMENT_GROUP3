<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php $session = session(); ?>

<?php $session = session(); ?>
<?php $role = str_replace(' ', '_', strtolower($session->get('role'))); ?>

<?php if ($role === 'admin'): ?>
    <h2>Healthcare Dashboard</h2>
    <div class="mt-4">
        <h5>EMERGENCY VISITS</h5>
        <div class="chart-container" style="height: 400px;">
            <canvas id="emergencyChart"></canvas>
        </div>
    </div>
    <div class="d-flex justify-content-around mt-4">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('emergencyChart').getContext('2d');
            const emergencyChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                    datasets: [{
                        label: 'Emergency Visits',
                        data: [11000, 9000, 12000, 3000, 1500, 10000, 20000],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                            'rgba(255, 159, 64, 0.7)',
                            'rgba(199, 199, 199, 0.7)'
                        ]
                    }]
                },
                options: {
                    scales: {
                        y: {
                            type: 'logarithmic',
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    weight: 'bold'
                                },
                                callback: function(value) {
                                    return Number(value.toString());
                                }
                            },
                            grid: {
                                borderColor: 'black',
                                borderWidth: 2,
                                color: 'black',
                                lineWidth: 2,
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                borderColor: 'black',
                                borderWidth: 2,
                                color: 'black',
                                lineWidth: 2,
                            }
                        }
                    }
                }
            });
        });
    </script>
<?php elseif ($role === 'doctor'): ?>
    <h2>Doctor Dashboard</h2>
    <p>Welcome to the Doctor Dashboard. Here you can see your overview and statistics.</p>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Patients</h5>
                    <p class="card-text"><?= isset($totalPatients) ? $totalPatients : '0' ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Appointments</h5>
                    <p class="card-text"><?= isset($upcomingAppointments) ? $upcomingAppointments : '0' ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending Prescriptions</h5>
                    <p class="card-text"><?= isset($pendingPrescriptions) ? $pendingPrescriptions : '0' ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Lab Tests In Progress</h5>
                    <p class="card-text"><?= isset($labTestsInProgress) ? $labTestsInProgress : '0' ?></p>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($role === 'nurse'): ?>
    <h2>Nurse Dashboard</h2>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Time</th>
                <th>Task</th>
                <th>Patient Name</th>
                <th>Room Number</th>
                <th>Task Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>08:00 AM</td>
                <td>Check Vitals</td>
                <td>John Doe</td>
                <td>101</td>
                <td class="text-success">Completed</td>
            </tr>
            <tr>
                <td>09:00 AM</td>
                <td>Administer Medication</td>
                <td>Jane Smith</td>
                <td>102</td>
                <td class="text-warning">Pending</td>
            </tr>
            <tr>
                <td>10:00 AM</td>
                <td>Change Dressing</td>
                <td>Bob Johnson</td>
                <td>103</td>
                <td class="text-primary">In Progress</td>
            </tr>
        </tbody>
    </table>
<?php elseif ($role === 'receptionist'): ?>
    <h1>Receptionist Dashboard</h1>
    <p>Welcome back! Here is your overview:</p>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card border-primary mb-3">
                <div class="card-header bg-primary text-white">Today's Patients</div>
                <div class="card-body">
                    <h5 class="card-title">24</h5>
                    <p class="card-text">Patients scheduled for today.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-success mb-3">
                <div class="card-header bg-success text-white">Upcoming Appointments</div>
                <div class="card-body">
                    <h5 class="card-title">8</h5>
                    <p class="card-text">Appointments scheduled in the next 3 days.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-info mb-3">
                <div class="card-header bg-info text-white">Pending Tasks</div>
                <div class="card-body">
                    <h5 class="card-title">5</h5>
                    <p class="card-text">Tasks awaiting your attention.</p>
                </div>
            </div>
        </div>
    </div>

<?php elseif ($role === 'lab_staff'): ?>
    <?= $this->extend('layouts/lab_main') ?>
    <?= $this->section('content') ?>

    <div class="container mt-4">
        <h2>Laboratory Dashboard</h2>

        <div class="row mt-3">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body text-center">
                        <h5>Total Requests</h5>
                        <h3><?= esc($totalRequests) ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body text-center">
                        <h5>Pending Tests</h5>
                        <h3><?= esc($pendingTests) ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body text-center">
                        <h5>Completed Tests</h5>
                        <h3><?= esc($completedTests) ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body text-center">
                        <h5>Critical Alerts</h5>
                        <h3><?= esc($criticalAlerts) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>
<?php elseif ($role === 'pharmacist'): ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Pharmacist Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            body {
                display: flex;
                min-height: 100vh;
                margin: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f0f4f8;
                color: #333;
            }
            .sidebar {
                width: 220px;
                background-color: #2c3e50;
                padding: 1rem;
                color: #ecf0f1;
                display: flex;
                flex-direction: column;
            }
            .sidebar .logo {
                font-weight: bold;
                font-size: 1.8rem;
                margin-bottom: 2rem;
                color: #ecf0f1;
                letter-spacing: 2px;
            }
            .sidebar .nav-link {
                color: #bdc3c7;
                margin-bottom: 0.75rem;
                display: flex;
                align-items: center;
                padding: 0.5rem 1rem;
                border-radius: 0.25rem;
                transition: background-color 0.3s ease;
                text-decoration: none;
            }
            .sidebar .nav-link:hover {
                background-color: #34495e;
                color: #ecf0f1;
            }
            .sidebar .nav-link.active {
                font-weight: bold;
                background-color: #1abc9c;
                color: white;
                border-radius: 0.25rem;
            }
            .content {
                flex-grow: 1;
                padding: 2rem 3rem;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                border-radius: 8px;
                margin: 1rem;
            }
        </style>
    </head>
    <body>
       
        <main class="content">
            <h1>Pharmacist Dashboard</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Medicines</h5>
                            <p class="card-text"><?= isset($totalMedicines) ? $totalMedicines : '0' ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pending Prescriptions</h5>
                            <p class="card-text"><?= isset($pendingPrescriptions) ? $pendingPrescriptions : '0' ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Dispensed Prescriptions</h5>
                            <p class="card-text"><?= isset($dispensedPrescriptions) ? $dispensedPrescriptions : '0' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
    </html>
<?php elseif ($role === 'accountant'): ?>
    <h1>Accountant Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Bills</h5>
                    <p class="card-text"><?= $totalBills ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pending Payments</h5>
                    <p class="card-text"><?= $pendingPayments ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">$<?= number_format($totalRevenue) ?></p>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($role === 'it_staff' || $role === 'itstaff'): ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>IT Staff Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            body {
                display: flex;
                min-height: 100vh;
                margin: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f0f4f8;
                color: #333;
            }
            .sidebar {
                width: 220px;
                background-color: #2c3e50;
                padding: 1rem;
                color: #ecf0f1;
                display: flex;
                flex-direction: column;
            }
            .sidebar .logo {
                font-weight: bold;
                font-size: 1.8rem;
                margin-bottom: 2rem;
                color: #ecf0f1;
                letter-spacing: 2px;
            }
            .sidebar .nav-link {
                color: #bdc3c7;
                margin-bottom: 0.75rem;
                display: flex;
                align-items: center;
                padding: 0.5rem 1rem;
                border-radius: 0.25rem;
                transition: background-color 0.3s ease;
                text-decoration: none;
            }
            .sidebar .nav-link:hover {
                background-color: #34495e;
                color: #ecf0f1;
            }
            .sidebar .nav-link.active {
                font-weight: bold;
                background-color: #1abc9c;
                color: white;
                border-radius: 0.25rem;
            }
            .content {
                flex-grow: 1;
                padding: 2rem 3rem;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                border-radius: 8px;
                margin: 1rem;
            }
        </style>
    </head>
    <body>
        <main class="content">
            <h1>IT Staff Dashboard</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Tickets</h5>
                            <p class="card-text"><?= isset($totalTickets) ? $totalTickets : '0' ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Open Tickets</h5>
                            <p class="card-text"><?= isset($openTickets) ? $openTickets : '0' ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Resolved Tickets</h5>
                            <p class="card-text"><?= isset($resolvedTickets) ? $resolvedTickets : '0' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
    </html>
<?php else: ?>
    <h2>Healthcare Dashboard</h2>
    <p>Welcome to the dashboard.</p>
<?php endif; ?>

<?= $this->endSection() ?>
