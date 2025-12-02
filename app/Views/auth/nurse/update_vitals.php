<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Update Patient Vitals</h1>
            
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Patient: <?= esc($patient['name']) ?></h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('nurse/patients/vitals/' . $patient['id'] . '/save') ?>" method="post">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Blood Pressure</label>
                                <input type="text" name="blood_pressure" class="form-control" value="<?= esc($patient['blood_pressure'] ?? '') ?>" placeholder="e.g., 120/80">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Temperature (°C)</label>
                                <input type="number" step="0.1" name="temperature" class="form-control" value="<?= esc($patient['temperature'] ?? '') ?>" placeholder="e.g., 36.5">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pulse (bpm)</label>
                                <input type="number" name="pulse" class="form-control" value="<?= esc($patient['pulse'] ?? '') ?>" placeholder="e.g., 72">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Respiratory Rate</label>
                                <input type="number" name="respiratory_rate" class="form-control" value="<?= esc($patient['respiratory_rate'] ?? '') ?>" placeholder="Breaths per minute">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Oxygen Level (%)</label>
                                <input type="number" name="oxygen_level" class="form-control" value="<?= esc($patient['oxygen_level'] ?? '') ?>" placeholder="e.g., 98">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Weight (kg)</label>
                                <input type="number" step="0.1" name="weight" class="form-control" value="<?= esc($patient['weight'] ?? '') ?>" placeholder="e.g., 70.5">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Any additional notes..."><?= esc($patient['notes'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('nurse/patients') ?>" class="btn btn-secondary">Back to List</a>
                            <button type="submit" class="btn btn-primary">Save Vitals</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
