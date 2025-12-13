<?php

$mysqli = new mysqli('localhost', 'root', '', 'travela');
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Test validation của phoneNumber
$testPhones = [
    '0776129086' => true,  // 10 chữ số
    '077612908'  => false, // 9 chữ số
    '07761290860' => false, // 11 chữ số
    '0776129a86' => false, // có chữ cái
];

echo "Testing phoneNumber pattern validation:\n";
echo "=========================================\n";

foreach ($testPhones as $phone => $shouldPass) {
    $matches = preg_match('/^\d{10}$/', $phone);
    $result = $matches ? 'PASS' : 'FAIL';
    $expected = $shouldPass ? 'PASS' : 'FAIL';
    $status = ($result === $expected) ? '✓' : '✗';
    
    echo "$status Phone: $phone - Result: $result (Expected: $expected)\n";
}

echo "\nTesting user profile update:\n";
echo "================================\n";

// Test lấy user info
$userId = 1; // Thay đổi theo user test
$user = $mysqli->query("SELECT * FROM tbl_users WHERE userId = $userId")->fetch_assoc();

if ($user) {
    echo "Current user info:\n";
    echo "- ID: {$user['userId']}\n";
    echo "- Full Name: {$user['fullName']}\n";
    echo "- Email: {$user['email']}\n";
    echo "- Phone: {$user['phoneNumber']}\n";
    echo "- Address: {$user['address']}\n";
} else {
    echo "User not found\n";
}

$mysqli->close();
