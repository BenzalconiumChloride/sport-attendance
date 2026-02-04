<div id="dashboard" class="content-section active">
        <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Overview</h2>
        
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stat-card primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Athletes</h6>
                                <h2 class="mb-0">156</h2>
                            </div>
                            <div class="text-primary">
                                <i class="bi bi-people-fill" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="card stat-card success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Present Today</h6>
                                <h2 class="mb-0">142</h2>
                            </div>
                            <div class="text-success">
                                <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="card stat-card warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Absent Today</h6>
                                <h2 class="mb-0">14</h2>
                            </div>
                            <div class="text-warning">
                                <i class="bi bi-exclamation-triangle-fill" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="card stat-card danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Total Coaches</h6>
                                <h2 class="mb-0">12</h2>
                            </div>
                            <div class="text-danger">
                                <i class="bi bi-person-badge-fill" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Attendance -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-clock-history"></i> Recent Attendance</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="recentAttendanceTable">
                                    <tr>
                                        <td>ATH001</td>
                                        <td>John Smith</td>
                                        <td><span class="badge bg-info">Athlete</span></td>
                                        <td>08:45 AM</td>
                                        <td><span class="badge bg-success">Present</span></td>
                                    </tr>
                                    <tr>
                                        <td>ATH002</td>
                                        <td>Sarah Johnson</td>
                                        <td><span class="badge bg-info">Athlete</span></td>
                                        <td>08:50 AM</td>
                                        <td><span class="badge bg-success">Present</span></td>
                                    </tr>
                                    <tr>
                                        <td>COA001</td>
                                        <td>Mike Williams</td>
                                        <td><span class="badge bg-primary">Coach</span></td>
                                        <td>08:30 AM</td>
                                        <td><span class="badge bg-success">Present</span></td>
                                    </tr>
                                    <tr>
                                        <td>ATH003</td>
                                        <td>Emily Davis</td>
                                        <td><span class="badge bg-info">Athlete</span></td>
                                        <td>09:00 AM</td>
                                        <td><span class="badge bg-success">Present</span></td>
                                    </tr>
                                    <tr>
                                        <td>ATH004</td>
                                        <td>James Brown</td>
                                        <td><span class="badge bg-info">Athlete</span></td>
                                        <td>09:15 AM</td>
                                        <td><span class="badge bg-success">Present</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats & Activity -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-graph-up"></i> Quick Stats</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Attendance Rate</span>
                                <strong>91%</strong>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: 91%"></div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>On Time Rate</span>
                                <strong>85%</strong>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" style="width: 85%"></div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h6 class="mb-3">Today's Activity</h6>
                        <div class="recent-activity">
                            <div class="activity-item present">
                                <small class="text-muted">2 minutes ago</small>
                                <p class="mb-0"><strong>John Smith</strong> checked in</p>
                            </div>
                            <div class="activity-item present">
                                <small class="text-muted">5 minutes ago</small>
                                <p class="mb-0"><strong>Sarah Johnson</strong> checked in</p>
                            </div>
                            <div class="activity-item present">
                                <small class="text-muted">12 minutes ago</small>
                                <p class="mb-0"><strong>Mike Williams</strong> checked in</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scan Attendance Section -->
    <div id="scan" class="content-section">
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

    <!-- Register Coach Section -->
    <div id="register-coach" class="content-section">
        <h2 class="mb-4"><i class="bi bi-person-badge"></i> Register Coach</h2>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="form-section">
                    <form id="coachForm" onsubmit="registerCoach(event)">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name *</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name *</label>
                                <input type="text" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Specialization *</label>
                                <select class="form-select" required>
                                    <option value="">Select Specialization</option>
                                    <option>Basketball</option>
                                    <option>Football</option>
                                    <option>Swimming</option>
                                    <option>Track & Field</option>
                                    <option>Gymnastics</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Experience (Years) *</label>
                                <input type="number" class="form-control" min="0" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" rows="2"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Certifications</label>
                            <input type="text" class="form-control" placeholder="e.g., Level 2 Coaching Certificate">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" class="form-control" accept="image/*">
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
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
    </div>

    <!-- Register Athletes Section -->
    <div id="register-athlete" class="content-section">
        <h2 class="mb-4"><i class="bi bi-person-plus"></i> Register Athletes</h2>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="form-section">
                    <form id="athleteForm" onsubmit="registerAthlete(event)">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name *</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name *</label>
                                <input type="text" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date of Birth *</label>
                                <input type="date" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender *</label>
                                <select class="form-select" required>
                                    <option value="">Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sport *</label>
                                <select class="form-select" required>
                                    <option value="">Select Sport</option>
                                    <option>Basketball</option>
                                    <option>Football</option>
                                    <option>Swimming</option>
                                    <option>Track & Field</option>
                                    <option>Gymnastics</option>
                                    <option>Tennis</option>
                                    <option>Volleyball</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Assigned Coach *</label>
                                <select class="form-select" required>
                                    <option value="">Select Coach</option>
                                    <option>Mike Williams</option>
                                    <option>Lisa Anderson</option>
                                    <option>David Martinez</option>
                                    <option>Jennifer Lee</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Emergency Contact Name *</label>
                            <input type="text" class="form-control" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Emergency Contact Phone *</label>
                                <input type="tel" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Relationship *</label>
                                <input type="text" class="form-control" placeholder="e.g., Parent, Guardian" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" rows="2"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Medical Conditions / Notes</label>
                            <textarea class="form-control" rows="2" placeholder="Any allergies, medical conditions, or special notes"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" class="form-control" accept="image/*">
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
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
    </div>
</div>
