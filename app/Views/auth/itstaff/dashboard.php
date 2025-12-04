<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>IT Staff Dashboard</h1>
            <p class="lead">Welcome back, IT Staff! Here's your system overview.</p>

            <!-- Key Metrics Cards -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total Tickets</h5>
                            <h2 class="mb-0"><?= $totalTickets ?? 0 ?></h2>
                        </div>
                        <div class="card-footer">
                            <a href="/itstaff/logs" class="text-white">View All <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Open Tickets</h5>
                            <h2 class="mb-0"><?= $openTickets ?? 0 ?></h2>
                        </div>
                        <div class="card-footer">
                            <a href="/itstaff/logs" class="text-white">View All <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Resolved Tickets</h5>
                            <h2 class="mb-0"><?= $resolvedTickets ?? 0 ?></h2>
                        </div>
                        <div class="card-footer">
                            <a href="/itstaff/logs" class="text-white">View All <i class="fas fa-arrow-right"></i></a>
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
                                    <a href="/itstaff/userAccounts" class="btn btn-primary btn-block">
                                        <i class="fas fa-users"></i> Manage Users
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="/itstaff/logs" class="btn btn-info btn-block">
                                        <i class="fas fa-list-alt"></i> System Logs
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="/itstaff/backups" class="btn btn-warning btn-block">
                                        <i class="fas fa-database"></i> Backups
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="/itstaff/settings" class="btn btn-secondary btn-block">
                                        <i class="fas fa-cogs"></i> System Settings
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
