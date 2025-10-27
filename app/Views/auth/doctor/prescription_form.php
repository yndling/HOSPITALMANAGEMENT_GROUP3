<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= isset($prescription) && isset($prescription['id']) ? 'Edit Prescription' : 'Create New Prescription' ?></h3>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <?php if (is_array(session()->getFlashdata('errors'))): ?>
                                <ul class="mb-0">
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <?= session()->getFlashdata('errors') ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= isset($prescription) && isset($prescription['id']) ? '/doctor/prescriptions/update/' . $prescription['id'] : '/doctor/prescriptions/store' ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="patient_id">Patient *</label>
                                    <select class="form-control" id="patient_id" name="patient_id" required>
                                        <option value="">Select Patient</option>
                                        <?php foreach ($patients as $patient): ?>
                                            <option value="<?= $patient['id'] ?>" 
                                                <?= (isset($prescription['patient_id']) && $prescription['patient_id'] == $patient['id']) ? 'selected' : '' ?>>
                                                <?= $patient['name'] ?> (Age: <?= $patient['age'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="appointment_id">Appointment (Optional)</label>
                                    <select class="form-control" id="appointment_id" name="appointment_id">
                                        <option value="">No appointment</option>
                                        <?php if (isset($appointments)): ?>
                                            <?php foreach ($appointments as $appt): ?>
                                                <option value="<?= $appt['id'] ?>" 
                                                    <?= (isset($prescription['appointment_id']) && $prescription['appointment_id'] == $appt['id']) ? 'selected' : '' ?>>
                                                    <?= date('M d, Y', strtotime($appt['date'])) ?> - <?= $appt['time'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="diagnosis">Diagnosis *</label>
                            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" required><?= isset($prescription['diagnosis']) ? $prescription['diagnosis'] : '' ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="notes">Additional Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="2"><?= isset($prescription['notes']) ? $prescription['notes'] : '' ?></textarea>
                        </div>

                        <hr>
                        <h5>Medicines</h5>
                        <div id="medicinesContainer">
                            <?php if (isset($items) && !empty($items)): ?>
                                <?php foreach ($items as $index => $item): ?>
                                    <div class="medicine-item card mb-3">
                                        <div class="card-body">
                                            <input type="hidden" name="item_id[]" value="<?= $item['id'] ?>">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Medicine *</label>
                                                        <select class="form-control medicine-select" name="medicine_id[]" required>
                                                            <option value="">Select Medicine</option>
                                                            <?php foreach ($medicines as $med): ?>
                                                                <option value="<?= $med['id'] ?>" 
                                                                    data-price="<?= $med['selling_price'] ?>"
                                                                    <?= ($item['medicine_id'] == $med['id']) ? 'selected' : '' ?>>
                                                                    <?= $med['name'] ?> (<?= $med['strength'] ?>)
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Quantity *</label>
                                                        <input type="number" class="form-control quantity" name="quantity[]" value="<?= $item['quantity'] ?>" required min="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Dosage *</label>
                                                        <input type="text" class="form-control" name="dosage[]" value="<?= $item['dosage'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Frequency *</label>
                                                        <input type="text" class="form-control" name="frequency[]" value="<?= $item['frequency'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Duration *</label>
                                                        <input type="text" class="form-control" name="duration[]" value="<?= $item['duration'] ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Instructions</label>
                                                <textarea class="form-control" name="instructions[]" rows="1"><?= $item['instructions'] ?? '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="medicine-item card mb-3">
                                    <div class="card-body">
                                        <input type="hidden" name="item_id[]" value="">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Medicine *</label>
                                                    <select class="form-control medicine-select" name="medicine_id[]" required>
                                                        <option value="">Select Medicine</option>
                                                        <?php foreach ($medicines as $med): ?>
                                                            <option value="<?= $med['id'] ?>" data-price="<?= $med['selling_price'] ?>">
                                                                <?= $med['name'] ?> (<?= $med['strength'] ?>)
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Quantity *</label>
                                                    <input type="number" class="form-control quantity" name="quantity[]" required min="1">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Dosage *</label>
                                                    <input type="text" class="form-control" name="dosage[]" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Frequency *</label>
                                                    <input type="text" class="form-control" name="frequency[]" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Duration *</label>
                                                    <input type="text" class="form-control" name="duration[]" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Instructions</label>
                                            <textarea class="form-control" name="instructions[]" rows="1"></textarea>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="button" class="btn btn-secondary mb-3" id="addMedicine">
                            <i class="fas fa-plus"></i> Add Another Medicine
                        </button>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <?= isset($prescription) && isset($prescription['id']) ? 'Update' : 'Create' ?> Prescription
                            </button>
                            <a href="/doctor/prescriptions" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Store medicines data in JavaScript
const medicinesData = <?= json_encode($medicines ?? []); ?>;

document.getElementById('addMedicine').addEventListener('click', function() {
    const container = document.getElementById('medicinesContainer');
    
    // Build medicine options
    let medicineOptions = '<option value="">Select Medicine</option>';
    medicinesData.forEach(function(med) {
        medicineOptions += `<option value="${med.id}" data-price="${med.selling_price}">${med.name} (${med.strength})</option>`;
    });
    
    const medicineHtml = `
        <div class="medicine-item card mb-3">
            <div class="card-body">
                <input type="hidden" name="item_id[]" value="">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Medicine *</label>
                            <select class="form-control medicine-select" name="medicine_id[]" required>
                                ${medicineOptions}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Quantity *</label>
                            <input type="number" class="form-control quantity" name="quantity[]" required min="1">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Dosage *</label>
                            <input type="text" class="form-control" name="dosage[]" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Frequency *</label>
                            <input type="text" class="form-control" name="frequency[]" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Duration *</label>
                            <input type="text" class="form-control" name="duration[]" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Instructions</label>
                    <textarea class="form-control" name="instructions[]" rows="1"></textarea>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-medicine">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', medicineHtml);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-medicine') || e.target.closest('.remove-medicine')) {
        const btn = e.target.classList.contains('remove-medicine') ? e.target : e.target.closest('.remove-medicine');
        const medicineItem = btn.closest('.medicine-item');
        if (document.querySelectorAll('.medicine-item').length > 1) {
            medicineItem.remove();
        } else {
            alert('You must have at least one medicine in the prescription.');
        }
    }
});
</script>
<?= $this->endSection() ?>
