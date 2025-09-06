<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nurse Appointments</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            border-bottom: 1px solid #ddd;
            padding: 0.75rem;
            text-align: left;
        }
        th {
            background-color: #f7f7f7;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="sidebar d-flex flex-column">
        <div class="logo">LOGO NAME</div>
        <a href="/nurse/dashboard" class="nav-link">Dashboard</a>
        <a href="/nurse/patients" class="nav-link">Patients</a>
        <a href="/nurse/appointments" class="nav-link active">Appointments</a>
        <a href="/nurse/medications" class="nav-link">Medications</a>
        <a href="/login/logout" class="btn btn-danger logout-btn" style="margin-top:auto;">Log Out</a>
    </nav>
    <main class="content">
        <h2>Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Patient Name</th>
                    <th>Doctor</th>
                    <th>Room/Location</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>09:00 AM</td>
                    <td>John Doe</td>
                    <td>Dr. Smith</td>
                    <td>101</td>
                </tr>
                <tr>
                    <td>10:30 AM</td>
                    <td>Jane Smith</td>
                    <td>Dr. Adams</td>
                    <td>102</td>
                </tr>
                <tr>
                    <td>01:00 PM</td>
                    <td>Bob Johnson</td>
                    <td>Dr. Lee</td>
                    <td>103</td>
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>
