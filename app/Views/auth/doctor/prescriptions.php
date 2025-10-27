<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Prescriptions Management</h1>
            <p class="lead">Create, view, and manage prescriptions for your patients.</p>
            
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Prescriptions List (<?= isset($prescriptions) ? count($prescriptions) : 0 ?>)</h5>
                    <a href="/doctor/prescriptions/create" class="btn btn-primary">Create New Prescription</a>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    
                    <?php if (isset($prescriptions) && !empty($prescriptions)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Patient Name</th>
                                    <th>Diagnosis</th>
                                    <th>Date Prescribed</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($prescriptions as $prescription): ?>
                                <tr>
                                    <td><?= $prescription['id'] ?></td>
                                    <td><?= $prescription['patient_name'] ?></td>
                                    <td><?= $prescription['diagnosis'] ?? 'N/A' ?></td>
                                    <td><?= date('M d, Y', strtotime($prescription['prescription_date'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?php 
                                            echo $prescription['status'] == 'pending' ? 'warning' : 
                                                ($prescription['status'] == 'dispensed' ? 'success' : 'secondary'); 
                                        ?>">
                                            <?= ucfirst($prescription['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/doctor/prescriptions/view/<?= $prescription['id'] ?>" class="btn btn-sm btn-outline-primary">View</a>
                                        <?php if ($prescription['status'] == 'pending'): ?>
                                        <a href="/doctor/prescriptions/edit/<?= $prescription['id'] ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="/doctor/prescriptions/delete/<?= $prescription['id'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Are you sure you want to delete this prescription?')">Delete</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info">
                        No prescriptions found. <a href="/doctor/prescriptions/create">Create your first prescription</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
