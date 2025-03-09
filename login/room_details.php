<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch room details using GET parameter
if (isset($_GET['room_name'])) {
    $room_name = urldecode($_GET['room_name']);

    // Fetch room details
    $room_query = "SELECT * FROM rooms WHERE room_name = '$room_name'";
    $room_result = $conn->query($room_query);
    $room = $room_result->fetch_assoc();

    // Fetch room description
    $desc_query = "SELECT description FROM room_descriptions WHERE room_name = '$room_name'";
    $desc_result = $conn->query($desc_query);
    $desc = $desc_result->fetch_assoc();

    // Check available bookings for the room location
    $booking_query = "SELECT COUNT(*) AS booking_count FROM bookings WHERE room_name = '$room_name'";
    $booking_result = $conn->query($booking_query);
    $booking = $booking_result->fetch_assoc();
    $available_slots = 10 - $booking['booking_count'];
} else {
    die("Room not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details - <?= $room['room_name'] ?></title>
    <link rel="stylesheet" href="styles.css">
    
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

    <!-- 2. Navigation Bar -->
<nav>
    <ul>
        <li><a href="homepage.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
        <li><a href="historia.php"><i class="fas fa-heart"></i> Favourites</a></li>
        <li><a href="rooms.php"><i class="fas fa-bed"></i> Rooms </a></li>
        <li><a href="booking.php"><i class="fas fa-calendar-check"></i> Booking</a></li>
        <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
        <li><a href="user_profile.php"><i class="fas fa-user"></i> User</a></li>
    </ul>
</nav>

<!-- CSS -->
<style>
    /* Import FontAwesome for Icons */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

    /* Navigation Bar Styling */
    nav {
        background: #4B2E1E; /* Dark Brown Background */
        border-bottom: 3px solid #D4AF37; /* Gold bottom border */
        padding: 15px 0;
        text-align: center;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);
    }

    /* Navigation List Styling */
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
        color: #FFD700; /* Gold Text */
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
        color: #FFA500; /* Orange Highlight */
    }

    /* Icon Styling */
    nav ul li a i {
        color: #FFD700; /* Gold Icons */
        transition: transform 0.3s ease-in-out;
    }

    /* Icon Hover Effect */
    nav ul li a:hover i {
        transform: rotate(10deg);
    }
</style>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<!-- Room Details Section -->
<div class="room-details-container">
    <h1 class="room-title"><?= $room['room_name'] ?></h1>
    <img src="<?= $room['image'] ?>" alt="<?= $room['room_name'] ?>" class="room-image">
    
    <div class="room-info">
        <p><strong>Location:</strong> <?= $room['location'] ?></p>
        <p><strong>Price:</strong> ₹<?= $room['price'] ?> / night</p>
        <p><strong>Facilities:</strong></p>
        <ul>
            <?php foreach (explode(",", $room['features']) as $facility) { ?>
                <li><?= trim($facility) ?></li>
            <?php } ?>
        </ul>
        <p><strong>Available From:</strong> <?= date("d M", strtotime($room['available_from'])) ?> - <?= date("d M", strtotime($room['available_to'])) ?></p>
        <p><strong>Description:</strong> <?= $desc['description'] ?? 'No description available.' ?></p>
    </div>

    <!-- Booking Section -->
    <div class="booking-section">
        <?php if ($available_slots > 0) { ?>
            <p class="available-slots"><strong>Available Slots:</strong> <?= $available_slots ?> / 10</p>
            <a href="book_room.php?room_name=<?=urlencode($room_name) ?>" class="book-btn">Book Now</a>
        <?php } else { ?>
            <p class="fully-booked">This room is fully booked!</p>
        <?php } ?>
    </div>
</div>

<!-- Hind Historia Room Details Styling -->
<style>
/* Import Historical Font */
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap');

/* Global Styles */
body {
    font-family: 'Cinzel', serif;
    background: #f5f5f5;
    margin: 0;
    padding: 0;
}

/* Header Styling */
.hind-historia-header {
    position: sticky;
    top: 0;
    width: 100%;
    background: #3E2723;
    border-bottom: 3px solid #D4AF37;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.6);
    z-index: 1000;
}

.header-container {
    display: flex;
    align-items: center;
    justify-content: left;
    max-width: 100%;
    padding: 15px;
}

.logo {
    height: 80px;
    margin-right: 20px;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.logo:hover {
    transform: scale(1.1);
    box-shadow: 0px 0px 15px rgba(212, 175, 55, 0.8);
}

.site-title {
    font-size: 35px;
    color: #FFD700;
    text-shadow: 3px 3px 10px rgba(255, 215, 0, 0.8);
}

/* Room Details Section */
.room-details-container {
    max-width: 800px;
    margin: 30px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.room-title {
    font-size: 28px;
    color: #D2691E;
    font-weight: bold;
}

.room-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid #D4AF37;
}

.room-info {
    text-align: left;
    margin-top: 20px;
}

.room-info p {
    font-size: 16px;
    color: #444;
    margin: 5px 0;
}

.room-info ul {
    list-style: none;
    padding: 0;
}

.room-info ul li {
    font-size: 14px;
    color: #666;
    padding: 5px 0;
}

/* Booking Section */
.booking-section {
    margin-top: 20px;
}

.available-slots {
    font-size: 18px;
    color: green;
    font-weight: bold;
}

.fully-booked {
    font-size: 18px;
    color: red;
    font-weight: bold;
}

.book-btn {
    display: inline-block;
    background: #D2691E;
    color: white;
    padding: 12px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    transition: background 0.3s ease-in-out;
}

.book-btn:hover {
    background: #8B4513;
}
</style>

</body>
</html>
