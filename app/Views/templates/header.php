<?php $session = session(); ?>
<style>
    .sidebar {
        width: 220px;
        background-color: #2c3e50;
        padding: 1rem;
        color: #ecf0f1;
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
    .sidebar .logout-btn {
        margin-top: 2rem;
    }
    .sidebar .logo {
        font-weight: bold;
        font-size: 1.8rem;
        margin-bottom: 2rem;
        color: #ecf0f1;
        letter-spacing: 2px;
        text-align: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid #34495e;
    }
</style>
<nav class="sidebar d-flex flex-column">
    <?php if ($session->get('role') === 'admin'): ?>
        <div class="logo">LOGO NAME</div>
        <a href="/admin/dashboard" class="nav-link active">Dashboard</a>
        <a href="/admin/patients" class="nav-link">Patients</a>
        <a href="/admin/appointments" class="nav-link">Appointments</a>
        <a href="/admin/billing" class="nav-link">Billing</a>
        <a href="/admin/pharmacy" class="nav-link">Pharmacy</a>
        <a href="/admin/reports" class="nav-link">Reports</a>
        <a href="/admin/users" class="nav-link">Users</a>
        <a href="/admin/settings" class="nav-link">Settings</a>
    <?php elseif ($session->get('role') === 'doctor'): ?>
        <div class="logo">LOGO NAME</div>
        <a href="/doctor/dashboard" class="nav-link active">Dashboard</a>
        <a href="/doctor/patients" class="nav-link">Patients</a>
        <a href="/doctor/appointments" class="nav-link">Appointments</a>
        <a href="/doctor/prescriptions" class="nav-link">Prescriptions</a>
        <a href="/doctor/lab" class="nav-link">Lab</a>
    <?php elseif ($session->get('role') === 'nurse'): ?>
        <div class="logo">LOGO NAME</div>
        <a href="/nurse/dashboard" class="nav-link active">Dashboard</a>
        <a href="/nurse/patients" class="nav-link">Patients</a>
        <a href="/nurse/appointments" class="nav-link">Appointments</a>
        <a href="/nurse/medications" class="nav-link">Medications</a>
    <?php elseif ($session->get('role') === 'receptionist'): ?>
        <div class="logo">LOGO NAME</div>
        <a href="/receptionist/dashboard" class="nav-link active">Dashboard</a>
        <a href="/receptionist/patients" class="nav-link">Patients</a>
        <a href="/receptionist/appointments" class="nav-link">Appointments</a>
    <?php elseif ($session->get('role') === 'laboratory_staff'): ?>
        <div class="logo">LOGO NAME</div>
        <a href="/lab/dashboard" class="nav-link active">Dashboard</a>
        <a href="/lab/requests" class="nav-link">Requests</a>
        <a href="/lab/results" class="nav-link">Results</a>
    <?php elseif ($session->get('role') === 'pharmacist'): ?>
        <div class="logo">LOGO NAME</div>
        <a href="/pharmacy/dashboard" class="nav-link active">Dashboard</a>
        <a href="/pharmacy/medicines" class="nav-link">Medicines</a>
        <a href="/pharmacy/prescriptions" class="nav-link">Prescriptions</a>
    <?php elseif ($session->get('role') === 'accountant'): ?>
        <div class="logo">LOGO NAME</div>
        <a href="/accountant/dashboard" class="nav-link active">Dashboard</a>
        <a href="/accountant/bills" class="nav-link">Bills</a>
        <a href="/accountant/reports" class="nav-link">Reports</a>
        <a href="/accountant/payments" class="nav-link">Payments</a>
    <?php elseif ($session->get('role') === 'it_staff' || $session->get('role') === 'itstaff'): ?>
        <div class="logo">LOGO NAME</div>
        <a href="/itstaff/dashboard" class="nav-link active">Dashboard</a>
        <a href="/itstaff/userAccounts" class="nav-link">User Accounts</a>
        <a href="/itstaff/logs" class="nav-link">Logs</a>
        <a href="/itstaff/backups" class="nav-link">Backups</a>
        <a href="/itstaff/settings" class="nav-link">Settings</a>
    <?php endif; ?>
    <a href="/logout" class="btn btn-danger logout-btn mt-auto">Log Out</a>
</nav>
