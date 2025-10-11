    <?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Doctor Dashboard</h1>
                <p class="lead">Welcome back, Doctor! Here's your overview.</p>
                
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body text-center">
                                <h5>Total Patients</h5>
                                <h3><?= isset($totalPatients) ? esc($totalPatients) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success">
                            <div class="card-body text-center">
                                <h5>Upcoming Appointments</h5>
                                <h3><?= isset($upcomingAppointments) ? esc($upcomingAppointments) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body text-center">
                                <h5>Pending Prescriptions</h5>
                                <h3><?= isset($pendingPrescriptions) ? esc($pendingPrescriptions) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info">
                            <div class="card-body text-center">
                                <h5>Lab Tests in Progress</h5>
                                <h3><?= isset($labTestsInProgress) ? esc($labTestsInProgress) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Recent Activities</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Checked patient John Doe at 10:00 AM</li>
                            <li class="list-group-item">Prescribed medication for Jane Smith at 11:30 AM</li>
                            <li class="list-group-item">Reviewed lab results for Bob Johnson at 2:00 PM</li>
                            <li class="list-group-item">Scheduled follow-up for Alice Brown at 3:30 PM</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($role === 'nurse'): ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Nurse Dashboard</h1>
                <p class="lead">Welcome back, Nurse! Here's your task overview.</p>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Today's Tasks</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
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
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>09:00 AM</td>
                                        <td>Administer Medication</td>
                                        <td>Jane Smith</td>
                                        <td>102</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>10:00 AM</td>
                                        <td>Change Dressing</td>
                                        <td>Bob Johnson</td>
                                        <td>103</td>
                                        <td><span class="badge bg-primary">In Progress</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($role === 'receptionist'): ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Receptionist Dashboard</h1>
                <p class="lead">Welcome back! Here is your overview.</p>
                
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body text-center">
                                <h5>Today's Patients</h5>
                                <h3><?= isset($todaysPatients) ? esc($todaysPatients) : '24' ?></h3>
                                <p>Patients scheduled for today.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body text-center">
                                <h5>Upcoming Appointments</h5>
                                <h3><?= isset($upcomingAppointments) ? esc($upcomingAppointments) : '8' ?></h3>
                                <p>Appointments scheduled in the next 3 days.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-body text-center">
                                <h5>Pending Tasks</h5>
                                <h3><?= isset($pendingTasks) ? esc($pendingTasks) : '5' ?></h3>
                                <p>Tasks awaiting your attention.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php elseif ($role === 'laboratory_staff'): ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Laboratory Dashboard</h1>
                <p class="lead">Welcome to the Laboratory Staff Dashboard. Here you can monitor lab requests and test statuses.</p>

                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body text-center">
                                <h5>Total Requests</h5>
                                <h3><?= isset($totalRequests) ? esc($totalRequests) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body text-center">
                                <h5>Pending Tests</h5>
                                <h3><?= isset($pendingTests) ? esc($pendingTests) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body text-center">
                                <h5>Completed Tests</h5>
                                <h3><?= isset($completedTests) ? esc($completedTests) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body text-center">
                                <h5>Critical Alerts</h5>
                                <h3><?= isset($criticalAlerts) ? esc($criticalAlerts) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($role === 'pharmacist'): ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Pharmacist Dashboard</h1>
                <p class="lead">Welcome back, Pharmacist! Here's your overview.</p>
                
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body text-center">
                                <h5>Total Medicines</h5>
                                <h3><?= isset($totalMedicines) ? esc($totalMedicines) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body text-center">
                                <h5>Pending Prescriptions</h5>
                                <h3><?= isset($pendingPrescriptions) ? esc($pendingPrescriptions) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body text-center">
                                <h5>Dispensed Prescriptions</h5>
                                <h3><?= isset($dispensedPrescriptions) ? esc($dispensedPrescriptions) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($role === 'accountant'): ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Accountant Dashboard</h1>
                <p class="lead">Welcome back, Accountant! Here's your financial overview.</p>
                
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body text-center">
                                <h5>Total Bills</h5>
                                <h3><?= isset($totalBills) ? esc($totalBills) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body text-center">
                                <h5>Pending Payments</h5>
                                <h3><?= isset($pendingPayments) ? esc($pendingPayments) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body text-center">
                                <h5>Total Revenue</h5>
                                <h3>$<?= isset($totalRevenue) ? number_format(esc($totalRevenue)) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($role === 'it_staff' || $role === 'itstaff'): ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>IT Staff Dashboard</h1>
                <p class="lead">Welcome back, IT Staff! Here's your overview.</p>
                
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body text-center">
                                <h5>Total Tickets</h5>
                                <h3><?= isset($totalTickets) ? esc($totalTickets) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body text-center">
                                <h5>Open Tickets</h5>
                                <h3><?= isset($openTickets) ? esc($openTickets) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body text-center">
                                <h5>Resolved Tickets</h5>
                                <h3><?= isset($resolvedTickets) ? esc($resolvedTickets) : '0' ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <h2>Healthcare Dashboard</h2>
    <p>Welcome to the dashboard.</p>
<?php endif; ?>

<?= $this->endSection() ?>
