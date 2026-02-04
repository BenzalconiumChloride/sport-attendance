<div>
    <h2 class="mb-4"><i class="bi bi-qr-code-scan"></i> Scan Attendance</h2>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="scan-area" onclick="simulateScan()">
                        <i class="bi bi-qr-code scan-icon"></i>
                        <h4 class="mt-3">Tap to Scan QR Code</h4>
                        <p class="text-muted">Click here to simulate scanning</p>
                    </div> 

                    <div class="mt-4">
                        <h5>Manual Entry</h5>
                        <div class="input-group">
                            <input type="text" class="form-control" id="manualId" placeholder="Enter ID Number">
                            <button class="btn btn-primary" onclick="manualCheckIn()">
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
                    <h5 class="mb-0"><i class="bi bi-list-check"></i> Scan History</h5>
                </div>
                <div class="card-body">
                    <div id="scanHistory" style="max-height: 400px; overflow-y: auto;">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> No scans yet. Start scanning to see history.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>