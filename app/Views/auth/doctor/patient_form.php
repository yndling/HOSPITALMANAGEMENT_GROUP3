<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1><?= isset($patient) ? 'Edit Patient' : 'Register New Patient' ?></h1>
            <p class="lead"><?= isset($patient) ? 'Update patient information' : 'Enter patient details to register' ?>.</p>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Patient Information</h5>
                </div>
                <div class="card-body">
                    <form action="<?= isset($patient) ? base_url('doctor/patients/update/' . $patient['id']) : base_url('doctor/patients/store') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $patient['name'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" name="age" value="<?= old('age', $patient['age'] ?? '') ?>" min="1" max="150">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="gender" class="form-label">Gender *</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" <?= old('gender', $patient['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?= old('gender', $patient['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
                                    <option value="Other" <?= old('gender', $patient['gender'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact" name="contact" value="<?= old('contact', $patient['contact'] ?? '') ?>" placeholder="e.g., +1-234-567-8900">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter full address"><?= old('address', $patient['address'] ?? '') ?></textarea>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> <?= isset($patient) ? 'Update Patient' : 'Register Patient' ?>
                            </button>
                            <a href="<?= base_url('doctor/patients') ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
