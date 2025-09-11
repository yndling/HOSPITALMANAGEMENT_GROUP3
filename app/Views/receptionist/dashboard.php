<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receptionist Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Receptionist Dashboard</h1>
        <p class="text-muted">Welcome! Choose an action below:</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Patients</h5>
                    <p class="card-text">View and manage patient records.</p>
                    <a href="/receptionist/patients" class="btn btn-primary w-100">Manage Patients</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Appointments</h5>
                    <p class="card-text">View and schedule appointments.</p>
                    <a href="/receptionist/appointments" class="btn btn-success w-100">Manage Appointments</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="/logout" class="btn btn-danger">Logout</a>
    </div>
</div>

</body>
</html>
