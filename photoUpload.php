<?php
require_once 'db.php';
session_start();

$alreadyUploaded = false;
if (isset($_SESSION['username'])) {
    $userStmt = $pdo->prepare('SELECT id FROM users WHERE name = :username');
    $userStmt->bindValue(':username', $_SESSION['username'], PDO::PARAM_STR);
    $userStmt->execute();
    $user = $userStmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $checkStmt = $pdo->prepare('SELECT id FROM photos WHERE user_id = :uid');
        $checkStmt->bindValue(':uid', $user['id'], PDO::PARAM_INT);
        $checkStmt->execute();
        $existingPhoto = $checkStmt->fetch(PDO::FETCH_ASSOC);
        if ($existingPhoto) {
            $alreadyUploaded = true;
        }
    }
}

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

    // Check if user already has a photo
    $checkStmt = $pdo->prepare('SELECT id FROM photos WHERE user_id = :uid');
    $checkStmt->bindValue(':uid', $user['id'], PDO::PARAM_INT);
    $checkStmt->execute();
    $existingPhoto = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($existingPhoto) {
        // Update existing photo
        $stmt = $pdo->prepare(
            'UPDATE photos SET filename = :fn, mimetype = :mt, data = :data WHERE id = :id'
        );
        $stmt->bindValue(':fn',   $file['name'], PDO::PARAM_STR);
        $stmt->bindValue(':mt',   $file['type'], PDO::PARAM_STR);
        $stmt->bindValue(':data', $data,         PDO::PARAM_LOB);
        $stmt->bindValue(':id',   $existingPhoto['id'], PDO::PARAM_INT);
    } else {
        // Insert new photo
        $stmt = $pdo->prepare(
            'INSERT INTO photos (user_id, filename, mimetype, data)
             VALUES (:uid, :fn, :mt, :data)'
        );
        $stmt->bindValue(':uid',  $user['id'], PDO::PARAM_INT);
        $stmt->bindValue(':fn',   $file['name'], PDO::PARAM_STR);
        $stmt->bindValue(':mt',   $file['type'], PDO::PARAM_STR);
        $stmt->bindValue(':data', $data,         PDO::PARAM_LOB);
    }

    try {
        $stmt->execute();
        header('Location: showPhoto.php');
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    }
}
?>

<!-- Show upload status box -->
<div style="margin: 1em 0; padding: 1em; border: 1px solid #ccc; background: #f9f9f9;">
    <?php if ($alreadyUploaded): ?>
        <strong>You have already uploaded a photo. Uploading again will replace your existing photo.</strong>
    <?php else: ?>
        <strong>You have not uploaded a photo yet.</strong>
    <?php endif; ?>
</div>

<!-- Your upload form here -->
<form method="post" enctype="multipart/form-data">
    <input type="file" name="photo" required>
    <button type="submit">Upload Photo</button>
</form>
