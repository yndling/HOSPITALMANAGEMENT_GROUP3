<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>System Logs</h1>
            <p class="lead">Monitor and review system activity logs.</p>
            
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Logs</h5>
                    <a href="#" class="btn btn-primary">Export Logs</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Timestamp</th>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>IP Address</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2024-01-18 14:30:00</td>
                                    <td>admin</td>
                                    <td>Login</td>
                                    <td>192.168.1.100</td>
                                    <td><span class="badge bg-success">Success</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2024-01-18 15:45:00</td>
                                    <td>dr.smith</td>
                                    <td>Patient Update</td>
                                    <td>192.168.1.101</td>
                                    <td><span class="badge bg-success">Success</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2024-01-18 16:20:00</td>
                                    <td>unknown</td>
                                    <td>Failed Login</td>
                                    <td>192.168.1.200</td>
                                    <td><span class="badge bg-danger">Failed</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Block IP</a>
                                    </td>
                                </tr>
                                <!-- Add more dummy rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Logs pagination">
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
