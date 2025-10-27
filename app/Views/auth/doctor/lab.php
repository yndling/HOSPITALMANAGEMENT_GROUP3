<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Lab Management</h1>
            <p class="lead">
                <?php if (session()->get('role') === 'doctor'): ?>
                    Request, view, and manage lab tests for your patients.
                <?php else: ?>
                    Manage lab supplies, process test requests, and record results.
                <?php endif; ?>
            </p>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Navigation Tabs for Lab Staff -->
            <?php if (session()->get('role') === 'lab_technician' || session()->get('role') === 'laboratory_staff'): ?>
                <ul class="nav nav-tabs" id="labTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="true">Test Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="supplies-tab" data-toggle="tab" href="#supplies" role="tab" aria-controls="supplies" aria-selected="false">Lab Supplies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="results-tab" data-toggle="tab" href="#results" role="tab" aria-controls="results" aria-selected="false">Test Results</a>
                    </li>
                </ul>

                <div class="tab-content" id="labTabContent">
                    <!-- Test Requests Tab -->
                    <div class="tab-pane fade show active" id="requests" role="tabpanel" aria-labelledby="requests-tab">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">Lab Test Requests</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Patient</th>
                                                <th>Test Type</th>
                                                <th>Urgency</th>
                                                <th>Requested Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($requests)): ?>
                                                <?php foreach ($requests as $request): ?>
                                                    <tr>
                                                        <td><?= $request['id'] ?></td>
                                                        <td><?= $request['patient'] ?? 'Unknown Patient' ?></td>
                                                        <td><?= $request['test'] ?? 'Unknown Test' ?></td>
                                                        <td>
                                                            <span class="badge badge-info">Normal</span>
                                                        </td>
                                                        <td><?= $request['created_at'] ? date('Y-m-d H:i', strtotime($request['created_at'])) : 'N/A' ?></td>
                                                        <td>
                                                            <span class="badge badge-<?= $request['status'] == 'Pending' ? 'warning' : ($request['status'] == 'In Progress' ? 'info' : ($request['status'] == 'Completed' ? 'success' : 'secondary')) ?>">
                                                                <?= $request['status'] ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <form method="post" action="/lab/requests/status/<?= $request['id'] ?>" style="display: inline;">
                                                                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                                    <option value="pending" <?= $request['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                                    <option value="in_progress" <?= $request['status'] == 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                                                                    <option value="completed" <?= $request['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                                                </select>
                                                            </form>
                                                            <?php if ($request['status'] == 'in_progress' || $request['status'] == 'completed'): ?>
                                                                <a href="/lab/results/add/<?= $request['id'] ?>" class="btn btn-success btn-sm ml-1">
                                                                    <i class="fas fa-plus"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">No lab requests found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lab Supplies Tab -->
                    <div class="tab-pane fade" id="supplies" role="tabpanel" aria-labelledby="supplies-tab">
                        <div class="card mt-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Laboratory Supplies Inventory</h5>
                                <a href="/lab/supplies/create" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add Supply
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($supplies)): ?>
                                                <?php foreach ($supplies as $supply): ?>
                                                    <tr>
                                                        <td><?= $supply['id'] ?></td>
                                                        <td><?= $supply['name'] ?></td>
                                                        <td><?= $supply['category'] ?></td>
                                                        <td>
                                                            <span class="badge badge-<?= $supply['type'] == 'consumable' ? 'info' : ($supply['type'] == 'equipment' ? 'warning' : 'secondary') ?>">
                                                                <?= ucfirst($supply['type']) ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-<?= $supply['quantity'] <= $supply['min_stock_level'] ? 'danger' : 'success' ?>">
                                                                <?= $supply['quantity'] ?>
                                                            </span>
                                                        </td>
                                                        <td><?= $supply['unit'] ?></td>
                                                        <td>
                                                            <span class="badge badge-<?= $supply['status'] == 'active' ? 'success' : 'secondary' ?>">
                                                                <?= ucfirst($supply['status']) ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="/lab/supplies/edit/<?= $supply['id'] ?>" class="btn btn-warning btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="/lab/supplies/delete/<?= $supply['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No supplies found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Test Results Tab -->
                    <div class="tab-pane fade" id="results" role="tabpanel" aria-labelledby="results-tab">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">Test Results</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Patient</th>
                                                <th>Test Name</th>
                                                <th>Result Value</th>
                                                <th>Unit</th>
                                                <th>Interpretation</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($results)): ?>
                                                <?php foreach ($results as $result): ?>
                                                    <tr>
                                                        <td><?= $result['id'] ?></td>
                                                        <td>Patient #<?= $result['patient_id'] ?></td>
                                                        <td><?= $result['test_name'] ?></td>
                                                        <td><?= $result['result_value'] ?></td>
                                                        <td><?= $result['unit'] ?></td>
                                                        <td>
                                                            <span class="badge badge-<?= $result['interpretation'] == 'Normal' ? 'success' : ($result['interpretation'] == 'High' || $result['interpretation'] == 'Low' ? 'warning' : 'danger') ?>">
                                                                <?= $result['interpretation'] ?>
                                                            </span>
                                                        </td>
                                                        <td><?= date('Y-m-d H:i', strtotime($result['created_at'])) ?></td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="viewResultDetails(<?= $result['id'] ?>)">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No test results found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Doctor's Lab Requests View -->
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-vial"></i> Lab Test Requests
                        </h5>
                        <a href="/doctor/lab/create" class="btn btn-light btn-sm">
                            <i class="fas fa-plus"></i> Request New Lab Test
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if (empty($requests)): ?>
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> No lab test requests found. Create your first request!
                        </div>
                        <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width: 5%;">ID</th>
                                        <th style="width: 20%;">Patient Name</th>
                                        <th style="width: 20%;">Test Type</th>
                                        <th class="text-center" style="width: 10%;">Status</th>
                                        <th class="text-center" style="width: 15%;">Requested Date</th>
                                        <th class="text-center" style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($requests as $request): ?>
                                        <tr>
                                            <td class="text-center font-weight-bold"><?= $request['id'] ?></td>
                                            <td>
                                                <i class="fas fa-user text-muted"></i> 
                                                <?= htmlspecialchars($request['patient'] ?? 'Unknown Patient') ?>
                                            </td>
                                            <td>
                                                <i class="fas fa-flask text-muted"></i> 
                                                <?= htmlspecialchars($request['test'] ?? 'Unknown Test') ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                $statusClass = 'secondary';
                                                $statusIcon = 'circle';
                                                $statusText = $request['status'] ?? 'Unknown';
                                                
                                                if (stripos($statusText, 'pending') !== false) {
                                                    $statusClass = 'warning';
                                                    $statusIcon = 'clock';
                                                    $statusText = 'Pending';
                                                } elseif (stripos($statusText, 'progress') !== false || stripos($statusText, 'in_progress') !== false) {
                                                    $statusClass = 'primary';
                                                    $statusIcon = 'spinner';
                                                    $statusText = 'In Progress';
                                                } elseif (stripos($statusText, 'complete') !== false) {
                                                    $statusClass = 'success';
                                                    $statusIcon = 'check-circle';
                                                    $statusText = 'Completed';
                                                }
                                                ?>
                                                <span class="badge badge-<?= $statusClass ?> badge-pill" style="font-size: 0.9rem; padding: 0.4em 0.8em; font-weight: 600;">
                                                    <i class="fas fa-<?= $statusIcon ?>"></i> <?= htmlspecialchars($statusText) ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <i class="fas fa-calendar-alt text-muted"></i>
                                                <small><?= date('M d, Y', strtotime($request['created_at'])) ?></small><br>
                                                <small class="text-muted"><?= date('h:i A', strtotime($request['created_at'])) ?></small>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-info" onclick="viewRequestDetails(<?= $request['id'] ?>)" title="View Details">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Request Details Modal -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel">Test Request Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="requestDetails">
                <!-- Details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Result Details Modal -->
<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultModalLabel">Test Result Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="resultDetails">
                <!-- Details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function viewRequestDetails(requestId) {
    // This would typically make an AJAX call to get request details
    // For now, we'll show a placeholder
    $('#requestDetails').html('<p>Loading request details...</p>');
    $('#requestModal').modal('show');
}

function viewResultDetails(resultId) {
    // This would typically make an AJAX call to get result details
    // For now, we'll show a placeholder
    $('#resultDetails').html('<p>Loading result details...</p>');
    $('#resultModal').modal('show');
}
</script>
<?= $this->endSection() ?>
