<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Prescription Management</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Diagnosis</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($prescriptions as $prescription): ?>
                                <tr>
                                    <td><?= $prescription['id'] ?></td>
                                    <td>Patient #<?= $prescription['patient_id'] ?></td>
                                    <td>Doctor #<?= $prescription['doctor_id'] ?></td>
                                    <td><?= $prescription['diagnosis'] ?></td>
                                    <td>
                                        <span class="badge badge-<?= $prescription['status'] == 'pending' ? 'warning' : ($prescription['status'] == 'dispensed' ? 'success' : 'secondary') ?>">
                                            <?= ucfirst($prescription['status']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('Y-m-d', strtotime($prescription['created_at'])) ?></td>
                                    <td>
                                        <?php if ($prescription['status'] == 'pending'): ?>
                                        <a href="/pharmacy/prescriptions/dispense/<?= $prescription['id'] ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to dispense this prescription?')">
                                            <i class="fas fa-check"></i> Dispense
                                        </a>
                                        <?php endif; ?>
                                        <button class="btn btn-info btn-sm" onclick="viewPrescriptionDetails(<?= $prescription['id'] ?>)">
                                            <i class="fas fa-eye"></i> View Details
                                        </button>
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
</div>

<!-- Prescription Details Modal -->
<div class="modal fade" id="prescriptionModal" tabindex="-1" role="dialog" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prescriptionModalLabel">Prescription Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="prescriptionDetails">
                <!-- Details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function viewPrescriptionDetails(prescriptionId) {
    // This would typically make an AJAX call to get prescription details
    // For now, we'll show a placeholder
    $('#prescriptionDetails').html('<p>Loading prescription details...</p>');
    $('#prescriptionModal').modal('show');
}
</script>
<?= $this->endSection() ?>
