<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - Hospital Management</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 400px;">
            <h3 class="text-center mb-4">CREATE ACCOUNT</h3>

            <!-- Error messages -->
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?php 
                        $errors = session()->getFlashdata('error');
                        if (is_array($errors)): 
                            foreach ($errors as $err): ?>
                                <div><?= esc($err) ?></div>
                            <?php endforeach; 
                        else: 
                            echo esc($errors); 
                        endif; 
                    ?>
                </div>
            <?php endif; ?>

            <!-- Success message -->
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <!-- Registration form -->
            <form action="<?= site_url('register') ?>" method="post">
                <?= csrf_field() ?> <!-- CSRF protection -->

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="name" 
                        name="name" 
                        value="<?= old('name') ?>" 
                        required 
                        autofocus
                    />
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        name="email" 
                        value="<?= old('email') ?>" 
                        required
                    />
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="" disabled <?= old('role') ? '' : 'selected' ?>>Select your role</option>
                        <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Hospital Administrator</option>
                        <option value="doctor" <?= old('role') === 'doctor' ? 'selected' : '' ?>>Doctor</option>
                        <option value="nurse" <?= old('role') === 'nurse' ? 'selected' : '' ?>>Nurse</option>
                        <option value="receptionist" <?= old('role') === 'receptionist' ? 'selected' : '' ?>>Receptionist</option>
                        <option value="laboratory staff" <?= old('role') === 'laboratory staff' ? 'selected' : '' ?>>Laboratory Staff</option>
                        <option value="pharmacist" <?= old('role') === 'pharmacist' ? 'selected' : '' ?>>Pharmacist</option>
                        <option value="accountant" <?= old('role') === 'accountant' ? 'selected' : '' ?>>Accountant</option>
                        <option value="it staff" <?= old('role') === 'it staff' ? 'selected' : '' ?>>IT Staff</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password" 
                        name="password" 
                        required
                    />
                </div>

                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Confirm Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password_confirm" 
                        name="password_confirm" 
                        required
                    />
                </div>

                <button type="submit" class="btn btn-success w-100">REGISTER</button>
            </form>

            <div class="text-center mt-3">
                Already have an account? <a href="<?= site_url('login') ?>">Back to Login</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
