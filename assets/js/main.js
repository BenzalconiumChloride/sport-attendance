// Navigation function
function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.content-section').forEach(section => {
        section.classList.remove('active');
    });
    
    // Remove active class from all nav links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });
    
    // Show selected section
    document.getElementById(sectionId).classList.add('active');
    
    // Add active class to clicked nav link
    event.target.classList.add('active');
}

// Simulate QR code scan
function simulateScan() {
    const names = ['John Smith', 'Sarah Johnson', 'Mike Williams', 'Emily Davis', 'James Brown', 'Lisa Anderson'];
    const ids = ['ATH001', 'ATH002', 'COA001', 'ATH003', 'ATH004', 'COA002'];
    const types = ['Athlete', 'Athlete', 'Coach', 'Athlete', 'Athlete', 'Coach'];
    
    const randomIndex = Math.floor(Math.random() * names.length);
    const name = names[randomIndex];
    const id = ids[randomIndex];
    const type = types[randomIndex];
    const time = new Date().toLocaleTimeString();
    
    addScanHistory(id, name, type, time);
    
    // Show success message
    const scanArea = document.querySelector('.scan-area');
    const originalContent = scanArea.innerHTML;
    scanArea.innerHTML = `
        <i class="bi bi-check-circle-fill text-success" style="font-size: 80px;"></i>
        <h4 class="mt-3 text-success">Check-in Successful!</h4>
        <p><strong>${name}</strong> (${id})</p>
    `;
    scanArea.style.borderColor = '#198754';
    scanArea.style.backgroundColor = '#d1e7dd';
    
    setTimeout(() => {
        scanArea.innerHTML = originalContent;
        scanArea.style.borderColor = '#dee2e6';
        scanArea.style.backgroundColor = '#fff';
    }, 2000);
}

// Manual check-in
function manualCheckIn() {
    const idInput = document.getElementById('manualId');
    const id = idInput.value.trim();
    
    if (!id) {
        alert('Please enter an ID number');
        return;
    }
    
    const time = new Date().toLocaleTimeString();
    addScanHistory(id, 'Manual Entry', 'Athlete', time);
    
    idInput.value = '';
    alert('Check-in successful!');
}

// Add scan to history
function addScanHistory(id, name, type, time) {
    const scanHistory = document.getElementById('scanHistory');
    
    // Remove "no scans" message if exists
    if (scanHistory.querySelector('.alert-info')) {
        scanHistory.innerHTML = '';
    }
    
    const badge = type === 'Coach' ? 'bg-primary' : 'bg-info';
    
    const historyItem = document.createElement('div');
    historyItem.className = 'border-bottom pb-3 mb-3';
    historyItem.innerHTML = `
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h6 class="mb-1">${name}</h6>
                <small class="text-muted">${id} • <span class="badge ${badge}">${type}</span></small>
            </div>
            <div class="text-end">
                <small class="text-muted">${time}</small><br>
                <span class="badge bg-success">Present</span>
            </div>
        </div>
    `;
    
    scanHistory.insertBefore(historyItem, scanHistory.firstChild);
}

// Register coach form submission
function registerCoach(event) {
    event.preventDefault();
    alert('Coach registered successfully!');
    document.getElementById('coachForm').reset();
}

// Register athlete form submission
function registerAthlete(event) {
    event.preventDefault();
    alert('Athlete registered successfully!');
    document.getElementById('athleteForm').reset();
}