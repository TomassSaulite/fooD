<?php
session_start();
ob_start();
require_once 'headerRest.php';
?>
<body>
    <div class="container">
        <h1>Restaurant Login</h1>
        <form action="" method="POST">
            <div style="margin-bottom: 1rem;">
                <label for="email" style="display: block; margin-bottom: 0.5rem;">Email</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
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

            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            try {
                $stmt = $pdo->prepare("SELECT * FROM restaurants WHERE email = :email");
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
                $restaurant = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($restaurant && isset($restaurant['password']) && password_verify($password, $restaurant['password'])) {
                    $isSuccessful = true;
                    $_SESSION['restaurant_id'] = $restaurant['restaurant_id'];
                    $_SESSION['restaurant_name'] = $restaurant['name'];
                    header("Location: mainMenuRest.php");
                    exit;
                } else {
                    echo "<p style='color: red;'>Invalid email or password.</p>";
                }

                $logMessage = sprintf(
                    "[%s] Restaurant login attempt: %s - %s\n",
                    date('Y-m-d H:i:s'),
                    htmlspecialchars($email),
                    $isSuccessful ? 'SUCCESSFUL' : 'FAILED'
                );
                file_put_contents($logFile, $logMessage, FILE_APPEND);
            } catch (PDOException $e) {
                $logMessage = sprintf(
                    "[%s] Restaurant login attempt: %s - ERROR: %s\n",
                    date('Y-m-d H:i:s'),
                    htmlspecialchars($email),
                    $e->getMessage()
                );
                file_put_contents($logFile, $logMessage, FILE_APPEND);
                echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        }
        ob_end_flush();
    ?>
    </div>
</body>
</html>

