<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit User - Healthcare Dashboard</title>
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
            max-width: 600px;
        }
        form label {
            font-weight: 600;
        }
        form input {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <nav class="sidebar d-flex flex-column">
        <div class="logo">LOGO NAME</div>
        <a href="/admin/dashboard" class="nav-link">Dashboard</a>
        <a href="/admin/patients" class="nav-link">Patients</a>
        <a href="/admin/appointments" class="nav-link">Appointments</a>
        <a href="/admin/billing" class="nav-link">Billing</a>
        <a href="/admin/pharmacy" class="nav-link">Pharmacy</a>
        <a href="/admin/reports" class="nav-link">Reports</a>
        <a href="/admin/users" class="nav-link active">Users</a>
        <a href="/admin/settings" class="nav-link">Settings</a>
         <a href="/logout" class="btn btn-danger logout-btn mt-auto">Log Out</a>
    </nav>
    </nav>
    <main class="content">
        <h2>Edit User</h2>
        <form action="/admin/users/update/<?= esc($user['id']) ?>" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required />
            <label for="password">Password (leave blank to keep current)</label>
            <input type="password" id="password" name="password" class="form-control" />
            <label for="role">Role</label>
            <input type="text" id="role" name="role" class="form-control" value="<?= esc($user['role']) ?>" required />
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= esc($user['name']) ?>" required />
            <button type="submit" class="btn btn-primary mt-3">Update User</button>
        </form>
    </main>
</body>
</html>
