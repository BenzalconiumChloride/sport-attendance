<?php

require_once '../../global-library/database.php';

header('Content-Type: application/json');

try {

    // ============================
    // GET TODAY'S ATTENDANCE
    // ============================
    $today = date('Y-m-d');
    
    $stmt = $conn->prepare("
        SELECT 
            at_id,
            at_fullname,
            at_timestamp,
            at_status,
            at_event
        FROM tbl_attendance
        WHERE DATE(at_timestamp) = ?
        ORDER BY at_timestamp DESC
    ");
    
    $stmt->execute([$today]);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Format time and data
    foreach ($records as &$record) {
        $record['formatted_time'] = date('h:i A', strtotime($record['at_timestamp']));
        $record['status_text'] = strtoupper($record['at_status']);
        $record['status_color'] = ($record['at_status'] === 'in') ? 'success' : 'warning';
    }

    // ============================
    // RESPONSE
    // ============================
    echo json_encode([
        "success" => true,
        "message" => "Attendance history retrieved successfully",
        "data" => $records,
        "count" => count($records)
    ]);

} catch (Exception $e) {

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>