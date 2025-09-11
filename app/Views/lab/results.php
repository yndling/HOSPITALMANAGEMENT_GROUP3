<?= $this->extend('layouts/lab_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Laboratory Results</h2>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <!-- Results Table -->
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Test</th>
                    <th>Result</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $r): ?>
                    <tr>
                        <td><?= esc($r['id']) ?></td>
                        <td><?= esc($r['patient']) ?></td>
                        <td><?= esc($r['test']) ?></td>
                        <td><?= esc($r['result']) ?></td>
                        <td><?= esc($r['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No results found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Result Form -->
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            Add Result (Demo)
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('/lab/results/save') ?>">
                <div class="mb-3">
                    <label class="form-label">Patient</label>
                    <input type="text" name="patient" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Test</label>
                    <input type="text" name="test" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Result</label>
                    <input type="text" name="result" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Save Result</button>
                <a href="<?= base_url('/lab/dashboard') ?>" class="btn btn-secondary">Back to Dashboard</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
