<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= isset($medicine) ? 'Edit Medicine' : 'Add New Medicine' ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?= isset($medicine) ? '/pharmacy/medicines/update/' . $medicine['id'] : '/pharmacy/medicines/store' ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Medicine Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= isset($medicine) ? $medicine['name'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="generic_name">Generic Name</label>
                                    <input type="text" class="form-control" id="generic_name" name="generic_name" value="<?= isset($medicine) ? $medicine['generic_name'] : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="Analgesic" <?= isset($medicine) && $medicine['category'] == 'Analgesic' ? 'selected' : '' ?>>Analgesic</option>
                                        <option value="Antibiotic" <?= isset($medicine) && $medicine['category'] == 'Antibiotic' ? 'selected' : '' ?>>Antibiotic</option>
                                        <option value="NSAID" <?= isset($medicine) && $medicine['category'] == 'NSAID' ? 'selected' : '' ?>>NSAID</option>
                                        <option value="Antihypertensive" <?= isset($medicine) && $medicine['category'] == 'Antihypertensive' ? 'selected' : '' ?>>Antihypertensive</option>
                                        <option value="Antidiabetic" <?= isset($medicine) && $medicine['category'] == 'Antidiabetic' ? 'selected' : '' ?>>Antidiabetic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dosage_form">Dosage Form</label>
                                    <select class="form-control" id="dosage_form" name="dosage_form" required>
                                        <option value="">Select Dosage Form</option>
                                        <option value="Tablet" <?= isset($medicine) && $medicine['dosage_form'] == 'Tablet' ? 'selected' : '' ?>>Tablet</option>
                                        <option value="Capsule" <?= isset($medicine) && $medicine['dosage_form'] == 'Capsule' ? 'selected' : '' ?>>Capsule</option>
                                        <option value="Syrup" <?= isset($medicine) && $medicine['dosage_form'] == 'Syrup' ? 'selected' : '' ?>>Syrup</option>
                                        <option value="Injection" <?= isset($medicine) && $medicine['dosage_form'] == 'Injection' ? 'selected' : '' ?>>Injection</option>
                                        <option value="Cream" <?= isset($medicine) && $medicine['dosage_form'] == 'Cream' ? 'selected' : '' ?>>Cream</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="strength">Strength</label>
                                    <input type="text" class="form-control" id="strength" name="strength" value="<?= isset($medicine) ? $medicine['strength'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="manufacturer">Manufacturer</label>
                                    <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="<?= isset($medicine) ? $medicine['manufacturer'] : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="batch_number">Batch Number</label>
                                    <input type="text" class="form-control" id="batch_number" name="batch_number" value="<?= isset($medicine) ? $medicine['batch_number'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expiry_date">Expiry Date</label>
                                    <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="<?= isset($medicine) ? $medicine['expiry_date'] : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?= isset($medicine) ? $medicine['quantity'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_stock_level">Minimum Stock Level</label>
                                    <input type="number" class="form-control" id="min_stock_level" name="min_stock_level" value="<?= isset($medicine) ? $medicine['min_stock_level'] : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit_price">Unit Price ($)</label>
                                    <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" value="<?= isset($medicine) ? $medicine['unit_price'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selling_price">Selling Price ($)</label>
                                    <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" value="<?= isset($medicine) ? $medicine['selling_price'] : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="supplier">Supplier</label>
                                    <input type="text" class="form-control" id="supplier" name="supplier" value="<?= isset($medicine) ? $medicine['supplier'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" value="<?= isset($medicine) ? $medicine['location'] : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <?= isset($medicine) ? 'Update Medicine' : 'Save Medicine' ?>
                            </button>
                            <a href="/pharmacy/medicines" class="btn btn-secondary">
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
