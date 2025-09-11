<?= $this->extend('layouts/lab_main') ?>
<?= $this->section('content') ?>

<h1>Testing Requests</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Test</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($requests as $r): ?>
        <tr>
            <td><?= esc($r['id']) ?></td>
            <td><?= esc($r['patient']) ?></td>
            <td><?= esc($r['test']) ?></td>
            <td><?= esc($r['status']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p><a href="<?= base_url('/lab/dashboard') ?>" class="btn btn-primary">Back to Dashboard</a></p>

<?= $this->endSection() ?>
