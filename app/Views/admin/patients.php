<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Patients - Healthcare Dashboard</title>
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
            max-width: 900px;
        }
        form label {
            font-style: italic;
            font-weight: 600;
        }
        form input, form textarea {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <nav class="sidebar d-flex flex-column">
        <div class="logo">LOGO NAME</div>
        <a href="/admin/dashboard" class="nav-link">Dashboard</a>
        <a href="/admin/patients" class="nav-link active">Patients</a>
        <a href="/admin/appointments" class="nav-link">Appointments</a>
        <a href="/admin/billing" class="nav-link">Billing</a>
        <a href="/admin/pharmacy" class="nav-link">Pharmacy</a>
        <a href="/admin/reports" class="nav-link">Reports</a>
        <a href="/admin/users" class="nav-link">Users</a>
        <a href="/admin/settings" class="nav-link">Settings</a>
        <a href="/login/logout" class="btn btn-danger logout-btn mt-auto">Log Out</a>
    </nav>
    <main class="content">
        <h2>New Patient</h2>
        <form>
            <div class="row">
                <div class="col-md-6">
                    <label for="patientName">Patient Name:</label>
                    <input type="text" id="patientName" class="form-control" placeholder="Patient Name" />
                    <label for="age">Age:</label>
                    <input type="number" id="age" class="form-control" placeholder="Age" />
                    <label for="sex">Sex:</label>
                    <input type="text" id="sex" class="form-control" placeholder="Sex" />
                    <label for="maritalStatus">Marital Status:</label>
                    <input type="text" id="maritalStatus" class="form-control" placeholder="Marital Status" />
                    <label for="mobileNo">Mobile No:</label>
                    <input type="text" id="mobileNo" class="form-control" placeholder="Mobile No" />
                    <label for="address">Address:</label>
                    <textarea id="address" class="form-control" rows="2" placeholder="Address"></textarea>
                    <label for="consultDoctor">Consult Doctor:</label>
                    <input type="text" id="consultDoctor" class="form-control" placeholder="Consult Doctor" />
                </div>
                <div class="col-md-6">
                    <label for="date">Date:</label>
                    <input type="date" id="date" class="form-control" />
                    <label for="bloodType">Blood Type:</label>
                    <input type="text" id="bloodType" class="form-control" placeholder="Blood Type" />
                    <label for="religion">Religion:</label>
                    <input type="text" id="religion" class="form-control" placeholder="Religion" />
                </div>
            </div>
        <button type="submit" class="btn btn-primary mt-3">Add Patient</button>
        </form>
    </main>
</body>
</html>
</body>
</html>
