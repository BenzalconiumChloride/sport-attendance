<?php

require_once '../../global-library/database.php';

header('Content-Type: application/json');

try {

    // ============================
    // FETCH COACHES DATA
    // ============================
    $stmt = $conn->prepare("
        SELECT 
            cid,
            c_fullname,
            c_empid,
            c_event,
            contact_number,
            date_added
        FROM tbl_coaches 
        WHERE is_deleted = 0
        ORDER BY date_added DESC
    ");

    $stmt->execute();
    $coaches = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ============================
    // RESPONSE
    // ============================
    echo json_encode([
        "success" => true,
        "message" => "Coaches retrieved successfully",
        "data" => $coaches,
        "count" => count($coaches)
    ]);

} catch (Exception $e) {

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>