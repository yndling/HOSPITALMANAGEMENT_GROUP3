<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Backups - IT Staff Dashboard</title>
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
        .logout-btn {
            margin-top: 2rem;
        }
        .btn-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <nav class="sidebar d-flex flex-column">
        <div class="logo">LOGO NAME</div>
        <a href="/itstaff/dashboard" class="nav-link">Dashboard</a>
        <a href="/itstaff/userAccounts" class="nav-link">User Accounts</a>
        <a href="/itstaff/logs" class="nav-link">Logs</a>
        <a href="/itstaff/backups" class="nav-link active">Backups</a>
        <a href="/itstaff/settings" class="nav-link">Settings</a>
        <a href="/logout" class="btn btn-danger logout-btn mt-auto">Log Out</a>
    </nav>
    <main class="content">
        <h1>Backups</h1>
        <div class="btn-group">
            <button class="btn btn-primary">Create Backup</button>
            <button class="btn btn-secondary">Restore Backup</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($backups as $backup): ?>
                    <tr>
                        <td><?= $backup['date'] ?></td>
                        <td><?= $backup['type'] ?></td>
                        <td><?= $backup['status'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-info">Restore</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
