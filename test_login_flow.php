<?php
echo "=== TESTING ADMIN LOGIN FLOW ===\n\n";

// Simulate what LoginAdminController does
$conn = new mysqli('localhost', 'root', '', 'travela');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

echo "[1] Getting admin from database...\n";
$username = 'admin';
$password = md5('123456');  // Default password

$query = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
echo "Query: $query\n\n";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $adminData = $result->fetch_assoc();
    echo "✓ Admin found in database\n";
    echo "  - ID: {$adminData['adminId']}\n";
    echo "  - Name: {$adminData['fullName']}\n";
    echo "  - Role: {$adminData['role']}\n";
    echo "  - Role is NULL? " . ($adminData['role'] === NULL ? 'YES' : 'NO') . "\n";
    echo "  - Role is empty? " . (empty($adminData['role']) ? 'YES' : 'NO') . "\n";
    
    echo "\n[2] Building session data...\n";
    $sessionData = [
        'adminId' => $adminData['adminId'],
        'fullName' => $adminData['fullName'],
        'username' => $adminData['username'],
        'email' => $adminData['email'],
        'role' => $adminData['role'] ?? 'admin',
    ];
    
    echo "Session data would be:\n";
    echo json_encode($sessionData, JSON_PRETTY_PRINT) . "\n";
    
    echo "\n[3] Testing sidebar logic...\n";
    $adminUser = $sessionData;
    
    $isAdmin = false;
    if (is_array($adminUser)) {
        $isAdmin = isset($adminUser['role']) && $adminUser['role'] === 'admin';
        echo "✓ Session is array\n";
        echo "✓ Role exists? " . (isset($adminUser['role']) ? 'YES' : 'NO') . "\n";
        echo "✓ Role value: '{$adminUser['role']}'\n";
        echo "✓ $isAdmin = $isAdmin\n";
    } elseif (is_string($adminUser)) {
        $isAdmin = true;
        echo "⚠ Session is string (fallback to true)\n";
    }
    
    if (!$isAdmin && !empty($adminUser)) {
        $isAdmin = true;
        echo "✓ Emergency fallback applied\n";
    }
    
    echo "\n[4] Final Result:\n";
    echo "Will show 'Quản lý nhân sự' menu? " . ($isAdmin ? 'YES ✅' : 'NO ❌') . "\n";
    
} else {
    echo "✗ Admin NOT found in database\n";
    echo "  Check: admin/123456\n";
}

$conn->close();
?>
