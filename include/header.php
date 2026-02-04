<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo WEB_ROOT; ?>"><i class="bi bi-clipboard-check-fill"></i> Attendance </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= WEB_ROOT; ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= WEB_ROOT; ?>scan/">
                        <i class="bi bi-qr-code-scan"></i> Scan Attendance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= WEB_ROOT; ?>coaches/">
                        <i class="bi bi-person-badge"></i> Register Coach
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= WEB_ROOT; ?>athletes/" onclick="showSection('register-athlete')">
                        <i class="bi bi-person-plus"></i> Register Athletes
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>