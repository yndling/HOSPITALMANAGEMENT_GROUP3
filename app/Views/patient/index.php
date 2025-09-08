<!DOCTYPE html>
<html>
<head>
    <title>Patients List</title>
</head>
<body>
<h1>Patients</h1>

<?php if (session()->getFlashdata('message')): ?>
    <p style="color:green;"><?= session()->getFlashdata('message') ?></p>
<?php endif; ?>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Address</th><th>Phone</th><th>Action</th>
    </tr>
    <?php if (! empty($patients)): ?>
        <?php foreach ($patients as $p): ?>
            <tr>
                <td><?= esc($p['id']) ?></td>
                <td><?= esc($p['name']) ?></td>
                <td><?= esc($p['age']) ?></td>
                <td><?= esc($p['gender']) ?></td>
                <td><?= esc($p['address']) ?></td>
                <td><?= esc($p['phone']) ?></td>
                <td>
                    <a href="<?= site_url('patients/delete/'.$p['id']) ?>" 
                       onclick="return confirm('Are you sure you want to delete this patient?')">
                       Delete
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    <?php else: ?>
        <tr><td colspan="7">No patients found.</td></tr>
    <?php endif ?>
</table>
</body>
</html>
