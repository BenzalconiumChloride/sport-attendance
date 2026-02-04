<div>
        <div class="d-flex justify-content-end align-items-end mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#coachModal">
                Register A Coach
            </button>
        </div>
        <h2 class="mb-4 text-center"><i class="bi bi-person-badge"></i> List of Coaches</h2>

        <!-- Coach Registration Modal -->
        <div class="modal fade" id="coachModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="coachModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="coachModalLabel">Coach Registration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="coachForm">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" name="c_fullname" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Employee ID *</label>
                                    <input type="text" class="form-control" name="c_empid" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Event *</label>
                                    <input type="text" class="form-control" name="c_event" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control" name="contact_number" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('coachForm').reset()">
                                <i class="bi bi-x-circle"></i> Clear
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Register Coach
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- QR Code Modal -->
        <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrModalLabel">Coach QR Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div id="qrCodeContainer">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Generating...</span>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 fw-bold" id="qrCoachName"></p>
                        <small class="text-muted" id="qrEmpId"></small>
                        <p class="text-muted mb-0" id="qrEvent"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="downloadQrBtn">
                            <i class="bi bi-download"></i> Download
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coaches Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Event</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">QR Code</th>
                    </tr>
                </thead>
                <tbody id="coachesTableBody">
                    <tr>
                        <td colspan="6" class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Load coaches function
    async function loadCoaches() {
        const tableBody = document.getElementById('coachesTableBody');
        
        try {
            const response = await fetch('api/fetch-coaches.php');
            const result = await response.json();
            
            if (result.success) {
                if (result.data.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center">No coaches found</td>
                        </tr>
                    `;
                    return;
                }
                
                let html = '';
                result.data.forEach((coach, index) => {
                    html += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${coach.c_fullname}</td>
                            <td>${coach.c_empid}</td>
                            <td>${coach.c_event}</td>
                            <td>${coach.contact_number}</td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="generateQR(${coach.cid}, '${coach.c_fullname}', '${coach.c_empid}', '${coach.c_event}')">
                                    <i class="bi bi-qr-code"></i> Generate
                                </button>
                            </td>
                        </tr>
                    `;
                });
                
                tableBody.innerHTML = html;
            } else {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center text-danger">Error: ${result.message}</td>
                    </tr>
                `;
            }
            
        } catch (error) {
            console.error('Error:', error);
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-danger">Failed to load coaches</td>
                </tr>
            `;
        }
    }

    // Generate QR Code function
    async function generateQR(coachId, coachName, empId, event) {
        const qrModal = new bootstrap.Modal(document.getElementById('qrModal'));
        const qrContainer = document.getElementById('qrCodeContainer');
        const qrCoachNameEl = document.getElementById('qrCoachName');
        const qrEmpIdEl = document.getElementById('qrEmpId');
        const qrEventEl = document.getElementById('qrEvent');
        const downloadBtn = document.getElementById('downloadQrBtn');
        
        // Show modal with loading state
        qrModal.show();
        qrContainer.innerHTML = `
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Generating...</span>
            </div>
        `;
        qrCoachNameEl.textContent = '';
        qrEmpIdEl.textContent = '';
        qrEventEl.textContent = '';
        
        try {
            const formData = new FormData();
            formData.append('coach_id', coachId);
            
            const response = await fetch('api/generate-qr.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                // Display QR code
                qrContainer.innerHTML = `
                    <img src="${result.data.qr_data_url}" alt="QR Code" class="img-fluid" style="max-width: 300px;">
                `;
                qrCoachNameEl.textContent = result.data.fullname;
                qrEmpIdEl.textContent = `Employee ID: ${result.data.empid}`;
                qrEventEl.textContent = `Event: ${result.data.event}`;
                
                // Setup download button
                downloadBtn.onclick = function() {
                    const link = document.createElement('a');
                    link.href = result.data.qr_data_url;
                    link.download = `QR_${result.data.empid}_${result.data.fullname.replace(/\s+/g, '_')}.png`;
                    link.click();
                };
            } else {
                qrContainer.innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle"></i> ${result.message}
                    </div>
                `;
            }
            
        } catch (error) {
            console.error('Error:', error);
            qrContainer.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> Failed to generate QR code
                </div>
            `;
        }
    }

    // Load coaches on page load
    document.addEventListener('DOMContentLoaded', loadCoaches);

    // Form submission
    document.getElementById('coachForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Registering...';
        
        try {
            const response = await fetch('api/add-coach.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Coach registered successfully!');
                this.reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById('coachModal'));
                modal.hide();
                loadCoaches();
            } else {
                alert('Error: ' + result.message);
            }
            
        } catch (error) {
            console.error('Error:', error);
            alert('Failed to register coach. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-save"></i> Register Coach';
        }
    });
</script>