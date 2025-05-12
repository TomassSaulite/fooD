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
    <div class="hero" style="background-image: url('img/img1.jpeg'); position: relative;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
        <div class="hero-text" style="font-size: 3rem; font-weight: bold; letter-spacing: 2px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #fff; text-shadow: 0 4px 8px rgba(0, 0, 0, 0.9); z-index: 1; font-family: 'Georgia', serif;">
            Welcome to FooD!
        </div>
    </div>
</body>
</html>