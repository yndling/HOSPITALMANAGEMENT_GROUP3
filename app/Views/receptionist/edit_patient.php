<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Edit Patient</h2>

    <form action="/receptionist/updatePatient/<?= $patient['id'] ?>" method="post" class="card shadow-sm p-4 bg-white">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" value="<?= $patient['name'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" value="<?= $patient['age'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select" required>
                <option value="Male" <?= $patient['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $patient['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" required><?= $patient['address'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Contact</label>
            <input type="text" name="contact" value="<?= $patient['contact'] ?>" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="/receptionist/patients" class="btn btn-secondary">⬅ Back</a>
            <button type="submit" class="btn btn-primary">Update Patient</button>
        </div>
    </form>
</div>

</body>
</html>
