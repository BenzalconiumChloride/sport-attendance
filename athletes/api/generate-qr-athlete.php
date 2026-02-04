<?php

require_once '../../global-library/database.php';
require_once '../../phpqrcode/lib/qrlib.php';

header('Content-Type: application/json');

try {

    // ============================
    // INPUT VALIDATION
    // ============================
    $athleteId = isset($_POST['athlete_id']) ? (int) $_POST['athlete_id'] : 0;

    if ($athleteId <= 0) {
        throw new Exception("Invalid athlete ID");
    }

    // ============================
    // FETCH ATHLETE DATA
    // ============================
    $stmt = $conn->prepare("
        SELECT aid, fullname, a_lrn, a_event
        FROM tbl_athletes 
        WHERE aid = ? AND is_deleted = 0
    ");

    $stmt->execute([$athleteId]);
    $athlete = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$athlete) {
        throw new Exception("Athlete not found");
    }

    // ============================
    // GENERATE QR CODE
    // ============================
    // Use LRN as the unique identifier for attendance
    $qrData = $athlete['a_lrn'];

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
            "aid" => $athlete['aid'],
            "fullname" => $athlete['fullname'],
            "lrn" => $athlete['a_lrn'],
            "event" => $athlete['a_event'],
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