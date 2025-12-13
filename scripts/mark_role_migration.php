<?php
$conn = new mysqli('localhost', 'root', '', 'travela');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Mark migration as completed
$sql = "INSERT INTO migrations (migration, batch) VALUES ('2025_12_13_214845_add_role_to_tbl_admin', 12)";

if ($conn->query($sql)) {
    echo "Migration marked as completed\n";
} else {
    if (strpos($conn->error, 'Duplicate') !== false) {
        echo "Migration already marked as completed\n";
    } else {
        echo "Error: " . $conn->error . "\n";
    }
}

$conn->close();
?>
