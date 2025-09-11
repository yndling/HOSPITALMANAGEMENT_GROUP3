<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Healthcare Dashboard</title>
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
        .chart-container {
            max-width: 900px;
            margin: 1rem auto 0 auto;
        }
        .logout-btn {
            margin-top: 2rem;
            
        }
    </style>
</head>
<body>
    <nav class="sidebar d-flex flex-column">
        <div class="logo">LOGO NAME</div>
        <a href="/admin/dashboard" class="nav-link active">Dashboard</a>
        <a href="/admin/patients" class="nav-link">Patients</a>
        <a href="/admin/appointments" class="nav-link">Appointments</a>
        <a href="/admin/billing" class="nav-link">Billing</a>
        <a href="/admin/pharmacy" class="nav-link">Pharmacy</a>
        <a href="/admin/reports" class="nav-link">Reports</a>
        <a href="/admin/users" class="nav-link">Users</a>
        <a href="/admin/settings" class="nav-link">Settings</a>
        <a href="/logout" class="btn btn-danger logout-btn mt-auto">Log Out</a>
    </nav>
    </nav>
    <main class="content">
        <h2>Healthcare Dashboard</h2>
        <div class="mt-4">
            <h5>EMERGENCY VISITS</h5>
            <div class="chart-container">
                <canvas id="emergencyChart"></canvas>
            </div>
        </div>
        <div class="d-flex justify-content-around mt-4">
        </div>
    </main>

    <section style="margin: 2rem 1rem;">
        <!-- Removed New Patient form as per user request -->
    </section>

    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('emergencyChart').getContext('2d');
        const emergencyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                datasets: [{
                    label: 'Emergency Visits',
                    data: [11000, 9000, 12000, 3000, 1500, 10000, 20000],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(199, 199, 199, 0.7)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        type: 'logarithmic',
                        beginAtZero: true,
                        ticks: {
                            font: {
                                weight: 'bold'
                            },
                            callback: function(value) {
                                return Number(value.toString());
                            }
                        },
                        grid: {
                            borderColor: 'black',
                            borderWidth: 2,
                            color: 'black',
                            lineWidth: 2,
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            borderColor: 'black',
                            borderWidth: 2,
                            color: 'black',
                            lineWidth: 2,
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
