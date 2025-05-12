


<?php 
$photoId = (int)$_GET['id'];
$stmt    = $pdo->prepare('SELECT user_id, data, mimetype, filename FROM photos WHERE id = ?');
$stmt->execute([$photoId]);
$photo   = $stmt->fetch();

if (!$photo || $photo['user_id'] !== $_SESSION['user_id']) {
    http_response_code(403);
    exit('Forbidden');
}

header('Content-Type: ' . $photo['mimetype']);
echo $photo['data'];
?>