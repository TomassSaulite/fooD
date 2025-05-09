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
            height: calc(100vh - 70px);
            background-image: url('path-to-your-image.jpg');
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
        <h1>Sign Up</h1>
        <form action="signup.php" method="POST" onsubmit="return validateForm()">
            <div style="margin-bottom: 1rem;">
                <label for="name" style="display: block; margin-bottom: 0.5rem;">name</label>
                <input type="text" id="name" name="name" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label for="email" style="display: block; margin-bottom: 0.5rem;">Email</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label for="password" style="display: block; margin-bottom: 0.5rem;">Password</label>
                <input type="password" id="password" name="password" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label for="confirm_password" style="display: block; margin-bottom: 0.5rem;">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <button type="submit" class="btn" style="width: 100%; padding: 0.5rem;">Sign Up</button>
        </form>
    </div>

    <script src="scripts.js"></script>

    <?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

require_once __DIR__ . '/db.php';
$logFile = __DIR__ . '/error_log.txt';
$name = trim($_POST['name'] ?? '');
$name = trim($_POST['name'] ?? '');
$email    = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$password = trim($_POST['password'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format.'); history.back();</script>";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
if ($hashedPassword === false) {
    error_log("Password hashing failed for user {$name}\n", 3, $logFile);
    echo "<script>alert('Internal error. Please try again later.'); history.back();</script>";
    exit;
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)'
    );
    $stmt->execute([
        ':name' => $name,
        ':email'    => $email,
        ':password' => $hashedPassword
    ]);

    echo "<script>
            alert('Sign up successful!');
            window.location.href = 'login.php';
          </script>";
    exit;
} catch (PDOException $e) {
    error_log("Database error on user signup: " . $e->getMessage() . "\n", 3, $logFile);
    echo "<script>alert('An error occurred during sign up. Please try again later.'); history.back();</script>";
    exit;
}
?>


<!-- admin tomassaulite@gmail.com   admin -->

