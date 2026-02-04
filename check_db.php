<?php
require_once 'global-library/database.php';

try {
    $stmt = $conn->query("DESCRIBE tbl_athletes");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Columns in tbl_athletes: " . implode(", ", $columns);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>