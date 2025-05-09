<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        header {
            width: 100%;
            background-color: #ff6f61;
            color: white;
            padding: 1rem;
            padding-right: 30px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header-buttons {
            float: right;
        }
        .container {
            max-width: 400px;
            width: 90%;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 1rem;
            color: #333;
            margin: 0;
        }
        .btn {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            text-align: center;
            color: white;
            background-color: #ff6f61;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8rem;
        }
        .btn:hover {
            background-color: #e65a50;
        }
        .btn-header {
            padding: 0.3rem 0.6rem;
            font-size: 0.8rem;
        }
        @media (max-width: 600px) {
            header {
                font-size: 1.2rem;
            }
            h1 {
                font-size: 1.5rem;
            }
        }
        .hero {
            width: 100%;
            height: calc(100vh - 70px); /* Adjust height to account for the header */
            background-image: url('path-to-your-image.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            margin-top: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-text {
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
            font-size: 2rem;
            text-align: center;
        }
    </style>
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
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once 'db.php';

            // Log the login attempt
            $logFile = 'login_log.txt';
            $logMessage = sprintf("[%s] Login attempt by user: %s\n", date('Y-m-d H:i:s'), htmlspecialchars($_POST['name']));
            file_put_contents($logFile, $logMessage, FILE_APPEND);
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
            $isSuccessful = false;
            $logMessage = sprintf("[%s] Login attempt by user: %s\n", date('Y-m-d H:i:s'), htmlspecialchars($_POST['name']));
            file_put_contents($logFile, $logMessage, FILE_APPEND);

            $name = trim($_POST['name']);
            $password = trim($_POST['password']);

            try {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE name = :name");
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    header("Location: dashboard.php");
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
        ?>
    </div>

    <?php
        require_once 'db.php';
    ?>
</body>
</html>



<!-- admin admin -->

