<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>IT Staff Settings</title>
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
        <a href="<?= base_url('/itstaff/dashboard') ?>" class="nav-link">Dashboard</a>
        <a href="<?= base_url('/itstaff/userAccounts') ?>" class="nav-link">User Accounts</a>
        <a href="<?= base_url('/itstaff/logs') ?>" class="nav-link">Logs</a>
        <a href="<?= base_url('/itstaff/backups') ?>" class="nav-link">Backups</a>
        <a href="<?= base_url('/itstaff/settings') ?>" class="nav-link active">Settings</a>
        <a href="<?= base_url('/logout') ?>" class="btn btn-danger mt-auto">Logout</a>
    </nav>
    <main class="content">
        <h1>IT Staff Settings</h1>
        <form>
            <div class="mb-3">
                <label for="emailNotifications" class="form-label">Email Notifications</label>
                <select id="emailNotifications" class="form-select" aria-label="Email Notifications">
                    <option value="enabled" selected>Enabled</option>
                    <option value="disabled">Disabled</option>
                </select>
                <div class="form-text">Enable or disable email notifications for system alerts.</div>
            </div>
            <div class="mb-3">
                <label for="backupFrequency" class="form-label">Backup Frequency</label>
                <select id="backupFrequency" class="form-select" aria-label="Backup Frequency">
                    <option value="daily">Daily</option>
                    <option value="weekly" selected>Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
                <div class="form-text">Choose how often system backups are performed.</div>
            </div>
            <div class="mb-3">
                <label for="logRetention" class="form-label">Log Retention Period</label>
                <select id="logRetention" class="form-select" aria-label="Log Retention Period">
                    <option value="7">7 days</option>
                    <option value="30" selected>30 days</option>
                    <option value="90">90 days</option>
                </select>
                <div class="form-text">Select how long system logs are retained before deletion.</div>
            </div>
            <div class="mb-3">
                <label for="passwordPolicy" class="form-label">Password Policy</label>
                <select id="passwordPolicy" class="form-select" aria-label="Password Policy">
                    <option value="standard" selected>Standard (8+ characters)</option>
                    <option value="strong">Strong (12+ characters, mixed case, numbers, symbols)</option>
                </select>
                <div class="form-text">Choose the password complexity requirements for users.</div>
            </div>
            <div class="mb-3">
                <label for="sessionTimeout" class="form-label">Session Timeout</label>
                <select id="sessionTimeout" class="form-select" aria-label="Session Timeout">
                    <option value="15">15 minutes</option>
                    <option value="30" selected>30 minutes</option>
                    <option value="60">60 minutes</option>
                </select>
                <div class="form-text">Set the duration of inactivity before users are logged out.</div>
            </div>
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </main>
</body>
</html>
