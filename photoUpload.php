<?php
require_once 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['photo'];

    if (empty($file['tmp_name']) || empty($file['name']) || empty($file['type'])) {
        echo 'Error: Invalid file upload.';
        exit;
    }
    $data = file_get_contents($file['tmp_name']);

    $userStmt = $pdo->prepare('SELECT id FROM users WHERE name = :username');
    $userStmt->bindValue(':username', $_SESSION['username'], PDO::PARAM_STR);
    $userStmt->execute();
    $user = $userStmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo 'Error: User not found.';
        exit;
    }

    $stmt = $pdo->prepare(
        'INSERT INTO photos (user_id, filename, mimetype, data)
         VALUES (:uid, :fn, :mt, :data)'
    );
    $stmt->bindValue(':uid',  $user['id'], PDO::PARAM_INT);
    $stmt->bindValue(':fn',   $file['name'],        PDO::PARAM_STR);
    $stmt->bindValue(':mt',   $file['type'],        PDO::PARAM_STR);
    $stmt->bindValue(':data', $data,                PDO::PARAM_LOB);

    try {
        $stmt->execute();
        header('Location: showPhoto.php');
        
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    }
}
?>
