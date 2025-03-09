<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "login";

// Connect to database
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    die("Please log in to cancel your booking.");
}

$user_email = $_SESSION['email'];

// Ensure a booking ID is provided in the URL
if (!isset($_GET['booking_id']) || empty($_GET['booking_id'])) {
    die("Error: No booking selected for cancellation.");
}

$booking_id = intval($_GET['booking_id']);

// Fetch booking details
$booking_query = "SELECT * FROM bookings WHERE id = $booking_id AND email = '$user_email'";
$booking_result = $conn->query($booking_query);

if ($booking_result->num_rows == 0) {
    die("Booking not found or unauthorized access.");
}

$booking = $booking_result->fetch_assoc();
$room_name = $booking['room_name'];

$room_query = "SELECT * FROM rooms WHERE room_name = '$room_name'";
$room_result = $conn->query($room_query);
if ($room_result->num_rows == 0) {
    die("Error: Room details not found.");
}
$room = $room_result->fetch_assoc();

// Handle cancellation confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_cancel'])) {
    // Delete the booking record
    $delete_query = "DELETE FROM bookings WHERE id = $booking_id";
    if ($conn->query($delete_query) === TRUE) {
        // Restore room availability
       // Count total bookings for this room
$booking_count_query = "SELECT COUNT(*) AS booking_count FROM bookings WHERE room_name = '$room_name'";
$booking_count_result = $conn->query($booking_count_query);
$booking_count = $booking_count_result->fetch_assoc()['booking_count'];

// Restore slot by recalculating available slots (max 10 per room)
$available_slots = 10 - $booking_count;
        
        header("Location: booking.php?message=" . urlencode("$room_name booking cancelled successfully!"));
        exit();
    } else {
        echo "Error canceling booking: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking - <?= htmlspecialchars($room_name) ?></title>
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

        /* Booking Details Container */
        .cancel-container {
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

        /* Booking Image */
        .room-image {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 10px;
            border: 2px solid #FFD700;
            margin-bottom: 15px;
        }

        /* Booking Info */
        p {
            font-size: 16px;
            font-weight: bold;
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
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
            max-width: 300px;
        }

        .cancel-btn {
            background: #D2691E;
            color: white;
            border: none;
        }

        .cancel-btn:hover {
            background: #8B4513;
            box-shadow: 0px 0px 10px rgba(255, 215, 0, 1);
        }

        .back-btn {
            background: #FFD700;
            color: #3E2723;
            border: none;
        }

        .back-btn:hover {
            background: #D4AF37;
            box-shadow: 0px 0px 10px rgba(255, 215, 0, 1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .cancel-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="cancel-container">
    <h1>Cancel Booking for <?= htmlspecialchars($room_name) ?></h1>
    <img src="<?= htmlspecialchars($room['image']) ?>" alt="Room Image" class="room-image">    <p><strong>Name:</strong> <?= htmlspecialchars($booking['user_name']) ?></p>
    <p><strong>Phone:</strong> <?= htmlspecialchars($booking['phone']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?></p>
    <p><strong>Check-in:</strong> <?= date("d M Y", strtotime($booking['check_in'])) ?></p>
    <p><strong>Check-out:</strong> <?= date("d M Y", strtotime($booking['check_out'])) ?></p>

    <form method="POST">
        <button type="submit" name="confirm_cancel" class="btn cancel-btn">Confirm Cancellation</button>
        <a href="booking.php" class="btn back-btn">Go Back</a>
    </form>
</div>

</body>
</html>
