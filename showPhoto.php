
<?php
session_start();
require_once 'headerWithLogout.php';
require_once 'logincheck.php';
require_once 'db.php';
?>


<br>
<br>
<br>
<br>
<br>



<?php

$photoId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("
    SELECT mimetype, data, user_id
      FROM photos
     WHERE id = :id
");
$stmt->execute([':id' => $photoId]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    http_response_code(404);
    exit('Photo not found');
}

if (!isset($_SESSION['id']) || $row['user_id'] !== $_SESSION['id']) {
    http_response_code(403);
    exit('Forbidden: not your photo');
}

header('Content-Type: ' . $row['mimetype']);            
header('Content-Length: ' . strlen($row['data']));
echo $row['data'];                             

?>



</body>


</html>

