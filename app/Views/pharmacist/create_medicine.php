<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add New Medicine - Pharmacist Dashboard</title>
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
        .btn-group {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <div class="logo">LOGO NAME</div>
        <a href="<?= base_url('/pharmacy/dashboard') ?>" class="nav-link">Dashboard</a>
        <a href="<?= base_url('/pharmacy/medicines') ?>" class="nav-link active">Medicines</a>
        <a href="<?= base_url('/pharmacy/prescriptions') ?>" class="nav-link">Prescriptions</a>
        <a href="<?= base_url('/logout') ?>" class="btn btn-danger mt-auto">Logout</a>
    </nav>
    <main class="content">
        <h1>Add New Medicine</h1>
        <form action="<?= base_url('/pharmacy/medicines/store') ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Medicine Name</label>
                <input type="text" class="form-control" id="name" name="name" required />
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required />
            </div>
            <div class="mb-3">
                <label for="expiry" class="form-label">Expiry Date</label>
                <input type="date" class="form-control" id="expiry" name="expiry" required />
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Save Medicine</button>
                <a href="<?= base_url('/pharmacy/medicines') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </main>
</body>
</html>
