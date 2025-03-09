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

// Check if room_name is provided in URL
if (!isset($_GET['room_name'])) {
    die("Room not found!");
}

$room_name = urldecode($_GET['room_name']);

// Fetch room details
$room_query = "SELECT * FROM rooms WHERE room_name = '$room_name'";
$room_result = $conn->query($room_query);
if ($room_result->num_rows == 0) {
    die("Room not found!");
}
$room = $room_result->fetch_assoc();

// Convert available dates to timestamps for comparison
$available_from = strtotime($room['available_from']);
$available_to = strtotime($room['available_to']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $check_in = strtotime($_POST['check_in']);  // Convert input dates to timestamps
    $check_out = strtotime($_POST['check_out']);

    // Validate check-in/check-out dates
    if ($check_in < $available_from || $check_out > $available_to) {
        $error_message = "Selected dates are out of range! Choose between " . date("d M Y", $available_from) . " and " . date("d M Y", $available_to);
    } else {
        // Store booking details in session
        $_SESSION['booking'] = [
            'user_name' => $user_name,
            'phone' => $phone,
            'email' => $email,
            'room_name' => $room_name,
            'check_in' => $_POST['check_in'],  // Store original string date
            'check_out' => $_POST['check_out']
        ];
        
        header("Location: checkout.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Room - <?= htmlspecialchars($room['room_name']) ?></title>
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

        /* Booking Container */
        .booking-container {
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
        .room-image {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 10px;
            border: 2px solid #FFD700;
            margin-bottom: 15px;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0 5px;
            color: #FFD700;
        }

        input {
            width: 90%;
            max-width: 300px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #D4AF37;
            font-size: 14px;
            text-align: center;
        }

        /* Error Message */
        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
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

        .next-btn {
            background: #D4AF37;
            color: #3E2723;
            border: none;
        }

        .next-btn:hover {
            background: #FFD700;
            box-shadow: 0px 0px 10px rgba(255, 215, 0, 1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .booking-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="booking-container">
    <h1>Book <?= htmlspecialchars($room['room_name']) ?></h1>
    <img src="<?= $room['image'] ?>" alt="<?= htmlspecialchars($room['room_name']) ?>" class="room-image">
    <p><strong>Available From:</strong> <?= date("d M Y", $available_from) ?> - <?= date("d M Y", $available_to) ?></p>

    <?php if (isset($error_message)) { ?>
        <p class="error-message"><?= $error_message ?></p>
    <?php } ?>

    <form action="" method="POST">
        <label>Name:</label>
        <input type="text" name="user_name" required>

        <label>Phone:</label>
        <input type="text" name="phone" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Check-in Date:</label>
        <input type="date" name="check_in" required>

        <label>Check-out Date:</label>
        <input type="date" name="check_out" required>

        <button type="submit" class="btn next-btn">Next</button>
    </form>
</div>

</body>
</html>
