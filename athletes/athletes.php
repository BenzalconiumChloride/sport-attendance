<div>
        <div class="d-flex justify-content-end align-items-end mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#athleteModal">
                Register An Athlete
            </button>
        </div>
        <h2 class="mb-4 text-center"><i class="bi bi-people"></i> List of Athletes</h2>

        <!-- Athlete Registration Modal -->
        <div class="modal fade" id="athleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="athleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="athleteModalLabel">Athlete Registration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="athleteForm">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" name="fullname" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">LRN *</label>
                                    <input type="text" class="form-control" name="a_lrn" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Event *</label>
                                    <input type="text" class="form-control" name="a_event" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Coach *</label>
                                    <select class="form-select" name="cid" id="coachSelect" required>
                                        <option value="" selected disabled>Select a Coach</option>
                                        <!-- Coaches will be populated here -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('athleteForm').reset()">
                                <i class="bi bi-x-circle"></i> Clear
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Register Athlete
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
                        <h5 class="modal-title" id="qrModalLabel">Athlete QR Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div id="qrCodeContainer">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Generating...</span>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 fw-bold" id="qrAthleteName"></p>
                        <small class="text-muted" id="qrLrn"></small>
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

        <!-- Athletes Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">LRN</th>
                        <th scope="col">Event</th>
                        <th scope="col">Coach</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="athletesTableBody">
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
    // Load athletes function
    async function loadAthletes() {
        const tableBody = document.getElementById('athletesTableBody');
        
        try {
            const response = await fetch('api/fetch-athletes.php');
            const result = await response.json();
            
            if (result.success) {
                if (result.data.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center">No athletes found</td>
                        </tr>
                    `;
                    return;
                }
                
                let html = '';
                result.data.forEach((athlete, index) => {
                    const coachName = athlete.coach_name ? athlete.coach_name : '<span class="text-muted">None</span>';
                    html += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${athlete.fullname}</td>
                            <td>${athlete.a_lrn}</td>
                            <td>${athlete.a_event}</td>
                            <td>${coachName}</td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="generateQR(${athlete.aid})">
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
                    <td colspan="6" class="text-center text-danger">Failed to load athletes</td>
                </tr>
            `;
        }
    }

    // Load coaches for dropdown
    async function loadCoachesForDropdown() {
        const coachSelect = document.getElementById('coachSelect');
        
        try {
            const response = await fetch('api/fetch-coaches.php');
            const result = await response.json();
            
            if (result.success) {
                let options = '<option value="" selected disabled>Select a Coach</option>';
                result.data.forEach(coach => {
                    options += `<option value="${coach.cid}">${coach.c_fullname} (${coach.c_event})</option>`;
                });
                coachSelect.innerHTML = options;
            }
            
        } catch (error) {
            console.error('Error loading coaches:', error);
        }
    }

    // Generate QR Code function
    async function generateQR(athleteId) {
        const qrModal = new bootstrap.Modal(document.getElementById('qrModal'));
        const qrContainer = document.getElementById('qrCodeContainer');
        const qrAthleteNameEl = document.getElementById('qrAthleteName');
        const qrLrnEl = document.getElementById('qrLrn');
        const qrEventEl = document.getElementById('qrEvent');
        const downloadBtn = document.getElementById('downloadQrBtn');
        
        // Show modal with loading state
        qrModal.show();
        qrContainer.innerHTML = `
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Generating...</span>
            </div>
        `;
        qrAthleteNameEl.textContent = '';
        qrLrnEl.textContent = '';
        qrEventEl.textContent = '';
        
        try {
            const formData = new FormData();
            formData.append('athlete_id', athleteId);
            
            const response = await fetch('api/generate-qr-athlete.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                // Display QR code
                qrContainer.innerHTML = `
                    <img src="${result.data.qr_data_url}" alt="QR Code" class="img-fluid" style="max-width: 300px;">
                `;
                qrAthleteNameEl.textContent = result.data.fullname;
                qrLrnEl.textContent = `LRN: ${result.data.lrn}`;
                qrEventEl.textContent = `Event: ${result.data.event}`;
                
                // Setup download button
                downloadBtn.onclick = function() {
                    const link = document.createElement('a');
                    link.href = result.data.qr_data_url;
                    link.download = `QR_${result.data.lrn}_${result.data.fullname.replace(/\s+/g, '_')}.png`;
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

    // Load athletes and coaches on page load
    document.addEventListener('DOMContentLoaded', () => {
        loadAthletes();
        loadCoachesForDropdown();
    });

    // Form submission
    document.getElementById('athleteForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Registering...';
        
        try {
            const response = await fetch('api/add-athlete.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Athlete registered successfully!');
                this.reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById('athleteModal'));
                modal.hide();
                loadAthletes();
            } else {
                alert('Error: ' + result.message);
            }
            
        } catch (error) {
            console.error('Error:', error);
            alert('Failed to register athlete. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-save"></i> Register Athlete';
        }
    });
</script>