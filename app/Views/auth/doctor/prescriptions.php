<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Prescriptions Management</h1>
            <p class="lead">Create, view, and manage prescriptions for your patients.</p>
            
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Prescriptions List</h5>
                    <a href="#" class="btn btn-primary">Create New Prescription</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Patient Name</th>
                                    <th>Medicine</th>
                                    <th>Dosage</th>
                                    <th>Date Prescribed</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>Paracetamol</td>
                                    <td>500mg, 2x daily</td>
                                    <td>2024-01-10</td>
                                    <td><span class="badge bg-success">Dispensed</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">Cancel</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td>Amoxicillin</td>
                                    <td>250mg, 3x daily</td>
                                    <td>2024-01-12</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">Cancel</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Bob Johnson</td>
                                    <td>Insulin</td>
                                    <td>10 units, before meals</td>
                                    <td>2024-01-14</td>
                                    <td><span class="badge bg-info">In Progress</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">Cancel</a>
                                    </td>
                                </tr>
                                <!-- Add more dummy rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Prescriptions pagination">
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
