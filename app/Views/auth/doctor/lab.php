<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Lab Tests Management</h1>
            <p class="lead">Request, view, and manage lab tests for your patients.</p>
            
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Lab Requests List</h5>
                    <a href="#" class="btn btn-primary">Request New Lab Test</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Patient Name</th>
                                    <th>Test Type</th>
                                    <th>Requested Date</th>
                                    <th>Status</th>
                                    <th>Results</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>Blood Test</td>
                                    <td>2024-01-10</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>Available</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-info">Results</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td>Urine Analysis</td>
                                    <td>2024-01-12</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>Processing</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-info">Results</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Bob Johnson</td>
                                    <td>X-Ray</td>
                                    <td>2024-01-14</td>
                                    <td><span class="badge bg-info">In Progress</span></td>
                                    <td>Not Ready</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-outline-info">Results</a>
                                    </td>
                                </tr>
                                <!-- Add more dummy rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Lab pagination">
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
