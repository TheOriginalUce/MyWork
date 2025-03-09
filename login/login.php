<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hind Historia - Login & Register</title>
    <style>
        /* Import Google Font for historical aesthetics */
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;700&display=swap');

        /* Page Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Crimson Text', serif;
            background: url('loginpic.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); 
        }

        .auth-box {
            position: relative;
            background: rgba(210, 180, 140, 0.9);
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            z-index: 2;
        }

        .auth-box h2 {
            color: #5a3e1b; 
            margin-bottom: 15px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #5a3e1b;
            border-radius: 5px;
        }

        .auth-btn {
            background: #8b5e3c; 
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }

        .auth-btn:hover {
            background: #5a3e1b;
        }

        .toggle-link {
            margin-top: 10px;
            display: block;
            color: #3d2b1f;
            cursor: pointer;
            text-decoration: underline;
        }

        .hidden {
            display: none;
        }

        /* Error Message */
        .error-message {
            color: red;
            font-size: 14px;
            display: none;
        }
    </style>
</head>
<body>

    <div class="overlay"></div> <!-- Background overlay -->
    
    <div class="auth-box">
        <!-- Login Form -->
        <div id="loginForm">
            <h2>Login to Hind Historia</h2>
            <form action="register.php" method="post">
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button class="auth-btn" type="submit" name="loginForm">Login</button>
            </form>
            <span class="toggle-link" onclick="toggleForms()">Don't have an account? Register</span>
        </div>

        <!-- Register Form -->
        <div id="registerForm" class="hidden">
            <h2>Register for Hind Historia</h2>
            <form action="register.php" method="POST">
                <div class="input-group">
                    <input type="text" id="fname" name="fname" placeholder="Enter your First name" required>
                </div>
                <div class="input-group">
                    <input type="text" id="lname" name="lname" placeholder="Enter your Last name" required>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Create a password" required>
                </div>
                
                <button class="auth-btn" type="submit" name="registerForm">Register</button>
            </form>
            <span class="toggle-link" onclick="toggleForms()">Already have an account? Login</span>
        </div>
    </div>

    <script>
        function toggleForms() {
            document.getElementById("loginForm").classList.toggle("hidden");
            document.getElementById("registerForm").classList.toggle("hidden");
        }

        function validatePassword() {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirmPassword").value;
            let errorMessage = document.getElementById("errorMessage");

            if (password !== confirmPassword) {
                errorMessage.style.display = "block";
                return false;
            } else {
                errorMessage.style.display = "none";
                return true;
            }
        }
    </script>

</body>
</html>
