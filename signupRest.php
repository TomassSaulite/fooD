<?php
require_once 'headerRest.php';
?>
<style>
    body {
        background: #f7f7fa;
        font-family: 'Segoe UI', Arial, sans-serif;
    }
    .container {
        max-width: 480px;
        margin: 40px auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 2.5rem 2rem 2rem 2rem;
    }
    h1 {
        text-align: center;
        color: #2d3748;
        margin-bottom: 1.5rem;
    }
    form > div {
        margin-bottom: 1.1rem;
    }
    label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.3rem;
        color: #444;
    }
    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="time"],
    input[type="password"] {
        width: 100%;
        padding: 0.55rem 0.7rem;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-size: 1rem;
        background: #f9fafb;
        transition: border 0.2s;
    }
    input:focus {
        border-color: #3182ce;
        outline: none;
        background: #fff;
    }
    .btn {
        width: 100%;
        padding: 0.7rem;
        background: #3182ce;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        margin-top: 0.7rem;
    }
    .btn:hover {
        background: #2563eb;
    }
    @media (max-width: 600px) {
        .container {
            padding: 1.2rem 0.5rem;
        }
    }
</style>
<body>
    <div class="container">
        <h1>Restaurant Sign Up</h1>
        <form action="signupRest.php" method="POST" onsubmit="return validateForm()">
            <div>
                <label for="name">Restaurant Name *</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="address">Address *</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div>
                <label for="city">City *</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div>
                <label for="postal_code">Postal Code</label>
                <input type="text" id="postal_code" name="postal_code">
            </div>
            <div>
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <label for="cuisine">Cuisine</label>
                <input type="text" id="cuisine" name="cuisine">
            </div>
            <div>
                <label for="opening_time">Opening Time</label>
                <input type="time" id="opening_time" name="opening_time">
            </div>
            <div>
                <label for="closing_time">Closing Time</label>
                <input type="time" id="closing_time" name="closing_time">
            </div>
            <div>
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password *</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
    </div>
    <script>
        function validateForm() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match. Please try again.');
                return false;
            }
            return true;
        }
    </script>
    <?php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

    require_once __DIR__ . '/db.php';
    $logFile = __DIR__ . '/error_log.txt';

    $name         = trim($_POST['name'] ?? '');
    $address      = trim($_POST['address'] ?? '');
    $city         = trim($_POST['city'] ?? '');
    $postal_code  = trim($_POST['postal_code'] ?? '');
    $phone        = trim($_POST['phone'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $cuisine      = trim($_POST['cuisine'] ?? '');
    $opening_time = $_POST['opening_time'] ?? null;
    $closing_time = $_POST['closing_time'] ?? null;
    $password     = $_POST['password'] ?? '';

    // Basic validation
    if (!$name || !$address || !$city || !$password) {
        echo "<script>alert('Please fill in all required fields.'); history.back();</script>";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare(
            'INSERT INTO restaurants
            (name, address, city, postal_code, phone, email, cuisine, opening_time, closing_time, password)
            VALUES
            (:name, :address, :city, :postal_code, :phone, :email, :cuisine, :opening_time, :closing_time, :password)'
        );
        $stmt->execute([
            ':name'         => $name,
            ':address'      => $address,
            ':city'         => $city,
            ':postal_code'  => $postal_code,
            ':phone'        => $phone,
            ':email'        => $email,
            ':cuisine'      => $cuisine,
            ':opening_time' => $opening_time,
            ':closing_time' => $closing_time,
            ':password'     => $hashed_password
        ]);

        echo "<script>
                alert('Restaurant sign up successful!');
                window.location.href = 'loginRest.php';
              </script>";
        exit;
    } catch (PDOException $e) {
        error_log('Database error on restaurant signup: ' . $e->getMessage() . PHP_EOL, 3, $logFile);
        echo "<script>alert('An error occurred during sign up. Please try again later.'); history.back();</script>";
        exit;
    }
    ?>
</body>
</html>