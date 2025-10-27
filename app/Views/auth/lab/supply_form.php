<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= isset($supply) ? 'Edit Lab Supply' : 'Add New Lab Supply' ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?= isset($supply) ? '/lab/supplies/update/' . $supply['id'] : '/lab/supplies/store' ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Supply Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= isset($supply) ? $supply['name'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="Blood Collection" <?= isset($supply) && $supply['category'] == 'Blood Collection' ? 'selected' : '' ?>>Blood Collection</option>
                                        <option value="Diagnostic" <?= isset($supply) && $supply['category'] == 'Diagnostic' ? 'selected' : '' ?>>Diagnostic</option>
                                        <option value="Microscopy" <?= isset($supply) && $supply['category'] == 'Microscopy' ? 'selected' : '' ?>>Microscopy</option>
                                        <option value="Hematology" <?= isset($supply) && $supply['category'] == 'Hematology' ? 'selected' : '' ?>>Hematology</option>
                                        <option value="Urinalysis" <?= isset($supply) && $supply['category'] == 'Urinalysis' ? 'selected' : '' ?>>Urinalysis</option>
                                        <option value="Centrifugation" <?= isset($supply) && $supply['category'] == 'Centrifugation' ? 'selected' : '' ?>>Centrifugation</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="">Select Type</option>
                                        <option value="consumable" <?= isset($supply) && $supply['type'] == 'consumable' ? 'selected' : '' ?>>Consumable</option>
                                        <option value="equipment" <?= isset($supply) && $supply['type'] == 'equipment' ? 'selected' : '' ?>>Equipment</option>
                                        <option value="reagent" <?= isset($supply) && $supply['type'] == 'reagent' ? 'selected' : '' ?>>Reagent</option>
                                        <option value="disposable" <?= isset($supply) && $supply['type'] == 'disposable' ? 'selected' : '' ?>>Disposable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="manufacturer">Manufacturer</label>
                                    <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="<?= isset($supply) ? $supply['manufacturer'] : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="batch_number">Batch Number</label>
                                    <input type="text" class="form-control" id="batch_number" name="batch_number" value="<?= isset($supply) ? $supply['batch_number'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expiry_date">Expiry Date (Optional)</label>
                                    <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="<?= isset($supply) ? $supply['expiry_date'] : '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?= isset($supply) ? $supply['quantity'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    <input type="text" class="form-control" id="unit" name="unit" value="<?= isset($supply) ? $supply['unit'] : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit_price">Unit Price ($)</label>
                                    <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" value="<?= isset($supply) ? $supply['unit_price'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_stock_level">Minimum Stock Level</label>
                                    <input type="number" class="form-control" id="min_stock_level" name="min_stock_level" value="<?= isset($supply) ? $supply['min_stock_level'] : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="supplier">Supplier</label>
                                    <input type="text" class="form-control" id="supplier" name="supplier" value="<?= isset($supply) ? $supply['supplier'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" value="<?= isset($supply) ? $supply['location'] : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="storage_conditions">Storage Conditions</label>
                            <select class="form-control" id="storage_conditions" name="storage_conditions" required>
                                <option value="">Select Storage Conditions</option>
                                <option value="Room temperature" <?= isset($supply) && $supply['storage_conditions'] == 'Room temperature' ? 'selected' : '' ?>>Room Temperature</option>
                                <option value="Refrigerated" <?= isset($supply) && $supply['storage_conditions'] == 'Refrigerated' ? 'selected' : '' ?>>Refrigerated</option>
                                <option value="Frozen" <?= isset($supply) && $supply['storage_conditions'] == 'Frozen' ? 'selected' : '' ?>>Frozen</option>
                                <option value="Climate controlled" <?= isset($supply) && $supply['storage_conditions'] == 'Climate controlled' ? 'selected' : '' ?>>Climate Controlled</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <?= isset($supply) ? 'Update Supply' : 'Save Supply' ?>
                            </button>
                            <a href="/lab/supplies" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
