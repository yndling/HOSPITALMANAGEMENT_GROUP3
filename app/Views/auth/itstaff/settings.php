<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>System Settings</h1>
            <p class="lead">Configure hospital management system settings.</p>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">General Settings</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="hospitalName" class="form-label">Hospital Name</label>
                                    <input type="text" class="form-control" id="hospitalName" value="City General Hospital">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Admin Email</label>
                                    <input type="email" class="form-control" id="email" value="admin@hospital.com">
                                </div>
                                <div class="mb-3">
                                    <label for="timezone" class="form-label">Timezone</label>
                                    <select class="form-select" id="timezone">
                                        <option selected>UTC-5</option>
                                        <option>UTC-6</option>
                                        <option>UTC-7</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="backupFrequency" class="form-label">Backup Frequency</label>
                                    <select class="form-select" id="backupFrequency">
                                        <option selected>Daily</option>
                                        <option>Weekly</option>
                                        <option>Monthly</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="sessionTimeout" class="form-label">Session Timeout (minutes)</label>
                                    <input type="number" class="form-control" id="sessionTimeout" value="30">
                                </div>
                                <div class="mb-3">
                                    <label for="maintenanceMode" class="form-label">Maintenance Mode</label>
                                    <select class="form-select" id="maintenanceMode">
                                        <option selected>Off</option>
                                        <option>On</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Security Settings</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Setting</th>
                                    <th>Current Value</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Password Policy</td>
                                    <td>Minimum 8 characters</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Two-Factor Authentication</td>
                                    <td>Enabled</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Login Attempts Limit</td>
                                    <td>5 attempts</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                                    </td>
                                </tr>
                                <!-- Add more dummy rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
