<?php
require_once 'global-library/database.php';

try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "ALTER TABLE tbl_athlletes 
            ADD COLUMN firstname VARCHAR(50) NOT NULL AFTER cid,
            ADD COLUMN lastname VARCHAR(50) NOT NULL AFTER firstname";

    $conn->exec($sql);
    echo "Table tbl_athlletes updated successfully.";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), "Duplicate column name") !== false) {
        echo "Columns already exist.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
?>