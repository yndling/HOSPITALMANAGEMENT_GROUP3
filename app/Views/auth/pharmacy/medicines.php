<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Medicine Inventory</h3>
                    <div class="card-tools">
                        <a href="/pharmacy/medicines/create" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Medicine
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Generic Name</th>
                                    <th>Category</th>
                                    <th>Dosage Form</th>
                                    <th>Strength</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Selling Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($medicines as $medicine): ?>
                                <tr>
                                    <td><?= $medicine['id'] ?></td>
                                    <td><?= $medicine['name'] ?></td>
                                    <td><?= $medicine['generic_name'] ?></td>
                                    <td><?= $medicine['category'] ?></td>
                                    <td><?= $medicine['dosage_form'] ?></td>
                                    <td><?= $medicine['strength'] ?></td>
                                    <td><?= $medicine['quantity'] ?></td>
                                    <td>₱<?= number_format($medicine['unit_price'], 2) ?></td>
                                    <td>₱<?= number_format($medicine['selling_price'], 2) ?></td>
                                    <td><?= ucfirst($medicine['status']) ?></td>
                                    <td>
                                        <a href="/pharmacy/medicines/edit/<?= $medicine['id'] ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="/pharmacy/medicines/delete/<?= $medicine['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this medicine?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
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
<?= $this->endSection() ?>
