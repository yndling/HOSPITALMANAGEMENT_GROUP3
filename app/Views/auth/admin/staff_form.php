<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1><?= isset($staff) ? 'Edit Staff Member' : 'Add New Staff Member' ?></h1>
            <p class="lead"><?= isset($staff) ? 'Update staff member details' : 'Register a new staff member for the hospital' ?>.</p>

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
                    <h5 class="mb-0">Staff Details</h5>
                </div>
                <div class="card-body">
                    <form action="<?= isset($staff) ? base_url('admin/staff/update/' . $staff['id']) : base_url('admin/staff/store') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $staff['name'] ?? '') ?>" placeholder="Enter full name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $staff['email'] ?? '') ?>" placeholder="Enter email address" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="role" class="form-label">Role *</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="admin" <?= old('role', $staff['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Administrator</option>
                                    <option value="doctor" <?= old('role', $staff['role'] ?? '') == 'doctor' ? 'selected' : '' ?>>Doctor</option>
                                    <option value="nurse" <?= old('role', $staff['role'] ?? '') == 'nurse' ? 'selected' : '' ?>>Nurse</option>
                                    <option value="receptionist" <?= old('role', $staff['role'] ?? '') == 'receptionist' ? 'selected' : '' ?>>Receptionist</option>
                                    <option value="accountant" <?= old('role', $staff['role'] ?? '') == 'accountant' ? 'selected' : '' ?>>Accountant</option>
                                    <option value="it_staff" <?= old('role', $staff['role'] ?? '') == 'it_staff' ? 'selected' : '' ?>>IT Staff</option>
                                    <option value="lab_technician" <?= old('role', $staff['role'] ?? '') == 'lab_technician' ? 'selected' : '' ?>>Lab Technician</option>
                                    <option value="pharmacist" <?= old('role', $staff['role'] ?? '') == 'pharmacist' ? 'selected' : '' ?>>Pharmacist</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control" id="department" name="department" value="<?= old('department', $staff['department'] ?? '') ?>" placeholder="e.g., Cardiology, Emergency">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="specialization" class="form-label">Specialization</label>
                                <input type="text" class="form-control" id="specialization" name="specialization" value="<?= old('specialization', $staff['specialization'] ?? '') ?>" placeholder="e.g., Cardiologist, Emergency Care">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contact" name="contact" value="<?= old('contact', $staff['contact'] ?? '') ?>" placeholder="09171234567">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="salary" class="form-label">Salary (₱)</label>
                                <input type="number" class="form-control" id="salary" name="salary" value="<?= old('salary', $staff['salary'] ?? '') ?>" placeholder="50000.00" step="0.01" min="0">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="active" <?= old('status', $staff['status'] ?? 'active') == 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= old('status', $staff['status'] ?? '') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    <option value="suspended" <?= old('status', $staff['status'] ?? '') == 'suspended' ? 'selected' : '' ?>>Suspended</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter complete address"><?= old('address', $staff['address'] ?? '') ?></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-person-check"></i> <?= isset($staff) ? 'Update Staff Member' : 'Register Staff Member' ?>
                            </button>
                            <a href="<?= base_url('admin/staff') ?>" class="btn btn-secondary">
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
