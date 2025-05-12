
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
echo '<h1 style="padding-left:20px; float:left">Hello, ' . htmlspecialchars($_SESSION['username']) . '!</h1>';
?>

<form action="photoUpload.php" method="post" enctype="multipart/form-data">
  <label for="photo">Choose a photo to upload:</label><br>
  <input type="file" id="photo" name="photo" accept="image/*" required>
  <br><br>
  
  <label for="title">Title (optional):</label><br>
  <input type="text" id="title" name="title" maxlength="100">
  <br><br>
  
  <button type="submit">Upload Photo</button>
</form>



</body>


</html>

