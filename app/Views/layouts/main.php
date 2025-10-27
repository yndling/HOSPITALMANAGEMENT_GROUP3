<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hospital Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            color: #333;
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
        
        /* High contrast status badges */
        .badge {
            border: 1px solid rgba(0,0,0,0.2);
        }
        .badge-warning {
            background-color: #ffc107 !important;
            color: #000 !important;
            border-color: #ffb300;
        }
        .badge-primary {
            background-color: #0d6efd !important;
            color: #fff !important;
            border-color: #0a58ca;
        }
        .badge-success {
            background-color: #198754 !important;
            color: #fff !important;
            border-color: #146c43;
        }
        .badge-secondary {
            background-color: #6c757d !important;
            color: #fff !important;
            border-color: #5c636a;
        }
    </style>
</head>
<body>

<?= view('templates/header') ?>

<main class="content">
    <?= $this->renderSection('content') ?>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
