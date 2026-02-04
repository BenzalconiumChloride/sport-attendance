<div>
    <h2 class="mb-4"><i class="bi bi-qr-code-scan"></i> Scan Attendance</h2>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <!-- Camera Scanner -->
                    <div id="scannerContainer" style="display: none;">
                        <div id="reader" style="width: 100%; border-radius: 8px; overflow: hidden;"></div>
                        <button class="btn btn-danger mt-3 w-100" id="stopScanBtn">
                            <i class="bi bi-x-circle"></i> Stop Scanner
                        </button>
                    </div>

                    <!-- Scan Area (Click to Start) -->
                    <div class="scan-area" id="scanArea">
                        <i class="bi bi-qr-code scan-icon"></i>
                        <h4 class="mt-3">Click to Start QR Scanner</h4>
                        <p class="text-muted">Use your device camera to scan QR codes</p>
                    </div>

                    <div class="mt-4">
                        <h5>Manual Entry</h5>
                        <div class="input-group">
                            <input type="text" class="form-control" id="manualId" placeholder="Enter Employee ID">
                            <button class="btn btn-primary" id="manualCheckInBtn">
                                <i class="bi bi-check-circle"></i> Check In
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-list-check"></i> Scan History (Today)</h5>
                </div>
                <div class="card-body">
                    <div id="scanHistory" style="max-height: 400px; overflow-y: auto;">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Loading scan history...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" id="successModalHeader">
                <h5 class="modal-title" id="successModalLabel">
                    <i class="bi bi-check-circle-fill"></i> <span id="successModalTitle">Success</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="successContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Include html5-qrcode library -->
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
    let html5QrcodeScanner = null;

    // Load scan history on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadScanHistory();
    });

    // Start QR Scanner
    document.getElementById('scanArea').addEventListener('click', function() {
        startScanner();
    });

    // Stop Scanner
    document.getElementById('stopScanBtn').addEventListener('click', function() {
        stopScanner();
    });

    // Manual Check-In
    document.getElementById('manualCheckInBtn').addEventListener('click', function() {
        const empId = document.getElementById('manualId').value.trim();
        if (empId) {
            processAttendance(empId);
        } else {
            alert('Please enter an Employee ID');
        }
    });

    // Start Scanner Function
    function startScanner() {
        document.getElementById('scanArea').style.display = 'none';
        document.getElementById('scannerContainer').style.display = 'block';

        html5QrcodeScanner = new Html5Qrcode("reader");
        
        const config = { 
            fps: 10,
            qrbox: { width: 500, height: 500 },
            aspectRatio: 1.0
        };

        html5QrcodeScanner.start(
            { facingMode: "environment" }, // Use back camera
            config,
            onScanSuccess,
            onScanFailure
        ).catch(err => {
            console.error('Error starting scanner:', err);
            alert('Unable to start camera. Please check camera permissions.');
            stopScanner();
        });
    }

    // Stop Scanner Function
    function stopScanner() {
        if (html5QrcodeScanner) {
            html5QrcodeScanner.stop().then(() => {
                html5QrcodeScanner.clear();
                document.getElementById('scannerContainer').style.display = 'none';
                document.getElementById('scanArea').style.display = 'block';
            }).catch(err => {
                console.error('Error stopping scanner:', err);
            });
        }
    }

    // On Scan Success
    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Scanned: ${decodedText}`);
        
        // Stop scanner temporarily
        stopScanner();
        
        // Process attendance
        processAttendance(decodedText);
    }

    // On Scan Failure (optional)
    function onScanFailure(error) {
        // Handle scan failure, usually just ignore it
        // console.warn(`Scan error: ${error}`);
    }

    // Process Attendance
    async function processAttendance(empId) {
        try {
            const formData = new FormData();
            formData.append('emp_id', empId);

            const response = await fetch('api/check-in.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                // Show success modal
                showSuccessModal(result.data);
                
                // Clear manual input
                document.getElementById('manualId').value = '';
                
                // Reload scan history
                loadScanHistory();
                
                // Play success sound (optional)
                playSuccessSound();
            } else {
                alert('Error: ' + result.message);
            }

        } catch (error) {
            console.error('Error:', error);
            alert('Failed to process attendance. Please try again.');
        }
    }

  // Show Success Modal (Updated)
function showSuccessModal(data) {
    const isOut = (data.logged_as === 'out');
    const statusColor = isOut ? 'warning' : 'success';
    const statusIcon = isOut ? 'box-arrow-right' : 'box-arrow-in-right';
    const statusText = data.action;
    
    // Update modal header
    const modalHeader = document.getElementById('successModalHeader');
    modalHeader.className = `modal-header bg-${statusColor} text-white`;
    document.getElementById('successModalTitle').textContent = `Logged ${statusText}`;
    
    const content = `
        <div class="mb-3">
            <i class="bi bi-${statusIcon}" style="font-size: 4rem; color: ${isOut ? '#ffc107' : '#198754'};"></i>
        </div>
        <h4>${data.fullname}</h4>
        <p class="mb-1"><strong>Employee ID:</strong> ${data.empid}</p>
        <p class="mb-1"><strong>Event:</strong> ${data.event}</p>
        <p class="mb-1"><strong>Time:</strong> ${data.timestamp}</p>
        <div class="alert alert-${statusColor} mt-3">
            <i class="bi bi-check-circle"></i> Logged as <strong>${statusText}</strong> successfully!
        </div>
        <small class="text-muted">Status updated: ${data.previous_status === 0 ? 'OUT (0)' : 'IN (1)'} → ${data.new_status === 1 ? 'IN (1)' : 'OUT (0)'}</small>
    `;
    
    document.getElementById('successContent').innerHTML = content;
    const modal = new bootstrap.Modal(document.getElementById('successModal'));
    modal.show();
}

// Load Scan History (Updated)
async function loadScanHistory() {
    const historyDiv = document.getElementById('scanHistory');
    
    try {
        const response = await fetch('api/get-attendance-history.php');
        const result = await response.json();

        if (result.success) {
            if (result.data.length === 0) {
                historyDiv.innerHTML = `
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> No attendance records today.
                    </div>
                `;
                return;
            }

            let html = '<div class="list-group">';
            result.data.forEach(record => {
                const badgeClass = record.status_color === 'success' ? 'bg-success' : 'bg-warning';
                const icon = record.at_status === 'in' ? 'box-arrow-in-right' : 'box-arrow-right';
                
                html += `
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <h6 class="mb-1">${record.at_fullname}</h6>
                            <div>
                                <span class="badge ${badgeClass} me-2">
                                    <i class="bi bi-${icon}"></i> ${record.status_text}
                                </span>
                                <small class="text-muted">${record.formatted_time}</small>
                            </div>
                        </div>
                        <p class="mb-1">
                            <small><strong>Event:</strong> ${record.at_event}</small>
                        </p>
                    </div>
                `;
            });
            html += '</div>';

            historyDiv.innerHTML = html;
        } else {
            historyDiv.innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle"></i> ${result.message}
                </div>
            `;
        }

    } catch (error) {
        console.error('Error:', error);
        historyDiv.innerHTML = `
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i> Failed to load history
            </div>
        `;
    }
}
    // Play Success Sound (optional)
    function playSuccessSound() {
        // You can use the Web Audio API or an audio element
        const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSuBzvLZiTYIGGS57OihUBELTKXh8LdjGgU2jdXx0H8pBSt+zPDhkj4KFFux6OyrWBUIQ5zd8sFuIwU=');
        audio.play().catch(e => console.log('Audio play failed:', e));
    }
</script>

<style>
    .scan-area {
        border: 3px dashed #007bff;
        border-radius: 10px;
        /* padding: 20px 20px; */
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background-color: #f8f9fa;
    }

    .scan-area:hover {
        background-color: #e9ecef;
        border-color: #0056b3;
    }

    .scan-icon {
        font-size: 4rem;
        color: #007bff;
    }

    #reader {
        border: 2px solid #007bff;
    }

    .list-group-item {
        border-left: 4px solid #28a745;
    }
</style>