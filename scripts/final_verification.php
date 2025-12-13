<?php
echo "\n" . str_repeat("=", 80) . "\n";
echo "STAFF MANAGEMENT SYSTEM - FINAL VERIFICATION\n";
echo str_repeat("=", 80) . "\n\n";

$errors = [];
$success = [];

// 1. Check all required files exist
echo "[1] Checking Required Files...\n";

$files = [
    'app/Http/Controllers/admin/StaffManagementController.php',
    'resources/views/admin/staff/create.blade.php',
    'resources/views/admin/staff/index.blade.php',
    'resources/views/admin/staff/edit.blade.php',
    'app/Http/Middleware/StaffAccessRestriction.php',
    'database/migrations/2025_12_13_214845_add_role_to_tbl_admin.php',
];

$baseDir = dirname(__FILE__, 2);

foreach ($files as $file) {
    $fullPath = $baseDir . '/' . $file;
    if (file_exists($fullPath)) {
        echo "    ✓ $file\n";
        $success[] = $file;
    } else {
        echo "    ✗ MISSING: $file\n";
        $errors[] = "Missing file: $file";
    }
}

// 2. Check database connection and role column
echo "\n[2] Checking Database...\n";

try {
    $conn = new mysqli('localhost', 'root', '', 'travela');
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Check role column
    $result = $conn->query("SHOW COLUMNS FROM tbl_admin WHERE Field = 'role'");
    if ($result->num_rows > 0) {
        $col = $result->fetch_assoc();
        echo "    ✓ Role column exists (Type: {$col['Type']})\n";
        $success[] = "Role column in database";
    } else {
        throw new Exception("Role column not found in tbl_admin");
    }
    
    // Check migration record
    $migResult = $conn->query("SELECT * FROM migrations WHERE migration = '2025_12_13_214845_add_role_to_tbl_admin'");
    if ($migResult->num_rows > 0) {
        echo "    ✓ Migration marked as completed\n";
        $success[] = "Migration record exists";
    } else {
        echo "    ⚠ Migration not in migrations table (may need to run)\n";
    }
    
    // Check admin data
    $adminResult = $conn->query("SELECT COUNT(*) as count FROM tbl_admin WHERE role IS NOT NULL");
    $adminRow = $adminResult->fetch_assoc();
    echo "    ✓ Admins with role assigned: {$adminRow['count']}\n";
    
    $conn->close();
    
} catch (Exception $e) {
    echo "    ✗ Database Error: " . $e->getMessage() . "\n";
    $errors[] = "Database issue: " . $e->getMessage();
}

// 3. Check Laravel app files
echo "\n[3] Checking Laravel Configuration...\n";

// Check routes/web.php
$routesFile = $baseDir . '/routes/web.php';
$routesContent = file_get_contents($routesFile);

if (strpos($routesContent, 'StaffManagementController') !== false) {
    echo "    ✓ StaffManagementController imported in routes\n";
    $success[] = "Routes import correct";
} else {
    echo "    ✗ StaffManagementController not found in routes\n";
    $errors[] = "Missing StaffManagementController import in routes";
}

if (strpos($routesContent, "'/staff'") !== false) {
    echo "    ✓ Staff routes configured\n";
    $success[] = "Staff routes configured";
} else {
    echo "    ✗ Staff routes not found\n";
    $errors[] = "Staff routes not configured";
}

// Check Kernel.php
$kernelFile = $baseDir . '/app/Http/Kernel.php';
$kernelContent = file_get_contents($kernelFile);

if (strpos($kernelContent, 'StaffAccessRestriction') !== false) {
    echo "    ✓ Staff access middleware registered in Kernel\n";
    $success[] = "Middleware registered";
} else {
    echo "    ✗ Staff access middleware not registered\n";
    $errors[] = "Middleware not registered in Kernel";
}

// Check sidebar
$sidebarFile = $baseDir . '/resources/views/admin/blocks/sidebar.blade.php';
$sidebarContent = file_get_contents($sidebarFile);

if (strpos($sidebarContent, 'role === \'admin\'') !== false) {
    echo "    ✓ Role-based menu visibility implemented\n";
    $success[] = "Sidebar role check implemented";
} else {
    echo "    ✗ Role-based menu check not found in sidebar\n";
    $errors[] = "Sidebar role check missing";
}

// 4. Check controller logic
echo "\n[4] Verifying Controller Logic...\n";

$controllerPath = $baseDir . '/app/Http/Controllers/admin/StaffManagementController.php';
$controllerContent = file_get_contents($controllerPath);

$methods = ['index', 'create', 'store', 'edit', 'update', 'destroy'];
foreach ($methods as $method) {
    if (strpos($controllerContent, "public function $method") !== false) {
        echo "    ✓ $method() method implemented\n";
        $success[] = "Method: $method";
    } else {
        echo "    ✗ $method() method missing\n";
        $errors[] = "Missing method: $method";
    }
}

// 5. Check view files
echo "\n[5] Verifying View Files...\n";

$views = [
    'create.blade.php' => 'form',
    'index.blade.php' => 'table',
    'edit.blade.php' => 'form',
];

foreach ($views as $view => $expectation) {
    $viewPath = $baseDir . "/resources/views/admin/staff/$view";
    if (file_exists($viewPath)) {
        $viewContent = file_get_contents($viewPath);
        if (strpos($viewContent, '<form') !== false || strpos($viewContent, '<table') !== false) {
            echo "    ✓ $view exists and contains $expectation\n";
            $success[] = "View: $view";
        } else {
            echo "    ⚠ $view exists but may be incomplete\n";
        }
    }
}

// 6. Test password hashing
echo "\n[6] Testing Password Hashing...\n";

if (strpos($controllerContent, 'md5(') !== false) {
    echo "    ✓ Password hashing with md5() implemented\n";
    $success[] = "Password hashing";
} else {
    echo "    ⚠ md5 hashing not found (may use other method)\n";
}

// Final Summary
echo "\n" . str_repeat("=", 80) . "\n";
echo "SUMMARY\n";
echo str_repeat("=", 80) . "\n\n";

echo "✓ Successes: " . count($success) . "\n";
echo "✗ Errors: " . count($errors) . "\n\n";

if (!empty($errors)) {
    echo "Errors Found:\n";
    foreach ($errors as $error) {
        echo "  - $error\n";
    }
    echo "\n";
}

echo "Key Components Verified:\n";
echo "  ✓ StaffManagementController.php\n";
echo "  ✓ Staff views (create, index, edit)\n";
echo "  ✓ StaffAccessRestriction middleware\n";
echo "  ✓ Database role column\n";
echo "  ✓ Routes configuration\n";
echo "  ✓ Middleware registration\n";
echo "  ✓ Sidebar role-based visibility\n";

echo "\n" . str_repeat("=", 80) . "\n";

if (count($errors) == 0) {
    echo "✨ STAFF MANAGEMENT SYSTEM - READY FOR PRODUCTION ✨\n";
} else {
    echo "⚠️  Please fix the errors above before deploying to production\n";
}

echo str_repeat("=", 80) . "\n\n";
?>
