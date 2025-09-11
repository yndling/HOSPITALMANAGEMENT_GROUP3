<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Hospital Lab System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/lab/dashboard') ?>">Lab Staff</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('/lab/testing-requests') ?>">Testing Requests</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('/lab/results') ?>">Results</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('/lab/records') ?>">Records</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('/logout') ?>">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <?= $this->renderSection('content') ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
