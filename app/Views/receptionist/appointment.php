<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointments List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="mb-4">Appointments</h2>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="/receptionist/appointments/create" class="btn btn-success">+ Schedule Appointment</a>
        <a href="/receptionist/dashboard" class="btn btn-secondary">⬅ Back to Dashboard</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Patient ID</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($appointments)): ?>
                <?php foreach ($appointments as $a): ?>
                    <tr>
                        <td><?= $a['id'] ?></td>
                        <td><?= $a['patient_id'] ?></td>
                        <td><?= $a['doctor'] ?></td>
                        <td><?= $a['date'] ?></td>
                        <td><?= $a['time'] ?></td>
                        <td><?= $a['status'] ?></td>
                        <td>
                            <a href="/receptionist/appointments/edit/<?= $a['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/receptionist/appointments/delete/<?= $a['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this appointment?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">No appointments found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
