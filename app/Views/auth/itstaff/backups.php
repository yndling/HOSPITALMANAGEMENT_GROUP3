<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Backup Management</h1>
            <p class="lead">Schedule and monitor system backups.</p>
            
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Backup History</h5>
                    <a href="#" class="btn btn-primary">Create Backup</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Backup Date</th>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2024-01-18 02:00:00</td>
                                    <td>Full Backup</td>
                                    <td>2.5 GB</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
                                        <a href="#" class="btn btn-sm btn-outline-info">Restore</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2024-01-17 02:00:00</td>
                                    <td>Incremental</td>
                                    <td>500 MB</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
                                        <a href="#" class="btn btn-sm btn-outline-info">Restore</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2024-01-19 02:00:00</td>
                                    <td>Full Backup</td>
                                    <td>-</td>
                                    <td><span class="badge bg-warning">Scheduled</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">Cancel</a>
                                    </td>
                                </tr>
                                <!-- Add more dummy rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Backups pagination">
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
