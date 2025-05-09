<?php
$host     = 'localhost';
$dbname   = 'FooD';
$username = 'admin';
$password = 'admin';

try {
    // 1) Connect via PDO
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    // 2) Log success to browser console
    echo "<script>console.log('Connection successful');</script>";
} catch (PDOException $e) {
    // 3) Log failure (and escape the message for JS)
    $msg = addslashes($e->getMessage());
    echo "<script>console.error('Connection failed: {$msg}');</script>";
    // stop execution if you can’t connect
    exit;
}

// 4) Check for the 'users' table
$table = 'users';
$stmt  = $pdo->query("SHOW TABLES LIKE " . $pdo->quote($table));
$exists = $stmt->rowCount() > 0;

if ($exists) {
    echo "<script>console.log('✅ Table \"{$table}\" exists.');</script>";
} else {
    echo "<script>console.warn('❌ Table \"{$table}\" does not exist.');</script>";
}
