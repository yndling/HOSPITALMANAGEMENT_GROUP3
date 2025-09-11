<?= $this->extend('layouts/lab_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Laboratory Dashboard</h2>

    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body text-center">
                    <h5>Total Requests</h5>
                    <h3><?= esc($totalRequests) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body text-center">
                    <h5>Pending Tests</h5>
                    <h3><?= esc($pendingTests) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body text-center">
                    <h5>Completed Tests</h5>
                    <h3><?= esc($completedTests) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body text-center">
                    <h5>Critical Alerts</h5>
                    <h3><?= esc($criticalAlerts) ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
