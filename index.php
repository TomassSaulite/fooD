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
            text-align: center;
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
        }
        .btn {
            display: block;
            width: 100%;
            padding: 0.75rem;
            margin: 0.5rem 0;
            text-align: center;
            color: white;
            background-color: #ff6f61;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        .btn:hover {
            background-color: #e65a50;
        }
        @media (max-width: 600px) {
            header {
                font-size: 1.2rem;
            }
            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to FoodieExpress</h1>
    </header>
    <div class="container">
        <h1>Get Started</h1>
        <button class="btn" onclick="location.href='login.php'">Login</button>
        <button class="btn" onclick="location.href='signup.php'">Sign Up</button>
    </div>
</body>
</html>