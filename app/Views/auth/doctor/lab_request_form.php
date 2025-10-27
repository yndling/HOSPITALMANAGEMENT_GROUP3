<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Request Lab Test</h3>
                </div>
                <div class="card-body">
                    <form action="/doctor/lab/store" method="post">
                        <div class="form-group">
                            <label for="patient_id">Patient</label>
                            <select class="form-control" id="patient_id" name="patient_id" required>
                                <option value="">Select Patient</option>
                                <?php foreach ($patients as $patient): ?>
                                    <option value="<?= $patient['id'] ?>"><?= $patient['name'] ?> (ID: <?= $patient['id'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="test_type">Test Type</label>
                            <input type="text" class="form-control" id="test_type" name="test_type" required>
                        </div>
                        <div class="form-group">
                            <label for="urgency">Urgency</label>
                            <select class="form-control" id="urgency" name="urgency" required>
                                <option value="routine">Routine</option>
                                <option value="urgent">Urgent</option>
                                <option value="stat">STAT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="clinical_notes">Clinical Notes</label>
                            <textarea class="form-control" id="clinical_notes" name="clinical_notes" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                        <a href="/doctor/lab" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
