<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Hospital Management</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 350px;">
            <h3 class="text-center mb-4">LOG IN</h3>
            
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('login') ?>" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required />
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="" disabled selected>Select your role</option>
                        <option value="admin">Hospital Administrator</option>
                        <option value="doctor">Doctor</option>
                        <option value="nurse">Nurse</option>
                        <option value="receptionist">Receptionist</option>
                        <option value="laboratory staff">Laboratory Staff</option>
                        <option value="pharmacist">Pharmacist</option>
                        <option value="accountant">Accountant</option>
                        <option value="it staff">IT Staff</option>
                    </select>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" />
                    <label class="form-check-label" for="remember">Remember</label>
                    <a href="#" class="float-end">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary w-100">SUBMIT</button>
            </form>

            <div class="text-center mt-3">
                <a href="<?= site_url('register') ?>">Create Account</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
