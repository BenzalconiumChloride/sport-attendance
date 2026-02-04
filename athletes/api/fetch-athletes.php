<?php

require_once '../../global-library/database.php';

header('Content-Type: application/json');

try {

    // ============================
    // FETCH ATHLETES DATA
    // ============================
    $stmt = $conn->prepare("
        SELECT 
            a.aid,
            a.fullname,
            a.a_lrn,
            a.a_event,
            a.date_added,
            a.cid,
            c.c_fullname as coach_name
        FROM tbl_athletes a
        LEFT JOIN tbl_coaches c ON a.cid = c.cid
        WHERE a.is_deleted = 0
        ORDER BY a.date_added DESC
    ");

    $stmt->execute();
    $athletes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ============================
    // RESPONSE
    // ============================
    echo json_encode([
        "success" => true,
        "message" => "Athletes retrieved successfully",
        "data" => $athletes,
        "count" => count($athletes)
    ]);

} catch (Exception $e) {

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>