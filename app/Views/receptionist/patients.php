<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patients List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="mb-4">Patients</h2>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="/receptionist/patients/create" class="btn btn-primary">+ Add New Patient</a>
        <a href="/receptionist/dashboard" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($patients)): ?>
                <?php foreach ($patients as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['name'] ?></td>
                        <td><?= $p['age'] ?></td>
                        <td><?= $p['gender'] ?></td>
                        <td><?= $p['contact'] ?></td>
                        <td><?= $p['address'] ?></td>
                        <td>
                            <a href="/receptionist/patients/edit/<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/receptionist/patients/delete/<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this patient?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">No patients found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
