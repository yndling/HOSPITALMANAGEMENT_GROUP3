<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1">Patient Details</h1>
                    <p class="text-muted mb-0">View and manage patient information and nursing tasks</p>
                </div>
                <div>
                    <a href="/nurse/patients" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Patients
                    </a>
                </div>
            </div>

            <?php if (isset($patient) && $patient): ?>
                <!-- Patient Information Card -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-user me-2"></i>Patient Information
                                </h5>
                                <div>
                                    <a href="<?= base_url('nurse/patients/vitals/' . $patient['id']) ?>" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit me-1"></i>Update Vitals
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Patient Name</label>
                                            <p class="form-control-plaintext"><?= esc($patient['name']) ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Age</label>
                                            <p class="form-control-plaintext"><?= esc($patient['age'] ?? 'N/A') ?> years</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Gender</label>
                                            <p class="form-control-plaintext"><?= esc($patient['gender'] ?? 'N/A') ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Room Number</label>
                                            <p class="form-control-plaintext">
                                                <span class="badge bg-primary">101</span>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Admission Date</label>
                                            <p class="form-control-plaintext"><?= esc(date('M j, Y', strtotime($patient['created_at'] ?? 'now'))) ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Status</label>
                                            <p class="form-control-plaintext">
                                                <span class="badge bg-success">Active</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nursing Tasks -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-tasks me-2"></i>Nursing Tasks
                                </h5>
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i>Add Task
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Task</th>
                                                <th>Assigned Time</th>
                                                <th>Due Time</th>
                                                <th>Status</th>
                                                <th>Notes</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold">Check Vitals</div>
                                                    <small class="text-muted">Routine monitoring</small>
                                                </td>
                                                <td>08:00 AM</td>
                                                <td>08:30 AM</td>
                                                <td><span class="badge bg-success">Completed</span></td>
                                                <td>All vitals normal</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-outline-primary" onclick="viewTask('task_1', 'Check Vitals')">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-outline-success" disabled>
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold">Administer Medication</div>
                                                    <small class="text-muted">Paracetamol 500mg</small>
                                                </td>
                                                <td>09:00 AM</td>
                                                <td>09:15 AM</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>Due for administration</td>
                                                <td>
                                                    <button class="btn btn-outline-warning btn-sm" onclick="administerMedication('med_1')">
                                                        <i class="fas fa-pills"></i> Administer
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold">Change Dressing</div>
                                                    <small class="text-muted">Post-surgery care</small>
                                                </td>
                                                <td>10:00 AM</td>
                                                <td>10:30 AM</td>
                                                <td><span class="badge bg-primary">In Progress</span></td>
                                                <td>Wound healing well</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-outline-primary" onclick="viewTask('task_3', 'Change Dressing')">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-outline-success" onclick="completeDressingChange('task_3', this)">
                                                            <i class="fas fa-check"></i> Mark as Complete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Appointments -->
                <?php if (isset($appointments) && !empty($appointments)): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-calendar-alt me-2"></i>Recent Appointments
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Doctor</th>
                                                <th>Purpose</th>
                                                <th>Status</th>
                                                <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($appointments as $appointment): ?>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold"><?= esc(date('M j, Y', strtotime($appointment['appointment_date'] ?? 'now'))) ?></div>
                                                    <small class="text-muted"><?= esc(date('g:i A', strtotime($appointment['appointment_time'] ?? 'now'))) ?></small>
                                                </td>
                                                <td><?= esc($appointment['doctor_name'] ?? 'Dr. Unknown') ?></td>
                                                <td><?= esc($appointment['purpose'] ?? 'General Checkup') ?></td>
                                                <td>
                                                    <span class="badge bg-info">Scheduled</span>
                                                </td>
                                                <td><?= esc($appointment['notes'] ?? 'No notes') ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            <?php else: ?>
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                        <h4>Patient Not Found</h4>
                        <p class="text-muted">The requested patient could not be found.</p>
                        <a href="/nurse/patients" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Patients
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Function to show toast message
    function showToast(message, type = 'info') {
        // Create toast container if it doesn't exist
        let toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toastContainer';
            toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
            toastContainer.style.zIndex = '1100';
            document.body.appendChild(toastContainer);
        }
        
        const toastId = 'toast-' + Math.random().toString(36).substr(2, 9);
        const toastClass = type === 'success' ? 'bg-success text-white' : 'bg-info text-dark';
        
        const toastHTML = `
            <div id="${toastId}" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">${type === 'success' ? 'Success' : 'Info'}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;
        
        const toastElement = document.createElement('div');
        toastElement.innerHTML = toastHTML;
        toastContainer.appendChild(toastElement.firstElementChild);
        
        // Auto-remove toast after 5 seconds
        setTimeout(() => {
            const toast = document.getElementById(toastId);
            if (toast) {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 150);
            }
        }, 5000);
    }

    // Function to handle medication task completion
    function completeMedicationTask(taskId, button) {
        // Show confirmation dialog
        if (confirm('Are you sure you want to mark this medication as administered and complete?')) {
            // Show loading state
            const originalContent = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Completing...';
            
            // Simulate API call with timeout
            setTimeout(() => {
                try {
                    // Update the status in the UI
                    const row = button.closest('tr');
                    const statusCell = row.querySelector('td:nth-child(4)');
                    statusCell.innerHTML = '<span class="badge bg-success">Completed</span>';
                    
                    // Update the completion time to now
                    const timeCell = row.querySelector('td:nth-child(2)');
                    const now = new Date();
                    timeCell.textContent = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    
                    // Update the notes to show when it was completed
                    const notesCell = row.querySelector('td:nth-child(5)');
                    notesCell.textContent = 'Administered at ' + now.toLocaleTimeString();
                    
                    // Disable the button and change its appearance
                    button.innerHTML = '<i class="fas fa-check"></i> Completed';
                    button.classList.remove('btn-outline-success');
                    button.classList.add('btn-success');
                    
                    // Also disable the administer button
                    const adminButton = row.querySelector('button.btn-outline-warning');
                    if (adminButton) {
                        adminButton.disabled = true;
                        adminButton.classList.remove('btn-outline-warning');
                        adminButton.classList.add('btn-secondary');
                    }
                    
                    // Show success message
                    showToast('Medication administration completed successfully', 'success');
                } catch (error) {
                    console.error('Error completing medication task:', error);
                    button.innerHTML = originalContent;
                    button.disabled = false;
                    showToast('Error completing task. Please try again.', 'error');
                }
            }, 1000);
        }
    }
    
    // Function to mark task as complete
    function markTaskComplete(taskId, button) {
        // Show confirmation modal
        const modal = new bootstrap.Modal(document.getElementById('confirmCompleteModal'));
        const confirmBtn = document.getElementById('confirmCompleteBtn');
        
        // Store task ID and button in modal for later use
        confirmBtn.dataset.taskId = taskId;
        confirmBtn.dataset.buttonId = 'btn-' + Math.random().toString(36).substr(2, 9);
        button.id = confirmBtn.dataset.buttonId;
        
        modal.show();
    }
    
    // Function to handle the actual completion of the task
    function completeTask(button) {
        const taskId = button.dataset.taskId;
        const originalButton = document.getElementById(button.dataset.buttonId);
        const row = originalButton.closest('tr');
        
        // Show loading state
        const originalContent = originalButton.innerHTML;
        originalButton.disabled = true;
        originalButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        
        // Simulate API call with timeout
        setTimeout(() => {
            // Update the status in the UI
            const statusCell = row.querySelector('td:nth-child(4)');
            statusCell.innerHTML = '<span class="badge bg-success">Completed</span>';
            
            // Update the time to now
            const timeCell = row.querySelector('td:nth-child(2)');
            const now = new Date();
            timeCell.textContent = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            
            // Disable the complete button
            originalButton.innerHTML = '<i class="fas fa-check"></i>';
            originalButton.disabled = true;
            originalButton.classList.remove('btn-outline-success');
            originalButton.classList.add('btn-success');
            
            // Show success message
            showToast('Task marked as complete', 'success');
            
            // Hide the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('confirmCompleteModal'));
            modal.hide();
        }, 1000);
    }
    
    // Function to show toast message
    function showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toastContainer');
        const toastId = 'toast-' + Math.random().toString(36).substr(2, 9);
        const toastClass = type === 'success' ? 'bg-success text-white' : 'bg-info text-dark';
        
        const toastHTML = `
            <div id="${toastId}" class="toast align-items-center ${toastClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        
        // Add toast to container
        const toastElement = document.createElement('div');
        toastElement.innerHTML = toastHTML.trim();
        toastContainer.appendChild(toastElement.firstChild);
        
        // Initialize and show the toast
        const toast = new bootstrap.Toast(document.getElementById(toastId), {
            autohide: true,
            delay: 3000
        });
        toast.show();
        
        // Remove toast after it's hidden
        document.getElementById(toastId).addEventListener('hidden.bs.toast', function () {
            this.remove();
        });
    }
    
    // Function to handle dressing change completion
    function completeDressingChange(taskId, button) {
        // Show confirmation dialog
        if (confirm('Are you sure you want to mark the dressing change as complete?')) {
            // Show loading state
            const originalContent = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Completing...';
            
            // Simulate API call with timeout
            setTimeout(() => {
                // Update the status in the UI
                const row = button.closest('tr');
                const statusCell = row.querySelector('td:nth-child(4)');
                statusCell.innerHTML = '<span class="badge bg-success">Completed</span>';
                
                // Update the completion time to now
                const timeCell = row.querySelector('td:nth-child(2)');
                const now = new Date();
                timeCell.textContent = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                
                // Disable the button and change its appearance
                button.innerHTML = '<i class="fas fa-check"></i> Completed';
                button.classList.remove('btn-outline-success');
                button.classList.add('btn-success');
                
                // Show success message
                showToast('Dressing change marked as complete', 'success');
            }, 1000);
        }
    }
    
    // Function to view task details
    function viewTask(taskId, taskType) {
        // Show loading state
        const button = event.target.closest('button');
        const originalContent = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        
        // In a real application, you would make an AJAX call to fetch task details
        // For now, we'll simulate a delay and show a modal
        setTimeout(() => {
            // Reset button state
            button.disabled = false;
            button.innerHTML = originalContent;
            
            // Show task details in a modal
            const modal = new bootstrap.Modal(document.getElementById('taskModal'));
            const modalTitle = document.getElementById('taskModalLabel');
            const modalBody = document.getElementById('taskModalBody');
            
            // Set modal content based on task type
            modalTitle.textContent = `View ${taskType} Details`;
            
            // This would be replaced with actual task details from an API call
            const taskDetails = {
                'Check Vitals': 'Vital signs are within normal ranges. Last updated: ' + new Date().toLocaleString(),
                'Administer Medication': 'Medication details and administration instructions would appear here.',
                'Change Dressing': 'Wound care instructions and notes would appear here.'
            };
            
            modalBody.innerHTML = `
                <div class="mb-3">
                    <h6>Task Details</h6>
                    <p>${taskDetails[taskType] || 'No additional details available.'}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea class="form-control" rows="3" placeholder="Add notes about this task..."></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateTaskStatus(${taskId}, 'completed')">Mark as Completed</button>
                </div>
            `;
            
            modal.show();
        }, 500);
    }
    
    // Function to update task status
    function updateTaskStatus(taskId, status) {
        // Show loading state
        const button = event.target;
        const originalContent = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
        
        // In a real application, you would make an AJAX call to update the task status
        setTimeout(() => {
            // Reset button state
            button.disabled = false;
            button.innerHTML = originalContent;
            
            // Show success message
            const modal = bootstrap.Modal.getInstance(document.getElementById('taskModal'));
            modal.hide();
            
            // Show toast notification
            const toastEl = document.getElementById('toastNotification');
            const toast = new bootstrap.Toast(toastEl);
            document.getElementById('toastMessage').textContent = 'Task status updated successfully!';
            toast.show();
            
            // Reload the page after a short delay
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        }, 800);
    }
    
    // Function to handle medication administration
    function administerMedication(taskId) {
        // Show loading state
        const button = event.target.closest('button');
        const originalContent = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
        
        // In a real application, you would make an AJAX call to update the medication administration
        setTimeout(() => {
            // Show medication administration modal
            const modal = new bootstrap.Modal(document.getElementById('medicationModal'));
            const modalBody = document.getElementById('medicationModalBody');
            
            modalBody.innerHTML = `
                <div class="mb-3">
                    <h6>Medication Administration</h6>
                    <p>Please confirm the following details before administering medication:</p>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Medication
                            <span class="badge bg-primary rounded-pill">Paracetamol 500mg</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Dosage
                            <span class="badge bg-primary rounded-pill">1 tablet</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Route
                            <span class="badge bg-primary rounded-pill">Oral</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Frequency
                            <span class="badge bg-primary rounded-pill">Every 6 hours</span>
                        </li>
                    </ul>
                    <div class="mb-3">
                        <label class="form-label">Administration Notes</label>
                        <textarea class="form-control" rows="3" placeholder="Add any notes about this administration..."></textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="confirmAdministered">
                        <label class="form-check-label" for="confirmAdministered">
                            I confirm that I have administered the medication as prescribed
                        </label>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="confirmMedicationAdministered(${taskId})">Confirm Administration</button>
                    </div>
                </div>
            `;
            
            // Reset button state
            button.disabled = false;
            button.innerHTML = originalContent;
            
            modal.show();
        }, 500);
    }
    
    // Function to confirm medication administration
    function confirmMedicationAdministered(taskId) {
        const confirmCheckbox = document.getElementById('confirmAdministered');
        if (!confirmCheckbox.checked) {
            alert('Please confirm that you have administered the medication.');
            return;
        }
        
        // Show loading state
        const button = event.target;
        const originalContent = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
        
        // In a real application, you would make an AJAX call to update the medication administration
        setTimeout(() => {
            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('medicationModal'));
            modal.hide();
            
            // Show success message
            const toastEl = document.getElementById('toastNotification');
            const toast = new bootstrap.Toast(toastEl);
            document.getElementById('toastMessage').textContent = 'Medication administration recorded successfully!';
            toast.show();
            
            // Reload the page after a short delay
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        }, 800);
    }
</script>

<!-- Confirm Complete Modal -->
<div class="modal fade" id="confirmCompleteModal" tabindex="-1" aria-labelledby="confirmCompleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmCompleteModalLabel">Confirm Completion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to mark this task as complete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirmCompleteBtn" onclick="completeTask(this)">
                    <i class="fas fa-check me-1"></i> Mark as Complete
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div id="toastContainer" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11"></div>

<!-- Task Details Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Task Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="taskModalBody">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Medication Administration Modal -->
<div class="modal fade" id="medicationModal" tabindex="-1" aria-labelledby="medicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="medicationModalLabel">Medication Administration</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="medicationModalBody">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastNotification" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage">
                <!-- Message will be set dynamically -->
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
