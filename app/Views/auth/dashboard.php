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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Doctor Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="/doctor/appointments/create" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus"></i> New Appointment
                    </a>
                    <a href="/doctor/patients/create" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-user-plus"></i> Add Patient
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Patients</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= esc($totalPatients) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-injured fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-primary stretched-link" href="/doctor/patients">View Details</a>
                        <div class="small text-primary"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Upcoming Appointments</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= esc($upcomingAppointments) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-success stretched-link" href="/doctor/appointments">View Appointments</a>
                        <div class="small text-success"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Prescriptions</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= esc($pendingPrescriptions) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-prescription fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-warning stretched-link" href="/doctor/prescriptions">View Prescriptions</a>
                        <div class="small text-warning"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Today's Appointments</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($todayAppointments) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-info stretched-link" href="/doctor/appointments?date=<?= date('Y-m-d') ?>">View Today's Schedule</a>
                        <div class="small text-info"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Appointments -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Today's Appointments (<?= date('F j, Y') ?>)</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="/doctor/appointments/create"><i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i> New Appointment</a></li>
                            <li><a class="dropdown-item" href="/doctor/appointments"><i class="fas fa-calendar fa-sm fa-fw mr-2 text-gray-400"></i> View All</a></li>
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
