<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>My Appointments</h1>
            <p class="lead">View and manage your scheduled appointments.</p>
            
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Appointments List</h5>
                    <a href="#" class="btn btn-primary">Schedule New Appointment</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Patient Name</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>2024-01-15 10:00 AM</td>
                                    <td><span class="badge bg-success">Confirmed</span></td>
                                    <td>Routine check-up</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-info">Notes</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td>2024-01-16 02:30 PM</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>Follow-up consultation</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-info">Notes</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Bob Johnson</td>
                                    <td>2024-01-17 09:15 AM</td>
                                    <td><span class="badge bg-info">In Progress</span></td>
                                    <td>Post-surgery review</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-info">Notes</a>
                                    </td>
                                </tr>
                                <!-- Add more dummy rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Appointments pagination">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
