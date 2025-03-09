<?php 
    require("admin_con.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Hind Historia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4e342e, #3e2723);
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .login-container {
            width: 30%;
            margin: 100px auto;
            padding: 20px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            border: 2px solid #FFD700;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.6);
        }

        input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }

        .login-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #FFD700;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .login-button:hover {
            background-color: #D4AF37;
        }
    </style>
</head>
<body> 
    <header class="hind-historia-header">
        <div class="header-container">
            <a href="index.html">
                <img src="logo.png" alt="Hind Historia Logo" class="logo">
            </a>
            <h1 class="site-title">Hind-Historia</h1>
        </div>
    </header>
    
    <style>
        .hind-historia-header {
            background: linear-gradient(to right, #4e342e, #3e2723);
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid #FFD700;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        }
    
        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    
        .logo {
            width: 60px;
            margin-right: 15px;
        }
    
        .site-title {
            font-family: 'Cinzel', serif;
            font-size: 30px;
            color: #FFD700;
            text-shadow: 2px 2px 6px rgba(255, 215, 0, 0.8);
        }
    </style>
    
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" action="admin_login.php">
            <input type="text" id="admin-username" placeholder="Username" name="admin_name" required><br>
            <input type="password" id="admin-password" placeholder="Password" name="admin_pass" required><br>
            <button type="submit" name="login" class="login-button">Login</button>
        </form>
    </div>

    <?php 
    if(isset($_POST['login']))
    {
        $query="SELECT * FROM `admin_login` WHERE `admin_name`='$_POST[admin_name]' AND `admin_pass`='$_POST[admin_pass]'";
        $result=mysqli_query($con,$query);

        if(mysqli_num_rows($result)==1)
        {
            session_start();
            $_SESSION['adminloginid']=$_POST['admin_name'];
            header("location:admin_dashboard.php");
        }
        else
        {
            header("location:admin_dashboard.php");
        }
    }
    ?>
</body>
</html>