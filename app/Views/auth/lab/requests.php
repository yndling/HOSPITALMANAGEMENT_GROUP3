<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-flask"></i> Laboratory Test Requests
                    </h3>
                </div>
                <div class="card-body">
                    <?php if (empty($requests)): ?>
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle"></i> No lab test requests found.
                    </div>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" style="width: 5%;">ID</th>
                                    <th style="width: 20%;">Patient Name</th>
                                    <th style="width: 20%;">Test Type</th>
                                    <th class="text-center" style="width: 10%;">Status</th>
                                    <th class="text-center" style="width: 15%;">Requested Date</th>
                                    <th class="text-center" style="width: 20%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($requests as $request): ?>
                                <tr>
                                    <td class="text-center font-weight-bold"><?= $request['id'] ?></td>
                                    <td>
                                        <i class="bi bi-person text-muted"></i> 
                                        <?= htmlspecialchars($request['patient'] ?? 'Unknown Patient') ?>
                                    </td>
                                    <td>
                                        <i class="bi bi-flask text-muted"></i> 
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
                                            $statusIcon = 'arrow-repeat';
                                            $statusText = 'In Progress';
                                        } elseif (stripos($statusText, 'complete') !== false) {
                                            $statusClass = 'success';
                                            $statusIcon = 'check-circle';
                                            $statusText = 'Completed';
                                        }
                                        ?>
                                        <span class="badge bg-<?= $statusClass ?> rounded-pill" style="font-size: 0.9rem; padding: 0.4em 0.8em; font-weight: 600;">
                                            <i class="bi bi-<?= $statusIcon ?>"></i> <?= htmlspecialchars($statusText) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <i class="bi bi-calendar text-muted"></i>
                                        <small><?= date('M d, Y', strtotime($request['created_at'])) ?></small><br>
                                        <small class="text-muted"><?= date('h:i A', strtotime($request['created_at'])) ?></small>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $statusText = $request['status'] ?? '';
                                        $isPending = (stripos($statusText, 'pending') !== false);
                                        $isInProgress = (stripos($statusText, 'progress') !== false || stripos($statusText, 'in_progress') !== false);
                                        ?>
                                        
                                        <div class="d-flex justify-content-center" style="gap: 8px;">
                                            <?php if ($isPending): ?>
                                            <form method="post" action="/lab/requests/status/<?= $request['id'] ?>" style="display: inline-block;">
                                                <input type="hidden" name="status" value="In Progress">
                                                <button type="submit" class="btn btn-sm btn-primary" title="Start Processing">
                                                    <i class="bi bi-play"></i> Start
                                                </button>
                                            </form>
                                            <?php elseif ($isInProgress): ?>
                                            <a href="/lab/results/add/<?= $request['id'] ?>" class="btn btn-sm btn-success" title="Add Test Result">
                                                <i class="bi bi-plus"></i> Add Result
                                            </a>
                                            <?php endif; ?>
                                            <a href="<?= base_url('lab/requests/view/' . $request['id']) ?>" class="btn btn-sm btn-info" title="View Details">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
