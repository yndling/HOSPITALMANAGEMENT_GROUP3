<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accountant - Reports</title>
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
        .sidebar .nav-link:hover {
            background-color: #34495e;
            color: #ecf0f1;
        }
        .sidebar .nav-link.active {
            font-weight: bold;
            background-color: #1abc9c;
            color: white;
            border-radius: 0.25rem;
        }
        .content {
            flex-grow: 1;
            padding: 2rem 3rem;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin: 1rem;
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <div class="logo">LOGO NAME</div>
        <a href="<?= base_url('/accountant/dashboard') ?>" class="nav-link">Dashboard</a>
        <a href="<?= base_url('/accountant/bills') ?>" class="nav-link">Bills</a>
        <a href="<?= base_url('/accountant/reports') ?>" class="nav-link active">Reports</a>
        <a href="<?= base_url('/accountant/payments') ?>" class="nav-link">Payments</a>
        <a href="<?= base_url('/logout') ?>" class="btn btn-danger mt-auto">Logout</a>
    </nav>
    <main class="content">
        <h1>Financial Reports</h1>
        <div class="mb-3">
            <a href="#" class="btn btn-primary">Generate New Report</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Report Type</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                <tr>
                    <td><?= $report['id'] ?></td>
                    <td><?= $report['type'] ?></td>
                    <td><?= $report['date'] ?></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                        <a href="#" class="btn btn-sm btn-outline-secondary">Download</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
