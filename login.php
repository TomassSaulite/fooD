<?php
session_start();
ob_start();
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
    <header>
        <h1>FooD</h1>
        <div class="header-buttons" style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <button class="btn btn-header" onclick="location.href='login.php'">Login</button>
            <button class="btn btn-header" onclick="location.href='signup.php'">Sign Up</button>
        </div>
    </header>
    <div class="container">
        <h1>Login</h1>
        <form action="" method="POST">
            <div style="margin-bottom: 1rem;">
                <label for="name" style="display: block; margin-bottom: 0.5rem;">name</label>
                <input type="text" id="name" name="name" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label for="password" style="display: block; margin-bottom: 0.5rem;">Password</label>
                <input type="password" id="password" name="password" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <button type="submit" class="btn" style="width: 100%; padding: 0.5rem;">Login</button>
        </form>
    <?php
            require_once 'db.php';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $logFile = 'login_log.txt';
            $isSuccessful = false;

            $name = trim($_POST['name']);
            $password = trim($_POST['password']);

            try {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE name = :name");
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    $isSuccessful = true;
                }

                $logMessage = sprintf(
                    "[%s] Login attempt by user: %s - %s\n",
                    date('Y-m-d H:i:s'),
                    htmlspecialchars($name),
                    $isSuccessful ? 'SUCCESSFUL' : 'FAILED'
                );
                file_put_contents($logFile, $logMessage, FILE_APPEND);
            } catch (PDOException $e) {
                $logMessage = sprintf(
                    "[%s] Login attempt by user: %s - ERROR: %s\n",
                    date('Y-m-d H:i:s'),
                    htmlspecialchars($name),
                    $e->getMessage()
                );
                file_put_contents($logFile, $logMessage, FILE_APPEND);
            }

            $name = trim($_POST['name']);
            $password = trim($_POST['password']);

            try {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE name = :name");
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['username'] = $user['name']; // Set the username session variable
                    $_SESSION['name'] = $user['name'];
                    header("Location: mainMenu.php");
                    exit;
                } else {
                    echo "<p style='color: red;'>Invalid password.</p>";
                }
                } else {
                echo "<p style='color: red;'>User not found.</p>";
                }
            } catch (PDOException $e) {
                echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
            }
            ob_end_flush();
?>
    </div>

    <?php
        require_once 'db.php';
    ?>
</body>
</html>



<!-- admin admin -->

