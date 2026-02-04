<?php

require_once '../../global-library/database.php';

header('Content-Type: application/json');

try {

    // ============================
    // INPUT VALIDATION
    // ============================
    $empId = trim($_POST['emp_id'] ?? '');

    if (empty($empId)) {
        throw new Exception("Employee ID is required");
    }

    // ============================
    // FIND COACH
    // ============================
    $stmt = $conn->prepare("
        SELECT cid, c_fullname, c_empid, c_event, contact_number, status
        FROM tbl_coaches 
        WHERE c_empid = ? AND is_deleted = 0
    ");
    
    $stmt->execute([$empId]);
    $coach = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$coach) {
        throw new Exception("Coach not found with Employee ID: " . $empId);
    }

    // ============================
    // DETERMINE ACTION BASED ON CURRENT STATUS
    // ============================
    $currentStatus = (int)$coach['status']; // 0 = OUT, 1 = IN
    
    // If current status is 0 (OUT), log as OUT and change to 1 (IN)
    // If current status is 1 (IN), log as IN and change to 0 (OUT)
    if ($currentStatus === 0) {
        $logAs = 'out';  // Log as OUT
        $newStatus = 1;   // Change status to IN
        $actionText = 'OUT';
    } else {
        $logAs = 'in';    // Log as IN
        $newStatus = 0;   // Change status to OUT
        $actionText = 'IN';
    }
    
    $timestamp = date('Y-m-d H:i:s');

    $conn->beginTransaction();

    // ============================
    // LOG ATTENDANCE
    // ============================
    $insertStmt = $conn->prepare("
        INSERT INTO tbl_attendance (at_fullname, at_timestamp, at_status, at_event)
        VALUES (?, ?, ?, ?)
    ");
    
    $insertStmt->execute([
        $coach['c_fullname'],
        $timestamp,
        $logAs,
        $coach['c_event']
    ]);

    $attendanceId = $conn->lastInsertId();

    // ============================
    // UPDATE COACH STATUS
    // ============================
    $updateStmt = $conn->prepare("
        UPDATE tbl_coaches 
        SET status = ?
        WHERE cid = ?
    ");
    
    $updateStmt->execute([$newStatus, $coach['cid']]);

    $conn->commit();

    // ============================
    // RESPONSE
    // ============================
    $actionMessage = "Logged as {$actionText} successfully";
    
    echo json_encode([
        "success" => true,
        "message" => $actionMessage,
        "data" => [
            "attendance_id" => $attendanceId,
            "coach_id" => $coach['cid'],
            "fullname" => $coach['c_fullname'],
            "empid" => $coach['c_empid'],
            "event" => $coach['c_event'],
            "logged_as" => $logAs,
            "previous_status" => $currentStatus,
            "new_status" => $newStatus,
            "timestamp" => date('h:i A', strtotime($timestamp)),
            "action" => $actionText
        ]
    ]);

} catch (Exception $e) {

    if ($conn && $conn->inTransaction()) {
        $conn->rollBack();
    }

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>