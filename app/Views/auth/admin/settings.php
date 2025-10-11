<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>System Settings</h1>
            <p class="lead">Configure hospital system settings and preferences.</p>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">General Settings</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="hospitalName" class="form-label">Hospital Name</label>
                                    <input type="text" class="form-control" id="hospitalName" value="City Hospital" placeholder="Enter hospital name">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" rows="3" placeholder="Enter hospital address">123 Main St, City, State 12345</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Contact Phone</label>
                                    <input type="tel" class="form-control" id="phone" value="+1-234-567-8900" placeholder="Enter phone number">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Admin Email</label>
                                    <input type="email" class="form-control" id="email" value="admin@hospital.com" placeholder="Enter admin email">
                                </div>
                                <button type="submit" class="btn btn-primary">Save General Settings</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Email Configuration</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="smtpHost" class="form-label">SMTP Host</label>
                                    <input type="text" class="form-control" id="smtpHost" value="smtp.gmail.com" placeholder="Enter SMTP host">
                                </div>
                                <div class="mb-3">
                                    <label for="smtpPort" class="form-label">SMTP Port</label>
                                    <input type="number" class="form-control" id="smtpPort" value="587" placeholder="Enter port">
                                </div>
                                <div class="mb-3">
                                    <label for="smtpUser" class="form-label">SMTP Username</label>
                                    <input type="email" class="form-control" id="smtpUser" value="noreply@hospital.com" placeholder="Enter username">
                                </div>
                                <div class="mb-3">
                                    <label for="smtpPass" class="form-label">SMTP Password</label>
                                    <input type="password" class="form-control" id="smtpPass" placeholder="Enter password">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="smtpEncryption">
                                    <label class="form-check-label" for="smtpEncryption">Enable TLS Encryption</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Email Settings</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Security Settings</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="minPasswordLength" class="form-label">Minimum Password Length</label>
                            <input type="number" class="form-control" id="minPasswordLength" value="8" min="6" max="20">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="requireTwoFactor">
                            <label class="form-check-label" for="requireTwoFactor">Require Two-Factor Authentication for Admins</label>
                        </div>
                        <div class="mb-3">
                            <label for="sessionTimeout" class="form-label">Session Timeout (minutes)</label>
                                    <input type="number" class="form-control" id="sessionTimeout" value="30" min="15" max="120">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Security Settings</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
