<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Schedule New Appointment</h2>

    <form action="/receptionist/storeAppointment" method="post" class="card shadow-sm p-4 bg-white">
        <div class="mb-3">
            <label class="form-label">Select Patient</label>
            <select name="patient_id" class="form-select" required>
                <option value="">-- Choose Patient --</option>
                <?php foreach ($patients as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Doctor</label>
            <input type="text" name="doctor" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="time" name="time" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="/receptionist/appointments" class="btn btn-secondary">⬅ Back</a>
            <button type="submit" class="btn btn-success">Save Appointment</button>
        </div>
    </form>
</div>

</body>
</html>
