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
            margin-top: 70px; /* Match the header height */
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
    <div class="hero" style="background-image: url('img/img1.jpeg'); position: relative;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
        <div class="hero-text" style="font-size: 3rem; font-weight: bold; letter-spacing: 2px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #fff; text-shadow: 0 4px 8px rgba(0, 0, 0, 0.9); z-index: 1; font-family: 'Georgia', serif;">
            Welcome to FooD!
        </div>
    </div>
</body>
</html>