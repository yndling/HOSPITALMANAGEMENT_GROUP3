<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1><?= isset($appointment) ? 'Edit Appointment' : 'Book New Appointment' ?></h1>
            <p class="lead"><?= isset($appointment) ? 'Update appointment details' : 'Schedule a new appointment for a patient' ?>.</p>

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
                    <h5 class="mb-0">Appointment Details</h5>
                </div>
                <div class="card-body">
                    <form action="<?= isset($appointment) ? base_url('admin/appointments/update/' . $appointment['id']) : base_url('admin/appointments/store') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="patient_id" class="form-label">Patient *</label>
                                <select class="form-select" id="patient_id" name="patient_id" required>
                                    <option value="">Select Patient</option>
                                    <?php foreach ($patients as $patient): ?>
                                        <option value="<?= $patient['id'] ?>" <?= old('patient_id', $appointment['patient_id'] ?? '') == $patient['id'] ? 'selected' : '' ?>>
                                            <?= esc($patient['name']) ?> (ID: <?= $patient['id'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="doctor" class="form-label">Doctor *</label>
                                <input type="text" class="form-control" id="doctor" name="doctor" value="<?= old('doctor', $appointment['doctor'] ?? '') ?>" placeholder="e.g., Dr. Smith" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="date" class="form-label">Appointment Date *</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?= old('date', $appointment['date'] ?? '') ?>" min="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="time" class="form-label">Appointment Time *</label>
                                <input type="time" class="form-control" id="time" name="time" value="<?= old('time', $appointment['time'] ?? '') ?>" step="1" required>
                                <div class="form-text">Please enter time in HH:MM:SS format</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Pending" <?= old('status', $appointment['status'] ?? 'Pending') == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="Confirmed" <?= old('status', $appointment['status'] ?? '') == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                    <option value="Completed" <?= old('status', $appointment['status'] ?? '') == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                    <option value="Cancelled" <?= old('status', $appointment['status'] ?? '') == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                    <option value="No Show" <?= old('status', $appointment['status'] ?? '') == 'No Show' ? 'selected' : '' ?>>No Show</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-calendar-check"></i> <?= isset($appointment) ? 'Update Appointment' : 'Book Appointment' ?>
                            </button>
                            <a href="<?= base_url('admin/appointments') ?>" class="btn btn-secondary">
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
