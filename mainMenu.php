
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery App</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>  


<?php
require_once 'logincheck.php';
echo 'Hello, ' . htmlspecialchars($_SESSION['username']);



?>

<form action="logOut.php" method="post">
  <button type="submit" name="action" value="logOut" class="btn btn-header">
    Run PHP Function
  </button>
</form>
</body>


</html>