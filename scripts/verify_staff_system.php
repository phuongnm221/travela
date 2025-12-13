<?php
echo "=" . str_repeat("=", 78) . "\n";
echo "Staff Management System - Verification Report\n";
echo "=" . str_repeat("=", 78) . "\n\n";

// 1. Check if role column exists in tbl_admin
echo "[1] Checking if role column exists in tbl_admin table...\n";
$conn = new mysqli('localhost', 'root', '', 'travela');
$checkRole = $conn->query("SHOW COLUMNS FROM tbl_admin WHERE Field = 'role'");
if ($checkRole->num_rows > 0) {
    echo "    ✓ Role column exists\n";
} else {
    echo "    ✗ Role column missing!\n";
}

// 2. Check if StaffManagementController exists
echo "\n[2] Checking if StaffManagementController file exists...\n";
$controllerPath = __DIR__ . '/app/Http/Controllers/admin/StaffManagementController.php';
if (file_exists($controllerPath)) {
    echo "    ✓ StaffManagementController.php exists\n";
} else {
    echo "    ✗ StaffManagementController.php missing!\n";
}

// 3. Check if staff views exist
echo "\n[3] Checking if staff views exist...\n";
$viewPaths = [
    'create' => __DIR__ . '/resources/views/admin/staff/create.blade.php',
    'index' => __DIR__ . '/resources/views/admin/staff/index.blade.php',
    'edit' => __DIR__ . '/resources/views/admin/staff/edit.blade.php',
];

foreach ($viewPaths as $name => $path) {
    if (file_exists($path)) {
        echo "    ✓ $name.blade.php exists\n";
    } else {
        echo "    ✗ $name.blade.php missing!\n";
    }
}

// 4. Check if StaffAccessRestriction middleware exists
echo "\n[4] Checking if StaffAccessRestriction middleware exists...\n";
$middlewarePath = __DIR__ . '/app/Http/Middleware/StaffAccessRestriction.php';
if (file_exists($middlewarePath)) {
    echo "    ✓ StaffAccessRestriction.php exists\n";
} else {
    echo "    ✗ StaffAccessRestriction.php missing!\n";
}

// 5. Check migration file
echo "\n[5] Checking if migration file exists...\n";
$migrationPath = __DIR__ . '/database/migrations/2025_12_13_214845_add_role_to_tbl_admin.php';
if (file_exists($migrationPath)) {
    echo "    ✓ Migration file exists\n";
    
    // Check if migration is marked as completed
    $migrationCheck = $conn->query("SELECT * FROM migrations WHERE migration = '2025_12_13_214845_add_role_to_tbl_admin'");
    if ($migrationCheck->num_rows > 0) {
        echo "    ✓ Migration is marked as completed in database\n";
    } else {
        echo "    ✗ Migration not marked as completed in database\n";
    }
} else {
    echo "    ✗ Migration file missing!\n";
}

// 6. Check admin table structure
echo "\n[6] Checking tbl_admin table structure...\n";
$columns = $conn->query("DESCRIBE tbl_admin");
$requiredColumns = ['adminId', 'fullName', 'username', 'email', 'password', 'role'];
$foundColumns = [];

while ($row = $columns->fetch_assoc()) {
    $foundColumns[] = $row['Field'];
}

foreach ($requiredColumns as $col) {
    if (in_array($col, $foundColumns)) {
        echo "    ✓ $col column exists\n";
    } else {
        echo "    ✗ $col column missing!\n";
    }
}

// 7. Check if any staff exists in database
echo "\n[7] Checking staff records in database...\n";
$staffCount = $conn->query("SELECT COUNT(*) as count FROM tbl_admin WHERE role = 'staff'");
$result = $staffCount->fetch_assoc();
echo "    ✓ Staff records: " . $result['count'] . "\n";

// 8. Count admin users
echo "\n[8] Checking admin records in database...\n";
$adminCount = $conn->query("SELECT COUNT(*) as count FROM tbl_admin WHERE role = 'admin' OR role IS NULL");
$result = $adminCount->fetch_assoc();
echo "    ✓ Admin records: " . $result['count'] . "\n";

// 9. Check routes configuration
echo "\n[9] Verifying routes configuration...\n";
$routesFile = __DIR__ . '/../routes/web.php';
$routesContent = file_get_contents($routesFile);

$routeChecks = [
    'StaffManagementController' => 'Controller import',
    "route('admin.staff.index')" => 'Staff index route',
    "route('admin.staff.create')" => 'Staff create route',
    "route('admin.staff.edit'" => 'Staff edit route',
];

foreach ($routeChecks as $check => $desc) {
    if (strpos($routesContent, $check) !== false) {
        echo "    ✓ $desc configured\n";
    } else {
        echo "    ✗ $desc missing!\n";
    }
}

// 10. Check sidebar configuration
echo "\n[10] Verifying sidebar configuration...\n";
$sidebarFile = __DIR__ . '/../resources/views/admin/blocks/sidebar.blade.php';
$sidebarContent = file_get_contents($sidebarFile);

$sidebarChecks = [
    "admin.staff.index" => 'Staff management menu item',
    "admin('admin')->user()->role === 'admin'" => 'Role-based menu visibility',
];

foreach ($sidebarChecks as $check => $desc) {
    if (strpos($sidebarContent, $check) !== false) {
        echo "    ✓ $desc configured\n";
    } else {
        echo "    ✗ $desc missing!\n";
    }
}

$conn->close();

echo "\n" . "=" . str_repeat("=", 78) . "\n";
echo "Verification Complete!\n";
echo "=" . str_repeat("=", 78) . "\n";
?>
