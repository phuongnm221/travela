<?php
// Check admin user role in database
$conn = new mysqli('localhost', 'root', '', 'travela');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

echo "=== Checking Admin User Data ===\n\n";

$result = $conn->query("SELECT adminId, fullName, username, email, role FROM tbl_admin");

if ($result->num_rows > 0) {
    echo "Found " . $result->num_rows . " admin record(s):\n\n";
    while ($row = $result->fetch_assoc()) {
        echo "ID: {$row['adminId']}\n";
        echo "Name: {$row['fullName']}\n";
        echo "Username: {$row['username']}\n";
        echo "Email: {$row['email']}\n";
        echo "Role: {$row['role']}\n";
        echo "Role is NULL? " . ($row['role'] === null ? 'YES' : 'NO') . "\n";
        echo "Role is empty? " . (empty($row['role']) ? 'YES' : 'NO') . "\n";
        echo "---\n";
    }
} else {
    echo "No admin records found!\n";
}

$conn->close();
?>
