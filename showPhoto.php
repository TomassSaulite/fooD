<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $photoId = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT mimetype, data FROM bigRestPhotos WHERE id = :id");
    $stmt->execute([':id' => $photoId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        if (ob_get_level()) ob_end_clean();
        header('Content-Type: ' . $row['mimetype']);
        echo $row['data'];
    }
    exit;
}

$stmt = $pdo->query("SELECT id FROM bigRestPhotos");
$photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($photos as $photo) {
    echo '<img src="showPhoto.php?id=' . $photo['id'] . '" style="max-width:300px;max-height:300px;margin:10px;" />';
}
if (!$photos) {
    echo '<br><br><br><br><br><p>No photos available.</p>';
    echo '<button action="logOut.php" class="button" onclick="window.location.href=\'index.php\'">back to main menu</button>';
}

