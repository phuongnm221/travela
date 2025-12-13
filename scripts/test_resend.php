<?php
// Test resend activation email
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\clients\LoginController;

// Create a test user (unactivated)
$email = 'test+' . time() . '@example.com';
try {
    $id = DB::table('tbl_users')->insertGetId([
        'username' => $email,
        'email' => $email,
        'password' => md5('TempP@ss123'),
        'is_activated' => 0,
    ]);
    echo "Created test user: $email (id: $id)\n";
} catch (Exception $e) {
    echo "Could not create user: " . $e->getMessage() . "\n";
    $user = DB::table('tbl_users')->where('is_activated', 0)->first();
    if ($user) {
        $email = $user->email;
        echo "Using existing unactivated user: $email\n";
    }
}

// Test resend activation
$request = Request::create('/resend-activation', 'POST', ['email_or_username' => $email]);
$controller = new LoginController();
try {
    $resp = $controller->resendActivationEmail($request);
    echo "Response: ";
    if (is_object($resp) && method_exists($resp, 'getContent')) {
        echo $resp->getContent() . "\n";
    } else {
        var_export($resp);
        echo "\n";
    }
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}

echo "\nCheck storage/logs/laravel.log for detailed mail errors.\n";
?>
