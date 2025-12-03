<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Pharmacist Dashboard</h1>
            <p class="lead">Welcome back, Pharmacist! Here's your overview.</p>
            
            <!-- Key Metrics Cards -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total Medicines</h5>
                            <h2 class="mb-0"><?= $totalMedicines ?? 0 ?></h2>
                        </div>
                        <div class="card-footer">
                            <a href="/pharmacy/medicines" class="text-white">View All <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Pending Prescriptions</h5>
                            <h2 class="mb-0"><?= $pendingPrescriptions ?? 0 ?></h2>
                        </div>
                        <div class="card-footer">
                            <a href="/pharmacy/prescriptions" class="text-white">View All <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Dispensed Prescriptions</h5>
                            <h2 class="mb-0"><?= $dispensedPrescriptions ?? 0 ?></h2>
                        </div>
                        <div class="card-footer">
                            <a href="/pharmacy/prescriptions" class="text-white">View All <i class="fas fa-arrow-right"></i></a>
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
                                    <a href="/pharmacy/medicines/create" class="btn btn-primary btn-block">
                                        <i class="fas fa-plus-circle"></i> Add Medicine
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="/pharmacy/medicines" class="btn btn-info btn-block">
                                        <i class="fas fa-pills"></i> Manage Medicines
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="/pharmacy/prescriptions" class="btn btn-warning btn-block">
                                        <i class="fas fa-prescription"></i> View Prescriptions
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="/dashboard" class="btn btn-secondary btn-block">
                                        <i class="fas fa-home"></i> Main Dashboard
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
