<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laboratory Supplies Inventory</h3>
                    <div class="card-tools">
                        <a href="/lab/supplies/create" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus"></i> Add Supply
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Unit Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($supplies as $supply): ?>
                                <tr>
                                    <td><?= $supply['id'] ?></td>
                                    <td><?= $supply['name'] ?></td>
                                    <td><?= $supply['category'] ?></td>
                                    <td>
                                        <span class="badge bg-<?= $supply['type'] == 'consumable' ? 'info' : ($supply['type'] == 'equipment' ? 'warning' : 'secondary') ?>">
                                            <?= ucfirst($supply['type']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= $supply['quantity'] <= $supply['min_stock_level'] ? 'danger' : 'success' ?>">
                                            <?= $supply['quantity'] ?>
                                        </span>
                                    </td>
                                    <td><?= $supply['unit'] ?></td>
                                    <td>$<?= number_format($supply['unit_price'], 2) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $supply['status'] == 'active' ? 'success' : 'secondary' ?>">
                                            <?= ucfirst($supply['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/lab/supplies/edit/<?= $supply['id'] ?>" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a href="/lab/supplies/delete/<?= $supply['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i> Delete
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
