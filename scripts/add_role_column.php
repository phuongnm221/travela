<?php
// Add role column to tbl_admin table if it doesn't exist

$conn = new mysqli('localhost', 'root', '', 'travela');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if column exists
$checkColumn = $conn->query("SHOW COLUMNS FROM tbl_admin WHERE Field = 'role'");

if ($checkColumn->num_rows > 0) {
    echo "Role column already exists\n";
} else {
    $sql = "ALTER TABLE tbl_admin ADD COLUMN role ENUM('admin','staff') DEFAULT 'admin' AFTER password";
    
    if ($conn->query($sql)) {
        echo "Role column added successfully\n";
    } else {
        echo "Error adding column: " . $conn->error . "\n";
    }
}

$conn->close();
?>
