- [x] Update AuthController.php to load 'auth/dashboard' view instead of 'templates/dashboard'

## Admin Sub-Pages Implementation (with Sidebar)

- [x] Create app/Controllers/AdminController.php with role check and methods for each sub-page (patients, appointments, billing, pharmacy, reports, users, settings)
- [x] Update app/Config/Routes.php to add /admin route group with mappings to AdminController methods
- [x] Use and update existing sidebar in app/Views/templates/header.php for dynamic active classes and admin menu
- [x] Create app/Views/auth/admin/patients.php (extend layout, include sidebar, placeholder patients table with dummy data)
- [x] Create app/Views/auth/admin/appointments.php (extend layout, include sidebar, placeholder appointments list/table)
- [x] Create app/Views/auth/admin/billing.php (extend layout, include sidebar, billing cards and invoices table)
- [x] Create app/Views/auth/admin/pharmacy.php (extend layout, include sidebar, pharmacy inventory table)
- [x] Create app/Views/auth/admin/reports.php (extend layout, include sidebar, reports summary cards and chart placeholder)
- [x] Create app/Views/auth/admin/users.php (extend layout, include sidebar, users table with dummy data)
- [x] Create app/Views/auth/admin/settings.php (extend layout, include sidebar, settings form placeholders)
- [x] Update TODO.md to mark completed steps
- [ ] Test: Run php spark serve, login as admin, navigate to /admin/patients etc., verify sidebar and content

## Doctor Sub-Pages Implementation (with Sidebar)

- [x] Create app/Controllers/DoctorController.php with role check and methods for each sub-page (dashboard, patients, appointments, prescriptions, lab)
- [x] Update app/Config/Routes.php to add /doctor route group with mappings to DoctorController methods
- [x] Update app/Views/auth/dashboard.php to remove doctor section (move to new views)
- [ ] Create app/Views/auth/doctor/dashboard.php (extend layout, include sidebar, doctor dashboard cards from image: Total Patients, Upcoming Appointments) - Using existing dashboard instead
- [x] Create app/Views/auth/doctor/patients.php (extend layout, include sidebar, patient list table for doctor)
- [x] Create app/Views/auth/doctor/appointments.php (extend layout, include sidebar, doctor's appointments table)
- [x] Create app/Views/auth/doctor/prescriptions.php (extend layout, include sidebar, prescriptions management table)
- [x] Create app/Views/auth/doctor/lab.php (extend layout, include sidebar, lab tests/requests table)
- [x] Update TODO.md to mark completed steps
- [x] Test: Run php spark serve, login as doctor, navigate to /doctor/dashboard etc., verify sidebar and content

## Nurse and Receptionist Sub-Pages Implementation (with Sidebar)

- [x] Create app/Controllers/NurseController.php with role check and methods for each sub-page (patients, appointments, medications)
- [x] Create app/Controllers/ReceptionistController.php with role check and methods for each sub-page (patients, appointments)
- [x] Update app/Config/Routes.php to add /nurse and /receptionist route groups with mappings to respective controllers
- [x] Update app/Views/templates/header.php for dynamic active classes in nurse and receptionist sidebar sections
- [x] Create app/Views/auth/nurse/patients.php (extend layout, include sidebar, nurse patient vitals/tasks table)
- [x] Create app/Views/auth/nurse/appointments.php (extend layout, include sidebar, nurse appointment schedule table)
- [x] Create app/Views/auth/nurse/medications.php (extend layout, include sidebar, medication administration log table)
- [x] Create app/Views/auth/receptionist/patients.php (extend layout, include sidebar, patient registration/check-in table)
- [x] Create app/Views/auth/receptionist/appointments.php (extend layout, include sidebar, appointment booking/management table)
- [x] Update TODO.md to mark completed steps
- [ ] Test: Run php spark serve, login as nurse/receptionist, navigate to /nurse/patients etc., verify sidebar and content

## Remaining Roles Sub-Pages Implementation (with Sidebar)

- [x] Create app/Controllers/LabController.php with role check and methods for each sub-page (requests, results)
- [x] Create app/Controllers/PharmacyController.php with role check and methods for each sub-page (medicines, prescriptions)
- [x] Create app/Controllers/AccountantController.php with role check and methods for each sub-page (bills, reports, payments)
- [x] Create app/Controllers/ItStaffController.php with role check and methods for each sub-page (userAccounts, logs, backups, settings)
- [x] Update app/Config/Routes.php to add /lab, /pharmacy, /accountant, /itstaff route groups with mappings to respective controllers
- [x] Update app/Views/templates/header.php for dynamic active classes in remaining roles sidebar sections (change Dashboard to /dashboard)
- [x] Create app/Views/auth/lab/requests.php (extend layout, include sidebar, lab test requests table)
- [x] Create app/Views/auth/lab/results.php (extend layout, include sidebar, lab results table)
- [x] Create app/Views/auth/pharmacy/medicines.php (extend layout, include sidebar, medicine inventory table)
- [x] Create app/Views/auth/pharmacy/prescriptions.php (extend layout, include sidebar, prescription fulfillment table)
- [x] Create app/Views/auth/accountant/bills.php (extend layout, include sidebar, bills/invoices table)
- [x] Create app/Views/auth/accountant/reports.php (extend layout, include sidebar, financial reports cards/table)
- [x] Create app/Views/auth/accountant/payments.php (extend layout, include sidebar, payments log table)
- [x] Create app/Views/auth/itstaff/userAccounts.php (extend layout, include sidebar, user management table)
- [x] Create app/Views/auth/itstaff/logs.php (extend layout, include sidebar, system logs table)
- [x] Create app/Views/auth/itstaff/backups.php (extend layout, include sidebar, backup status table)
- [x] Create app/Views/auth/itstaff/settings.php (extend layout, include sidebar, system settings form placeholders)
- [x] Update TODO.md to mark completed steps
- [ ] Test: Run php spark serve, login as each remaining role, navigate to /lab/requests etc., verify sidebar and content

## Separate Role-Specific Dashboards

- [ ] Create app/Views/auth/doctor/dashboard.php (extend layout, include sidebar, cards: Total Patients, Upcoming Appointments)
- [ ] Create app/Views/auth/nurse/dashboard.php (extend layout, include sidebar, nurse tasks table)
- [ ] Create app/Views/auth/receptionist/dashboard.php (extend layout, include sidebar, receptionist cards: Today's Patients, Upcoming Appointments, Pending Tasks)
- [ ] Create app/Views/auth/lab/dashboard.php (extend layout, include sidebar, lab cards: Total Requests, Pending Tests, Completed Tests, Critical Alerts)
- [ ] Create app/Views/auth/pharmacy/dashboard.php (extend layout, include sidebar, pharmacy cards: Total Medicines, Pending Prescriptions, Dispensed Prescriptions)
- [ ] Create app/Views/auth/accountant/dashboard.php (extend layout, include sidebar, accountant cards: Total Bills, Pending Payments, Total Revenue)
- [ ] Create app/Views/auth/itstaff/dashboard.php (extend layout, include sidebar, IT cards: Total Tickets, Open Tickets, Resolved Tickets)
- [ ] Update app/Controllers/AuthController.php to load role-specific dashboard view (e.g., 'auth/doctor/dashboard' for doctor)
- [ ] Update app/Views/auth/dashboard.php to only handle admin or default
- [ ] Update TODO.md to mark completed steps
- [ ] Test: Run php spark serve, login as each role, verify dashboard loads correctly with role-specific content
