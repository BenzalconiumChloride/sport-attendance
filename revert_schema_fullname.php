<?php
require_once 'global-library/database.php';

try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("DESCRIBE tbl_athletes");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Add fullname if not exists
    if (!in_array('fullname', $columns)) {
        $sql = "ALTER TABLE tbl_athletes ADD COLUMN fullname VARCHAR(100) NOT NULL AFTER cid";
        $conn->exec($sql);
        echo "Added fullname to tbl_athletes.\n";
    }

    // Drop firstname if exists
    if (in_array('firstname', $columns)) {
        $sql = "ALTER TABLE tbl_athletes DROP COLUMN firstname";
        $conn->exec($sql);
        echo "Dropped firstname column.\n";
    }

    // Drop lastname if exists
    if (in_array('lastname', $columns)) {
        $sql = "ALTER TABLE tbl_athletes DROP COLUMN lastname";
        $conn->exec($sql);
        echo "Dropped lastname column.\n";
    }

    echo "Schema update complete.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>