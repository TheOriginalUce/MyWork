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

// Ensure booking details exist in session
if (!isset($_SESSION['booking'])) {
    die("No booking details found! Please book a room first.");
}

$booking = $_SESSION['booking'];
$room_name = $booking['room_name'];
$check_in = $booking['check_in'];
$check_out = $booking['check_out'];
$user_name = $booking['user_name'];
$phone = $booking['phone'];
$email = $booking['email'];

// Fetch room details from database
$room_query = "SELECT * FROM rooms WHERE room_name = '$room_name'";
$room_result = $conn->query($room_query);
if ($room_result->num_rows == 0) {
    die("Room not found in database.");
}
$room = $room_result->fetch_assoc();

// Handle payment (Confirm Booking)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    $insert_query = "INSERT INTO bookings (user_name, phone, email, room_name, check_in, check_out) 
                     VALUES ('$user_name', '$phone', '$email', '$room_name', '$check_in', '$check_out')";

    if ($conn->query($insert_query) === TRUE) {
        unset($_SESSION['booking']); // Clear session after successful booking
        header("Location: booking.php?success=1");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Handle cancellation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel'])) {
    unset($_SESSION['booking']); // Clear session without saving
    header("Location: rooms.php"); // Redirect back to rooms
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - <?= htmlspecialchars($room_name) ?></title>
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

        /* Checkout Container */
        .checkout-container {
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

        /* Room Image */
        .checkout-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 2px solid #D4AF37;
            border-radius: 10px;
        }

        /* Room Title */
        .checkout-card h2 {
            font-size: 22px;
            color: #FFD700;
            margin-top: 15px;
            text-shadow: 1px 1px 5px rgba(255, 215, 0, 0.8);
        }

        /* Booking Details */
        .checkout-card p,
        .user-details p {
            font-size: 14px;
            color: #F5DEB3;
            margin: 5px 0;
        }

        .checkout-card ul {
            list-style-type: none;
            padding: 0;
        }

        .checkout-card ul li {
            font-size: 13px;
            color: #DDD;
            padding: 3px 0;
        }

        /* User Details Section */
        .user-details {
            margin-top: 15px;
            border-top: 2px solid #D4AF37;
            padding-top: 10px;
        }

        .user-details h3 {
            color: #FFD700;
        }

        /* Buttons */
        .confirm-btn, .cancel-btn {
            width: 100%;
            padding: 12px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease-in-out;
        }

        .confirm-btn {
            background: #D4AF37;
            color: #3E2723;
        }

        .confirm-btn:hover {
            background: #FFD700;
            box-shadow: 0px 0px 10px rgba(255, 215, 0, 1);
        }

        .cancel-btn {
            background: #8B0000;
            color: white;
        }

        .cancel-btn:hover {
            background: #B22222;
            box-shadow: 0px 0px 10px rgba(255, 0, 0, 0.8);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .checkout-container {
                width: 90%;
            }
        }
    </style>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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

<div class="checkout-container">
    <h1>Confirm Your Booking</h1>
    
    <div class="checkout-card">
        <img src="<?= htmlspecialchars($room['image']) ?>" alt="Room Image" class="checkout-image">
        <h2><?= htmlspecialchars($room_name) ?></h2>
        <p><strong>Location:</strong> <?= htmlspecialchars($room['location']) ?></p>
        <p><strong>Price:</strong> ₹<?= htmlspecialchars($room['price']) ?> / night</p>
        <p><strong>Facilities:</strong></p>
        <ul>
            <?php foreach (explode(",", $room['features']) as $facility) { ?>
                <li><?= htmlspecialchars(trim($facility)) ?></li>
            <?php } ?>
        </ul>
        <p><strong>Check-in:</strong> <?= htmlspecialchars($check_in) ?></p>
        <p><strong>Check-out:</strong> <?= htmlspecialchars($check_out) ?></p>
    </div>

    <div class="user-details">
        <h3>Your Details</h3>
        <p><strong>Name:</strong> <?= htmlspecialchars($user_name) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
    </div>

    <form method="POST">
    <button type="button" id="pay-btn" class="confirm-btn">Pay & Confirm Booking</button>
    <button type="submit" name="cancel" class="cancel-btn">Cancel</button>
    </form>
</div>
<script>
        document.getElementById("pay-btn").onclick = function () {
        var options = {
        "key": "YOUR_RAZORPAY_KEY_ID", // Replace with your Razorpay Key ID
        "amount": <?= $room['price'] * 100 ?>, // Amount in paise (₹100 = 10000 paise)
        "currency": "INR",
        "name": "Hind Historia",
        "description": "Room Booking - <?= $room_name ?>",
        "image": "logo.png",
        "handler": function (response) {
            // Redirect to a PHP script to save booking details
            window.location.href = "confirm_booking.php?payment_id=" + response.razorpay_payment_id;
        },
        "prefill": {
            "name": "<?= $user_name ?>",
            "email": "<?= $email ?>",
            "contact": "<?= $phone ?>"
        },
        "theme": {
            "color": "#D4AF37"
        }
    };

    var rzp1 = new Razorpay(options);
    rzp1.open();
    };
    </script>

</body>
</html>

