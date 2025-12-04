<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Laboratory Staff Dashboard</h1>
            <p class="lead">Welcome back, Lab Staff! Here's your overview.</p>

            <!-- Key Metrics Cards -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total Requests</h5>
                            <h2 class="mb-0"><?= $totalRequests ?? 0 ?></h2>
                        </div>
                        <div class="card-footer">
                            <a href="/lab/requests" class="text-white">View All <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Pending Tests</h5>
                            <h2 class="mb-0"><?= $pendingTests ?? 0 ?></h2>
                        </div>
                        <div class="card-footer">
                            <a href="/lab/requests" class="text-white">View All <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Completed Tests</h5>
                            <h2 class="mb-0"><?= $completedTests ?? 0 ?></h2>
                        </div>
                        <div class="card-footer">
                            <a href="/lab/results" class="text-white">View All <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Critical Alerts</h5>
                            <h2 class="mb-0"><?= $criticalAlerts ?? 0 ?></h2>
                        </div>
                        <div class="card-footer">
                            <small class="text-white">Requires attention</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <a href="/lab/requests" class="btn btn-primary btn-block">
                                        <i class="fas fa-flask"></i> View Test Requests
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="/lab/results" class="btn btn-info btn-block">
                                        <i class="fas fa-chart-line"></i> View Results
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="/lab/supplies" class="btn btn-warning btn-block">
                                        <i class="fas fa-boxes"></i> Manage Supplies
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="/lab/supplies/create" class="btn btn-secondary btn-block">
                                        <i class="fas fa-plus"></i> Add Supply
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
