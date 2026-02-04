<?php

require_once '../../global-library/database.php';

header('Content-Type: application/json');

try {

    // ============================
    // INPUT VALIDATION
    // ============================
    $c_fullname = trim($_POST['c_fullname'] ?? '');
    $c_empid = trim($_POST['c_empid'] ?? '');
    $c_event = trim($_POST['c_event'] ?? '');
    $contact_number = trim($_POST['contact_number'] ?? '');

    if (empty($c_fullname)) {
        throw new Exception("Full name is required");
    }

    if (empty($c_empid)) {
        throw new Exception("Employee ID is required");
    }

    if (empty($c_event)) {
        throw new Exception("Event is required");
    }

    if (empty($contact_number)) {
        throw new Exception("Phone number is required");
    }

    if (!preg_match('/^[0-9+\-\s()]+$/', $contact_number)) {
        throw new Exception("Invalid contact number format");
    }

    // ============================
    // DATABASE INSERTION
    // ============================
    $dateAdded = date('Y-m-d H:i:s');

    $conn->beginTransaction();

    // Insert coach
    $stmtCoach = $conn->prepare("
        INSERT INTO tbl_coaches 
        (c_fullname, c_empid, c_event, contact_number, date_added, is_deleted)
        VALUES (?, ?, ?, ?, ?, 0)
    ");
    $stmtCoach->execute([
        $c_fullname,
        $c_empid,
        $c_event,
        $contact_number,
        $dateAdded
    ]);

    $coachId = $conn->lastInsertId();

    $conn->commit();

    // ============================
    // RESPONSE
    // ============================
    echo json_encode([
        "success" => true,
        "message" => "Coach registered successfully",
        "data" => [
            "coach_id" => $coachId,
            "fullname" => $c_fullname,
            "event" => $c_event
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