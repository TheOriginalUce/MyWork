<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $mail = new PHPMailer(true);
        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP Server
            $mail->SMTPAuth = true;
            $mail->Username = 'your-email@gmail.com'; // Your Gmail
            $mail->Password = 'your-app-password'; // Your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email Settings
            $mail->setFrom($email, $name);
            $mail->addAddress('nat512815@gmail.com'); // Your email
            $mail->Subject = "New Contact Message from $name";
            $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

            if ($mail->send()) {
                echo "<p class='success'>Message sent successfully!</p>";
            } else {
                echo "<p class='error'>Message could not be sent. Try again later.</p>";
            }
        } catch (Exception $e) {
            echo "<p class='error'>Mailer Error: {$mail->ErrorInfo}</p>";
        }
    } else {
        echo "<p class='error'>Please fill in all fields.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Hind Historia</title>
</head>
<body>

<div class="background-grid">
        <div class="hp1"></div>
        <div class="hp2"></div>
        <div class="hp3"></div>
        <div class="hp4"></div>
        <div class="hp5"></div>
        <div class="hp6"></div>
        <div class="hp7"></div>
        <div class="hp8"></div>
    </div>
    <style>
        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            position: relative;
        }
    
        .background-grid {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 5px; 
            z-index: -1; 
            padding: 10px;
        }
    
        /* Background Images */
        .background-grid div {
            background-size: cover;
            background-position: center;
            border-radius: 20px; 
            transition: transform 0.4s ease-in-out, filter 0.4s ease-in-out;
        }
    
        .background-grid div:hover {
            transform: scale(1.05);
            filter: brightness(90%);
        }

        .hp1 { background-image: url('hp1.jpg'); }
        .hp2 { background-image: url('hp2.jpg'); }
        .hp3 { background-image: url('hp3.jpg'); }
        .hp4 { background-image: url('hp4.jpg'); }
        .hp5 { background-image: url('hp5.jpg'); }
        .hp6 { background-image: url('hp6.jpg'); }
        .hp7 { background-image: url('hp7.jpg'); }
        .hp8 { background-image: url('hp8.jpg'); }
    </style>

<!-- 1. Website Logo and Name -->
<header>
    <div class="header-container">
        <a href="index.html">
            <img src="Logo.png" alt="Hind Historia Logo" class="logo">
        </a>
        <h1 class="site-title">Hind-Historia</h1>
    </div>
</header>
<!-- CSS -->
<style>
    /* Import Historical Font */
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap');

    /* Header Styling */
    header {
        position: sticky;
        top: 0;
        width: 100%;
        height: 120px;
        background: #3E2723; /* Deep Brown Background */
        border-bottom: 3px solid #D4AF37; /* Gold Bottom Border */
        z-index: 1000;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.6);
    }

    /* Header Container */
    .header-container {
        display: flex;
        align-items: center;
        justify-content: left;
        max-width: 100%;
        margin: auto;
        padding: 15px;
        }

    /* Logo Styling */
    .logo {
        height: 80px;
        margin-right: 20px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* Clickable Logo Hover Effect */
    .logo:hover {
        transform: scale(1.1);
        box-shadow: 0px 0px 15px rgba(212, 175, 55, 0.8);
    }

    /* Site Title Styling (Historical Look) */
    .site-title {
        font-family: 'Cinzel', serif;
        font-size: 40px;
        color: #FFD700; /* Gold Text */
        text-shadow: 3px 3px 10px rgba(255, 255, 255, 0.5), 2px 2px 5px rgba(212, 175, 55, 0.8);
        font-weight: bold;
        padding: 10px 20px;
        transition: text-shadow 0.3s ease-in-out;
    }

    /* Glowing Text Effect on Hover */
    .site-title:hover {
        text-shadow: 0px 0px 15px rgba(255, 215, 0, 1);
    }
</style>

<!-- 2. Navigation Bar -->
 <nav>
    <ul>
        <li><a href="homepage.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
        <li><a href="historia.php"><i class="fas fa-heart"></i> Historia</a></li>
        <li><a href="rooms.php"><i class="fas fa-bed"></i> Rooms </a></li>
        <li><a href="booking.php"><i class="fas fa-calendar-check"></i> Booking</a></li>
        <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
        <li><a href="user_profile.php"><i class="fas fa-user"></i> User</a></li>
    </ul>
 </nav>
<!-- CSS -->
 <style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

    nav {
        background: #4B2E1E; 
        border-bottom: 3px solid #D4AF37; 
        padding: 15px 0;
        text-align: center;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);
    }

    /* Navigation List */
    nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
    }

    /* Navigation Items */
    nav ul li {
        margin: 0 15px;
        position: relative;
    }

    /* Navigation Links */
    nav ul li a {
        font-family: 'Cinzel', serif;
        font-size: 18px;
        color: #FFD700; 
        text-decoration: none;
        font-weight: bold;
        padding: 10px 15px;
        border-radius: 5px;
        transition: color 0.3s ease-in-out, transform 0.3s ease-in-out;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Hover Effect */
    nav ul li a:hover {
        color: #fff;
        transform: scale(1.1);
        text-shadow: 0px 0px 8px rgba(255, 215, 0, 0.8);
    }

    /* Active Link Effect */
    nav ul li a:active {
        color: #FFA500; 
    }

    nav ul li a i {
        color: #FFD700; 
        transition: transform 0.3s ease-in-out;
    }

    nav ul li a:hover i {
        transform: rotate(10deg);
    }
 </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="contact-container">
    <h1>Contact Us</h1>
    <form method="POST" action="">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Message:</label>
        <textarea name="message" rows="5" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

<style>
.contact-container {
            width: 50%;
            margin: 50px auto;
            padding: 30px;
            background: linear-gradient(to bottom, #3E2723, #4E342E); /* Brown gradient */
            color: #FFD700; /* Gold text */
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
            border: 3px solid #D4AF37; /* Gold border */
        }

        .contact-container h1 {
            font-size: 28px;
            text-shadow: 2px 2px 6px rgba(255, 215, 0, 0.8);
            border-bottom: 2px solid #D4AF37;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* Form Styling */
        .contact-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contact-container label {
            font-size: 16px;
            font-weight: bold;
            color: #FFD700; /* Gold */
            text-align: left;
            width: 100%;
            margin-bottom: 5px;
        }

        .contact-container input,
        .contact-container textarea {
            width: 90%;
            padding: 12px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background: #FFF3E0; /* Light beige */
            color: #3E2723;
            margin-bottom: 15px;
        }

        .contact-container textarea {
            height: 120px;
            resize: vertical;
        }

        /* Submit Button */
        .contact-container button {
            background: #D4AF37; /* Gold */
            color: #3E2723; /* Dark brown */
            font-size: 16px;
            font-weight: bold;
            padding: 12px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .contact-container button:hover {
            background: #FFD700;
            transform: scale(1.05);
            box-shadow: 0px 0px 10px rgba(255, 215, 0, 0.8);
        }

        /* Success & Error Messages */
        .success {
            color: green;
            font-weight: bold;
            margin-top: 15px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-top: 15px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-container {
                width: 90%;
                padding: 20px;
            }

            .contact-container input,
            .contact-container textarea {
                width: 100%;
            }
        }
</style>    

</body>
</html>
