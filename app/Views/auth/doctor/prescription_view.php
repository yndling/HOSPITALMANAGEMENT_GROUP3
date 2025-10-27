<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Prescription Details #<?= $prescription['id'] ?></h3>
                    <div>
                        <?php if ($prescription['status'] == 'pending'): ?>
                            <a href="/doctor/prescriptions/edit/<?= $prescription['id'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="/doctor/prescriptions/delete/<?= $prescription['id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Are you sure you want to delete this prescription?')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        <?php endif; ?>
                        <a href="/doctor/prescriptions" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Prescription Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Patient Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name:</th>
                                    <td><?= $prescription['patient_name'] ?></td>
                                </tr>
                                <tr>
                                    <th>Age:</th>
                                    <td><?= $prescription['age'] ?> years</td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td><?= ucfirst($prescription['gender']) ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Prescription Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Date:</th>
                                    <td><?= date('F d, Y', strtotime($prescription['prescription_date'])) ?></td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge bg-<?php 
                                            echo $prescription['status'] == 'pending' ? 'warning' : 
                                                ($prescription['status'] == 'dispensed' ? 'success' : 'secondary'); 
                                        ?>">
                                            <?= ucfirst($prescription['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php if ($prescription['appointment_id']): ?>
                                <tr>
                                    <th>Appointment:</th>
                                    <td>#<?= $prescription['appointment_id'] ?></td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>

                    <!-- Diagnosis -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5>Diagnosis</h5>
                            <div class="alert alert-info">
                                <?= $prescription['diagnosis'] ?: 'No diagnosis provided' ?>
                            </div>
                        </div>
                    </div>

                    <!-- Medicines -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5>Medicines Prescribed</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Medicine</th>
                                            <th>Quantity</th>
                                            <th>Dosage</th>
                                            <th>Frequency</th>
                                            <th>Duration</th>
                                            <th>Instructions</th>
                                            <th>Unit Price</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $totalAmount = 0; ?>
                                        <?php foreach ($items as $item): ?>
                                            <?php $totalAmount += $item['total_price']; ?>
                                            <tr>
                                                <td><strong><?= $item['medicine_name'] ?></strong></td>
                                                <td><?= $item['quantity'] ?></td>
                                                <td><?= $item['dosage'] ?></td>
                                                <td><?= $item['frequency'] ?></td>
                                                <td><?= $item['duration'] ?></td>
                                                <td><?= $item['instructions'] ?: '-' ?></td>
                                                <td>₱<?= number_format($item['unit_price'], 2) ?></td>
                                                <td><strong>₱<?= number_format($item['total_price'], 2) ?></strong></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot class="table-secondary">
                                        <tr>
                                            <th colspan="7" class="text-right">Total Amount:</th>
                                            <th>₱<?= number_format($totalAmount, 2) ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Notes -->
                    <?php if ($prescription['notes']): ?>
                    <div class="row">
                        <div class="col-12">
                            <h5>Additional Notes</h5>
                            <div class="alert alert-light">
                                <?= $prescription['notes'] ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Print Button -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <button onclick="window.print()" class="btn btn-primary">
                                <i class="fas fa-print"></i> Print Prescription
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .card-header .btn, .alert, nav, footer {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
<?= $this->endSection() ?>
