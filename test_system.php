<?php
$conn = new mysqli('localhost', 'root', '', 'travela');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Test 1: Check role column
echo "=== TEST 1: Check role column ===\n";
$result = $conn->query("SHOW COLUMNS FROM tbl_admin WHERE Field = 'role'");
if ($result->num_rows > 0) {
    $col = $result->fetch_assoc();
    echo "✓ Role column exists: {$col['Type']}\n";
} else {
    echo "✗ Role column not found\n";
}

// Test 2: Check all admin users
echo "\n=== TEST 2: All admin users ===\n";
$result = $conn->query("SELECT adminId, fullName, username, role FROM tbl_admin");
echo "Total records: " . $result->num_rows . "\n";
while ($row = $result->fetch_assoc()) {
    echo "  - ID: {$row['adminId']}, Name: {$row['fullName']}, Role: {$row['role']}\n";
}

// Test 3: Try test staff credentials
echo "\n=== TEST 3: Test staff login ===\n";
$username = 'nguyenvana';
$password = md5('123456');
$result = $conn->query("SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'");
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "✓ Found user: {$user['fullName']} (Role: {$user['role']})\n";
} else {
    echo "✗ User not found or password incorrect\n";
}

// Test 4: Test controller can be loaded
echo "\n=== TEST 4: Controller files ===\n";
$files = [
    'app/Http/Controllers/admin/StaffManagementController.php',
    'app/Http/Middleware/StaffAccessRestriction.php',
];
foreach ($files as $file) {
    $path = __DIR__ . '/' . $file;
    if (file_exists($path)) {
        echo "✓ $file exists\n";
        // Try to include
        $content = file_get_contents($path);
        if (strpos($content, 'class') !== false) {
            echo "  → Class definition found\n";
        }
    } else {
        echo "✗ $file not found\n";
    }
}

$conn->close();
echo "\n=== TESTS COMPLETE ===\n";
?>
