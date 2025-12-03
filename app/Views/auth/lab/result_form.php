<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Test Result</h3>
                </div>
                <div class="card-body">
                    <form action="/lab/results/store" method="post">
                        <input type="hidden" name="request_id" value="<?= $request['id'] ?>">
                        <input type="hidden" name="patient_id" value="<?= $request['patient_id'] ?>">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="test_name">Test Name</label>
                                    <input type="text" class="form-control" id="test_name" name="test_name" value="<?= $request['test_type'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="result_value">Result Value</label>
                                    <input type="text" class="form-control" id="result_value" name="result_value" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    <input type="text" class="form-control" id="unit" name="unit" placeholder="e.g., mg/dL, mmol/L" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reference_range">Reference Range</label>
                                    <input type="text" class="form-control" id="reference_range" name="reference_range" placeholder="e.g., 70-100 mg/dL" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="interpretation">Interpretation</label>
                            <select class="form-control" id="interpretation" name="interpretation" required>
                                <option value="">Select Interpretation</option>
                                <option value="Normal">Normal</option>
                                <option value="High">High</option>
                                <option value="Low">Low</option>
                                <option value="Critical High">Critical High</option>
                                <option value="Critical Low">Critical Low</option>
                                <option value="Borderline">Borderline</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes/Comments</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Additional notes or observations"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Result
                            </button>
                            <a href="/lab/requests" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Requests
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
