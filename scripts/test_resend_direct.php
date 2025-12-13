<?php
require_once __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\clients\LoginController;
use Illuminate\Http\Request;

// Get last registered user
$user = DB::table('tbl_users')->latest('userId')->first();

if (!$user) {
    echo "Không có user nào để test\n";
    exit(1);
}

echo "Testing resend activation for: " . $user->email . " (ID: " . $user->userId . ")\n";

// Create request object
$request = new Request([
    'email_or_username' => $user->email
]);

$controller = new LoginController();
$response = $controller->resendActivationEmail($request);

echo "Response: " . json_encode($response->getData()) . "\n";
?>
