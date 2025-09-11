<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laboratory Staff Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            color: #333;
        }
        .sidebar {
            width: 220px;
            background-color: #2c3e50;
            padding: 1rem;
            color: #ecf0f1;
            display: flex;
            flex-direction: column;
        }
        .sidebar .logo {
            font-weight: bold;
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: #ecf0f1;
            letter-spacing: 2px;
        }
        .sidebar .nav-link {
            color: #bdc3c7;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #1abc9c;
            color: white;
            font-weight: bold;
            border-radius: 0.25rem;
        }
        .content {
            flex-grow: 1;
            padding: 2rem 3rem;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin: 1rem;
            max-width: 900px;
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <div class="logo">LABORATORY STAFF</div>
        <a href="<?= base_url('/lab/dashboard') ?>" class="nav-link <?= uri_string() === 'lab/dashboard' ? 'active' : '' ?>">Dashboard</a>
        <a href="<?= base_url('/lab/testing-requests') ?>" class="nav-link <?= uri_string() === 'lab/testing-requests' ? 'active' : '' ?>">Testing Requests</a>
        <a href="<?= base_url('/lab/results') ?>" class="nav-link <?= uri_string() === 'lab/results' ? 'active' : '' ?>">Results</a>
        <a href="<?= base_url('/lab/records') ?>" class="nav-link <?= uri_string() === 'lab/records' ? 'active' : '' ?>">Records</a>
        <a href="<?= base_url('/logout') ?>" class="btn btn-danger mt-auto">Log Out</a>
    </nav>
    <main class="content">
        <?= $this->renderSection('content') ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
