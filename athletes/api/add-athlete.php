<?php

require_once '../../global-library/database.php';

header('Content-Type: application/json');

try {

    // ============================
    // INPUT VALIDATION
    // ============================
    $fullname = trim($_POST['fullname'] ?? '');
    $a_lrn = trim($_POST['a_lrn'] ?? '');
    $a_event = trim($_POST['a_event'] ?? '');
    $cid = trim($_POST['cid'] ?? 0); // Coach ID

    if (empty($fullname)) {
        throw new Exception("Full name is required");
    }

    if (empty($a_lrn)) {
        throw new Exception("LRN is required");
    }

    if (empty($a_event)) {
        throw new Exception("Event is required");
    }

    // ============================
    // DATABASE INSERTION
    // ============================
    $dateAdded = date('Y-m-d H:i:s');

    $conn->beginTransaction();

    // Insert athlete
    $stmtAthlete = $conn->prepare("
        INSERT INTO tbl_athletes 
        (cid, fullname, a_lrn, a_event, date_added, is_deleted, deleted_by)
        VALUES (?, ?, ?, ?, ?, 0, 0)
    ");
    $stmtAthlete->execute([
        $cid,
        $fullname,
        $a_lrn,
        $a_event,
        $dateAdded
    ]);

    $athleteId = $conn->lastInsertId();

    $conn->commit();

    // ============================
    // RESPONSE
    // ============================
    echo json_encode([
        "success" => true,
        "message" => "Athlete registered successfully",
        "data" => [
            "aid" => $athleteId,
            "fullname" => $fullname,
            "lrn" => $a_lrn
        ]
    ]);

} catch (Exception $e) {

    if ($conn->inTransaction()) {
        $conn->rollBack();
    }

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>