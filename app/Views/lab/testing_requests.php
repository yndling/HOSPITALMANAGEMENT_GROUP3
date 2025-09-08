<!doctype html>
<html>
<head><meta charset="utf-8"><title>Testing Requests</title></head>
<body>
    <h1>Testing Requests</h1>
    <table border="1" cellpadding="6">
        <thead><tr><th>ID</th><th>Patient</th><th>Test</th><th>Status</th></tr></thead>
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

    <p><a href="<?= base_url('/lab/dashboard') ?>">Back to Dashboard</a></p>
</body>
</html>
