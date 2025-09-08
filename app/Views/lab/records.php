<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Laboratory Records</h2>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Test</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($records)): ?>
                <?php foreach ($records as $r): ?>
                    <tr>
                        <td><?= esc($r['id']) ?></td>
                        <td><?= esc($r['patient']) ?></td>
                        <td><?= esc($r['test']) ?></td>
                        <td><?= esc($r['date']) ?></td>
                        <td>
                            <?php if ($r['status'] === 'Completed'): ?>
                                <span class="badge bg-success"><?= esc($r['status']) ?></span>
                            <?php elseif ($r['status'] === 'Pending'): ?>
                                <span class="badge bg-warning text-dark"><?= esc($r['status']) ?></span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?= esc($r['status']) ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No records found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <a href="<?= base_url('/lab/dashboard') ?>" class="btn btn-primary">← Back to Dashboard</a>
</div>

<?= $this->endSection() ?>
