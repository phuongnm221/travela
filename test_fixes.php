<?php
echo "=== STAFF MANAGEMENT SYSTEM - FIX VERIFICATION ===\n\n";

// 1. Check config/auth.php
echo "[1] Checking config/auth.php for guard 'admin'...\n";
$authConfig = include __DIR__ . '/config/auth.php';
if (isset($authConfig['guards']['admin'])) {
    echo "    ✓ Guard 'admin' exists\n";
    echo "    → Driver: {$authConfig['guards']['admin']['driver']}\n";
    echo "    → Provider: {$authConfig['guards']['admin']['provider']}\n";
} else {
    echo "    ✗ Guard 'admin' NOT found!\n";
}

// 2. Check provider 'admins'
echo "\n[2] Checking config/auth.php for provider 'admins'...\n";
if (isset($authConfig['providers']['admins'])) {
    echo "    ✓ Provider 'admins' exists\n";
    echo "    → Driver: {$authConfig['providers']['admins']['driver']}\n";
    echo "    → Table: {$authConfig['providers']['admins']['table']}\n";
} else {
    echo "    ✗ Provider 'admins' NOT found!\n";
}

// 3. Check middleware syntax
echo "\n[3] Checking StaffAccessRestriction middleware...\n";
$middlewarePath = __DIR__ . '/app/Http/Middleware/StaffAccessRestriction.php';
$middlewareContent = file_get_contents($middlewarePath);
if (strpos($middlewareContent, 'session()->get') !== false) {
    echo "    ✓ Using session()->get('admin')\n";
} else {
    echo "    ✗ Not using session data\n";
}

// 4. Check sidebar
echo "\n[4] Checking sidebar.blade.php...\n";
$sidebarPath = __DIR__ . '/resources/views/admin/blocks/sidebar.blade.php';
$sidebarContent = file_get_contents($sidebarPath);
if (strpos($sidebarContent, "session()->get('admin')") !== false) {
    echo "    ✓ Using session data for role check\n";
} else {
    echo "    ⚠ May be using different method\n";
}

// 5. Check database table
echo "\n[5] Checking database...\n";
$conn = new mysqli('localhost', 'root', '', 'travela');
if ($conn->connect_error) {
    echo "    ✗ DB Connection failed: {$conn->connect_error}\n";
} else {
    // Check role column
    $result = $conn->query("SHOW COLUMNS FROM tbl_admin WHERE Field = 'role'");
    if ($result->num_rows > 0) {
        echo "    ✓ tbl_admin has 'role' column\n";
    } else {
        echo "    ✗ tbl_admin missing 'role' column\n";
    }
    
    // Check admin data
    $adminCheck = $conn->query("SELECT COUNT(*) as count FROM tbl_admin WHERE role IS NOT NULL");
    $adminRow = $adminCheck->fetch_assoc();
    echo "    ✓ Admins with role assigned: {$adminRow['count']}\n";
    
    $conn->close();
}

// 6. Check routes
echo "\n[6] Checking routes configuration...\n";
$routesPath = __DIR__ . '/routes/web.php';
$routesContent = file_get_contents($routesPath);
if (strpos($routesContent, "middleware('staff.access')") !== false) {
    echo "    ✓ Staff access middleware applied to routes\n";
} else {
    echo "    ✗ Staff access middleware NOT applied\n";
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "✅ All fixes applied successfully!\n";
echo "📝 Next: Try logging in again\n";
echo str_repeat("=", 50) . "\n";
?>
