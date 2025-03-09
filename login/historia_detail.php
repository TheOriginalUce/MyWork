<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if site_name is provided in URL
if (!isset($_GET['site_name'])) {
    die("Site not found!");
}

$site_name = urldecode($_GET['site_name']);

// Fetch historia details
$query = "SELECT * FROM historia_detail WHERE site_name = '$site_name'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    die("No details found for this site!");
}

$historia = $result->fetch_assoc();
$images = explode(',', $historia['images']); // Split images into an array
$latitude = $historia['latitude'];
$longitude = $historia['longitude'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($site_name) ?> - Hind Historia</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBc__4ON7NhjXj5v5aLmvUc_x3AjsB3xzE"></script>
    <script>
        function initMap() {
            var location = { lat: <?= $latitude ?>, lng: <?= $longitude ?> };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>
    <style>
        /* Hind Historia Theme */

        /* General Page Styling */
        body {
            font-family: 'Cinzel', serif;
            background: #F5F5DC;
            color: #3E2723;
            margin: 0;
            padding: 0;
        }

        /* Historia Detail Container */
        .historia-detail-container {
            max-width: 80%;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .historia-detail-container h1 {
            font-size: 32px;
            color: #4E342E;
            border-bottom: 2px solid #D4AF37;
            padding-bottom: 10px;
        }

        /* Image Gallery */
        .historia-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .historia-image {
            width: 250px;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #D4AF37;
            transition: transform 0.3s ease-in-out;
        }

        .historia-image:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 10px rgba(255, 215, 0, 0.8);
        }

        /* Description */
        .historia-description {
            font-size: 18px;
            text-align: justify;
            margin-top: 20px;
            line-height: 1.6;
            padding: 15px;
            background: rgba(255, 215, 0, 0.1);
            border-radius: 10px;
            border: 2px solid #D4AF37;
        }

        /* Back Button */
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #D4AF37;
            color: #3E2723;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .back-btn:hover {
            background: #FFD700;
            transform: scale(1.1);
        }
    </style>
</head>
<body onload="initMap()">

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

    /* Icon Styling */
    nav ul li a i {
        color: #FFD700; 
        transition: transform 0.3s ease-in-out;
    }

    /* Icon Hover Effect */
    nav ul li a:hover i {
        transform: rotate(10deg);
    }
</style>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Historia Detail Container -->
<div class="historia-detail-container">
    <h1><?= htmlspecialchars($site_name) ?></h1>

    <!-- Image Gallery -->
    <div class="historia-gallery">
        <?php foreach ($images as $image) { ?>
            <img src="<?= htmlspecialchars(trim($image)) ?>" alt="Image of <?= htmlspecialchars($site_name) ?>" class="historia-image">
        <?php } ?>
    </div>

    <!-- Description -->
    <div class="historia-description">
        <p><?= nl2br(htmlspecialchars($historia['description'])) ?></p>
    </div>
    
    <!-- Mini Map -->
    <div id="map" style="width: 50%; height: 500px; border-radius: 10px;"></div>

    <!-- Back Button -->
    <a href="historia.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Historia</a>
</div>

</body>
</html>
