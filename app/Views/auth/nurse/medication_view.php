<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1">Medication Details</h1>
                    <p class="text-muted mb-0">View and manage medication administration details</p>
                </div>
                <div>
                    <a href="/nurse/medications" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Medications
                    </a>
                </div>
            </div>

            <?php if (isset($prescription) && $prescription): ?>
                <!-- Prescription Information Card -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-prescription-bottle-alt me-2"></i>Prescription Information
                                </h5>
                                <div>
                                    <a href="#" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit me-1"></i>Update Status
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Patient Name</label>
                                            <p class="form-control-plaintext"><?= esc($prescription['patient_name'] ?? 'Unknown Patient') ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Patient Age</label>
                                            <p class="form-control-plaintext"><?= esc($prescription['age'] ?? 'N/A') ?> years</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Prescription Date</label>
                                            <p class="form-control-plaintext"><?= esc(date('M j, Y', strtotime($prescription['prescription_date'] ?? 'now'))) ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Prescription ID</label>
                                            <p class="form-control-plaintext">#<?= esc($prescription['id']) ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Doctor</label>
                                            <p class="form-control-plaintext"><?= esc($prescription['doctor_name'] ?? 'Dr. Unknown') ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Status</label>
                                            <p class="form-control-plaintext">
                                                <?php 
                                                $status = $prescription['status'] ?? 'pending';
                                                $statusClass = match($status) {
                                                    'administered' => 'bg-success',
                                                    'pending' => 'bg-warning',
                                                    'in_progress' => 'bg-info',
                                                    'cancelled' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                                $statusText = match($status) {
                                                    'administered' => 'Administered',
                                                    'pending' => 'Pending',
                                                    'in_progress' => 'In Progress',
                                                    'cancelled' => 'Cancelled',
                                                    default => ucfirst($status)
                                                };
                                                ?>
                                                <span class="badge <?= $statusClass ?>"><?= $statusText ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Instructions</label>
                                    <p class="form-control-plaintext"><?= esc($prescription['instructions'] ?? 'Follow standard medication administration protocol') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-clock me-2"></i>Administration Schedule
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-check-circle text-success"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">08:00 AM</div>
                                            <small class="text-muted">Completed</small>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-clock text-warning"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">12:00 PM</div>
                                            <small class="text-muted">Due in 2 hours</small>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-clock text-info"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">06:00 PM</div>
                                            <small class="text-muted">Scheduled</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Medication Items -->
                <?php if (isset($items) && !empty($items)): ?>
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-pills me-2"></i>Medication Items
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Medication</th>
                                                <th>Dosage</th>
                                                <th>Frequency</th>
                                                <th>Duration</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($items as $item): ?>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold"><?= esc($item['medicine_name'] ?? 'Unknown Medicine') ?></div>
                                                    <small class="text-muted"><?= esc($item['strength'] ?? 'N/A') ?></small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark"><?= esc($item['dosage'] ?? 'N/A') ?></span>
                                                </td>
                                                <td>
                                                    <span class="text-muted"><?= esc($item['frequency'] ?? 'As prescribed') ?></span>
                                                </td>
                                                <td>
                                                    <span class="text-muted"><?= esc($item['duration'] ?? 'N/A') ?></span>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $itemStatus = $item['status'] ?? 'pending';
                                                    $itemStatusClass = match($itemStatus) {
                                                        'administered' => 'bg-success',
                                                        'pending' => 'bg-warning',
                                                        'in_progress' => 'bg-info',
                                                        'cancelled' => 'bg-danger',
                                                        default => 'bg-secondary'
                                                    };
                                                    $itemStatusText = match($itemStatus) {
                                                        'administered' => 'Administered',
                                                        'pending' => 'Pending',
                                                        'in_progress' => 'In Progress',
                                                        'cancelled' => 'Cancelled',
                                                        default => ucfirst($itemStatus)
                                                    };
                                                    ?>
                                                    <span class="badge <?= $itemStatusClass ?>"><?= $itemStatusText ?></span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button class="btn btn-outline-primary" title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-outline-warning" title="Mark as Administered">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Administration Log -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-clipboard-list me-2"></i>Administration Log
                                </h5>
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i>Add Entry
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Medication</th>
                                                <th>Dosage</th>
                                                <th>Administered By</th>
                                                <th>Notes</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold"><?= esc(date('M j, Y', strtotime('now'))) ?></div>
                                                    <small class="text-muted">08:00 AM</small>
                                                </td>
                                                <td>Paracetamol</td>
                                                <td>500mg</td>
                                                <td>Nurse Smith</td>
                                                <td>Patient tolerated well</td>
                                                <td><span class="badge bg-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold"><?= esc(date('M j, Y', strtotime('now'))) ?></div>
                                                    <small class="text-muted">12:00 PM</small>
                                                </td>
                                                <td>Amoxicillin</td>
                                                <td>250mg</td>
                                                <td>Nurse Johnson</td>
                                                <td>Due for administration</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Administration Form -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-edit me-2"></i>Record Medication Administration
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="/nurse/medications/administer/<?= esc($prescription['id']) ?>">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="medication_item" class="form-label">Medication</label>
                                                <select class="form-select" id="medication_item" name="medication_item" required>
                                                    <option value="">Select medication...</option>
                                                    <?php if (isset($items) && !empty($items)): ?>
                                                        <?php foreach ($items as $item): ?>
                                                            <option value="<?= esc($item['id']) ?>"><?= esc($item['medicine_name']) ?> - <?= esc($item['dosage']) ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="administered_time" class="form-label">Administered Time</label>
                                                <input type="datetime-local" class="form-control" id="administered_time" name="administered_time" value="<?= date('Y-m-d\TH:i') ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="administered">Administered</option>
                                                    <option value="partial">Partially Administered</option>
                                                    <option value="refused">Refused by Patient</option>
                                                    <option value="cancelled">Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Notes</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Add any notes about the administration..."></textarea>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save me-2"></i>Record Administration
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-prescription-bottle-alt fa-3x text-muted mb-3"></i>
                        <h4>Prescription Not Found</h4>
                        <p class="text-muted">The requested prescription could not be found.</p>
                        <a href="/nurse/medications" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Medications
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
