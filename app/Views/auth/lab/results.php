<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laboratory Test Results</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Patient</th>
                                    <th>Test Name</th>
                                    <th>Result</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $result): ?>
                                <tr>
                                    <td><?= $result['id'] ?></td>
                                    <td><?= esc($result['patient']) ?></td>
                                    <td><?= esc($result['test']) ?></td>
                                    <td>
                                        <span class="font-weight-bold">
                                            <?= esc($result['result']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('Y-m-d H:i', strtotime($result['created_at'])) ?></td>
                                    <td>
                                        <button class="btn btn-info btn-sm" onclick="viewResultDetails(<?= $result['id'] ?>)">
                                            <i class="bi bi-eye"></i> View Details
                                        </button>
                                        <button class="btn btn-primary btn-sm" onclick="printResult(<?= $result['id'] ?>)">
                                            <i class="bi bi-printer"></i> Print
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printResultModal()">Print Result</button>
            </div>
        </div>
    </div>
</div>

<script>
function viewResultDetails(resultId) {
    // Fetch result details from server
    $.ajax({
        url: `/lab/results/view/${resultId}`,
        type: 'GET',
        success: function(data) {
            var details = `
                <div class="row">
                    <div class="col-md-6">
                        <h6>Patient:</h6>
                        <p>${data.patient}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Test:</h6>
                        <p>${data.test}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Result:</h6>
                        <p class="font-weight-bold">${data.result}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Created Date:</h6>
                        <p>${new Date(data.created_at).toLocaleString()}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Result ID:</h6>
                        <p>${data.id}</p>
                    </div>
                </div>
            `;

            $('#resultDetails').html(details);
            $('#resultModal').modal('show');
        },
        error: function(xhr, status, error) {
            alert('Error loading result details: ' + error);
        }
    });
}

function printResult(resultId) {
    // This would typically open a print dialog or generate a PDF
    window.print();
}

function printResultModal() {
    // Print the modal content
    var printContent = document.getElementById('resultDetails').innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
}
</script>
<?= $this->endSection() ?>
