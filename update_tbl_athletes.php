<?php
require_once 'global-library/database.php';

try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if columns exist first to avoid errors
    $stmt = $conn->query("DESCRIBE tbl_athletes");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (!in_array('firstname', $columns)) {
        $sql = "ALTER TABLE tbl_athletes 
                ADD COLUMN firstname VARCHAR(50) NOT NULL AFTER cid,
                ADD COLUMN lastname VARCHAR(50) NOT NULL AFTER firstname";
        $conn->exec($sql);
        echo "Added firstname and lastname to tbl_athletes.\n";
    } else {
        echo "firstname and lastname already exist.\n";
    }

    if (in_array('fullname', $columns)) {
        // Optional: Drop fullname if we are sure, but maybe keep it for safety or migration?
        // decided to drop it to avoid confusion as we are switching to first/last
        $sql = "ALTER TABLE tbl_athletes DROP COLUMN fullname";
        $conn->exec($sql);
        echo "Dropped fullname column.\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>