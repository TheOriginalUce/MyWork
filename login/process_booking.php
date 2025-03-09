<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['confirm']) && isset($_SESSION['booking_data'])) {
    $booking = $_SESSION['booking_data'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_name, phone, email, check_in, check_out, room_name, status) VALUES (?, ?, ?, ?, ?, ?, 'confirmed')");
    $stmt->bind_param("ssssss", $booking['user_name'], $booking['phone'], $booking['email'], $booking['check_in'], $booking['check_out'], $booking['room_name']);

    if ($stmt->execute()) {
        unset($_SESSION['booking_data']); // Remove session data after saving
        header("Location: booking.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    die("Invalid access!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Hind Historia</title>
    <style>
        /* Import Historical Font */
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap');

        /* General Styling */
        body {
            font-family: 'Cinzel', serif;
            background-color: #3E2723;
            color: #FFD700;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            text-shadow: 2px 2px 6px rgba(255, 215, 0, 0.8);
            border-bottom: 3px solid #D4AF37;
            display: inline-block;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* Confirmation Container */
        .confirmation-container {
            background: rgba(78, 52, 46, 0.9);
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.6);
            padding: 20px;
            width: 80%;
            max-width: 600px;
            margin: auto;
            border: 2px solid #D4AF37;
            text-align: center;
        }

        /* Confirmation Message */
        .confirmation-container p {
            font-size: 16px;
            color: #F5DEB3;
            margin: 10px 0;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
        }

        .home-btn {
            background: #D4AF37;
            color: #3E2723;
            margin-right: 10px;
        }

        .home-btn:hover {
            background: #FFD700;
            box-shadow: 0px 0px 10px rgba(255, 215, 0, 1);
        }

        .bookings-btn {
            background: #8B0000;
            color: white;
        }

        .bookings-btn:hover {
            background: #B22222;
            box-shadow: 0px 0px 10px rgba(255, 0, 0, 0.8);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .confirmation-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
<!-- 1. Website Logo and Name -->
<header>
    <div class="header-container">
        <a href="index.html">
            <img src="logo.png" alt="Hind Historia Logo" class="logo">
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

<div class="confirmation-container">
    <h1>Booking Confirmed!</h1>
    <p>Your booking has been successfully confirmed.</p>
    <p>We look forward to hosting you at Hind Historia.</p>
    <p>Check your <a href="booking.php" class="bookings-btn">Bookings</a> for details.</p>

    <a href="login.php" class="btn home-btn">Return to Home</a>
</div>

</body>
</html>

