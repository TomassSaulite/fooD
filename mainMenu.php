
<?php
session_start();
require_once 'headerWithLogout.php';
require_once 'logincheck.php';
echo 'Hello, ' . htmlspecialchars($_SESSION['username']);
?>

<form action="logOut.php" method="post">
  <button type="submit" name="action" value="logOut" class="btn btn-header">
    Log out
  </button>
</form>
</body>


</html>