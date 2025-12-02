<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nurse Dashboard</h1>
        <a href="<?= base_url('nurse/patients') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Patient
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Total Patients Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Patients</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalPatients ?? '0' ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hospital-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Appointments Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Today's Appointments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $todayAppointments ?? '0' ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Prescriptions Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Vitals</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pendingPrescriptions ?? '0' ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heartbeat fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Beds Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Available Beds</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">15</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-procedures fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Task List -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Today's Tasks</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Tasks Filter:</div>
                            <a class="dropdown-item" href="#">All Tasks</a>
                            <a class="dropdown-item" href="#">Pending</a>
                            <a class="dropdown-item" href="#">Completed</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tasksTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Patient Name</th>
                                    <th>Task Type</th>
                                    <th>Room/Bed</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>08:30 AM</td>
                                    <td>John Smith</td>
                                    <td>Vital Signs Check</td>
                                    <td>Room 201, Bed 3</td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-success">Complete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>09:15 AM</td>
                                    <td>Sarah Johnson</td>
                                    <td>Medication Administration</td>
                                    <td>Room 205, Bed 1</td>
                                    <td><span class="badge badge-info">In Progress</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-success">Complete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10:00 AM</td>
                                    <td>Michael Brown</td>
                                    <td>Dressing Change</td>
                                    <td>Room 210, Bed 2</td>
                                    <td><span class="badge badge-secondary">Scheduled</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-success">Start</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>11:30 AM</td>
                                    <td>Emily Davis</td>
                                    <td>Blood Draw</td>
                                    <td>Room 215, Bed 4</td>
                                    <td><span class="badge badge-success">Completed</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-info">Details</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('nurse/patients/create') ?>" class="btn btn-primary btn-block py-3">
                                <i class="fas fa-user-plus fa-2x mb-2"></i><br>
                                Add New Patient
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('nurse/appointments/create') ?>" class="btn btn-success btn-block py-3">
                                <i class="fas fa-calendar-plus fa-2x mb-2"></i><br>
                                Schedule Appointment
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('nurse/patients') ?>" class="btn btn-info btn-block py-3">
                                <i class="fas fa-search fa-2x mb-2"></i><br>
                                Patient Lookup
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('nurse/medications') ?>" class="btn btn-warning btn-block py-3">
                                <i class="fas fa-pills fa-2x mb-2"></i><br>
                                Medication List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script>
    // Initialize DataTable
    $(document).ready(function() {
        $('#tasksTable').DataTable({
            "pageLength": 5,
            "ordering": true,
            "searching": true,
            "info": false,
            "lengthChange": false
        });
    });
</script>

<?= $this->endSection() ?>
