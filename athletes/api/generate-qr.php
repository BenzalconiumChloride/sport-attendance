<?php

require_once '../../global-library/database.php';
require_once '../../phpqrcode/lib/qrlib.php';

// OR

// require_once '../phpqrcode/phpqrcode.php'; // If you have phpqrcode.php

header('Content-Type: application/json');

try {

    // ============================
    // INPUT VALIDATION
    // ============================
    $coachId = isset($_POST['coach_id']) ? (int)$_POST['coach_id'] : 0;

    if ($coachId <= 0) {
        throw new Exception("Invalid coach ID");
    }

    // ============================
    // FETCH COACH DATA
    // ============================
    $stmt = $conn->prepare("
        SELECT cid, c_fullname, c_empid, c_event, contact_number
        FROM tbl_coaches 
        WHERE cid = ? AND is_deleted = 0
    ");
    
    $stmt->execute([$coachId]);
    $coach = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$coach) {
        throw new Exception("Coach not found");
    }

    // ============================
    // GENERATE QR CODE
    // ============================
    $qrData = $coach['c_empid']; // QR Code contains employee ID
    
    // Start output buffering to capture QR code image
    ob_start();
    QRcode::png($qrData, null, QR_ECLEVEL_L, 10, 2);
    $qrCodeImage = ob_get_contents();
    ob_end_clean();
    
    // Convert to base64
    $qrCodeBase64 = base64_encode($qrCodeImage);

    // ============================
    // RESPONSE
    // ============================
    echo json_encode([
        "success" => true,
        "message" => "QR Code generated successfully",
        "data" => [
            "coach_id" => $coach['cid'],
            "fullname" => $coach['c_fullname'],
            "empid" => $coach['c_empid'],
            "event" => $coach['c_event'],
            "qr_code_base64" => $qrCodeBase64,
            "qr_data_url" => "data:image/png;base64," . $qrCodeBase64
        ]
    ]);

} catch (Exception $e) {

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>