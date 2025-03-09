<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Hind Historia</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Cinzel', serif;
            background: linear-gradient(to right, #4E342E, #3E2723);
            color: #FFD700;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 15% auto;
            background: rgba(255, 215, 0, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.6);
            border: 3px solid #D4AF37;
        }

        h1 {
            font-size: 32px;
            text-shadow: 2px 2px 6px rgba(255, 215, 0, 0.8);
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            font-size: 18px;
            font-weight: bold;
            padding: 12px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }

        .login-btn {
            background: #D4AF37;
            color: #3E2723;
        }

        .login-btn:hover {
            background: #FFD700;
            transform: scale(1.05);
            box-shadow: 0px 0px 10px rgba(255, 215, 0, 0.8);
        }

        .main-page-btn {
            background: #8B0000;
            color: white;
        }

        .main-page-btn:hover {
            background: #B22222;
            transform: scale(1.05);
            box-shadow: 0px 0px 10px rgba(255, 0, 0, 0.8);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 80%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to Hind Historia</h1>
    <a href="login.php" class="btn login-btn">Login</a>
    <a href="homepage.php" class="btn main-page-btn">Go to Main Page</a>
</div>

</body>
</html>
