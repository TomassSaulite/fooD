<?php
$host     = 'localhost';
$dbname   = 'FooD';
$username = 'admin';
$password = 'admin';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    echo "<script>console.log('Connection successful');</script>";
} catch (PDOException $e) {
    $msg = addslashes($e->getMessage());
    echo "<script>console.error('Connection failed: {$msg}');</script>";
    exit;
}

$table = 'users';
$stmt  = $pdo->query("SHOW TABLES LIKE " . $pdo->quote($table));
$exists = $stmt->rowCount() > 0;

if ($exists) {
    echo "<script>console.log('✅ Table \"{$table}\" exists.');</script>";
} else {
    echo "<script>console.warn('❌ Table \"{$table}\" does not exist.');</script>";
}
