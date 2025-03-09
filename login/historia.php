<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all historical sites
$sql = "SELECT site_name, location, image FROM historia";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historia - Hind Historia</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        <li><a href="historia.php"><i class="fas fa-heart"></i>Historia</a></li>
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

<h2 class="historia-title">Explore India's Historical Wonders</h2>

<div class="historia-container">
    <?php if ($result->num_rows > 0) { ?>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <a href="historia_detail.php?site_name=<?= urlencode($row['site_name']) ?>" class="historia-card">
                <img src="<?= htmlspecialchars($row['image']) ?>" alt="Historical Site" class="historia-image">
                <div class="historia-info">
                    <h3><?= htmlspecialchars($row['site_name']) ?></h3>
                    <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($row['location']) ?></p>
                </div>
            </a>
        <?php } ?>
    <?php } else { ?>
        <p class="no-sites">No historical sites available.</p>
    <?php } ?>
</div>

<style>
/* Hind Historia Theme */
body {
    font-family: 'Cinzel', serif;
    background: #f8f5e1;
    color: #3E2723;
    margin: 0;
    padding: 0;
    text-align: center;
}

/* Page Title */
.historia-title {
    font-size: 26px;
    color: #3E2723;
    margin: 20px 0;
    text-transform: uppercase;
    font-weight: bold;
    text-shadow: 1px 1px 5px rgba(62, 39, 35, 0.5);
}

/* Historia Container */
.historia-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 25px;
    padding: 30px;
}

/* Historia Cards */
.historia-card {
    width: 320px;
    background: white;
    border-radius: 12px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
    text-align: center;
    overflow: hidden;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    cursor: pointer;
    border: 3px solid #D2691E;
    text-decoration: none;
    color: inherit;
    position: relative;
}

.historia-card:hover {
    transform: scale(1.05);
    box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.4);
}

.historia-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 3px solid #D2691E;
}

/* Historia Info */
.historia-info {
    padding: 15px;
    background: #3E2723;
    color: #FFD700;
    font-size: 18px;
}

.historia-info h3 {
    font-size: 20px;
    margin: 10px 0;
}

.historia-info p {
    font-size: 16px;
    color: #FFD700;
}

/* No Sites Message */
.no-sites {
    font-size: 20px;
    color: red;
    font-weight: bold;
    margin-top: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .historia-container {
        flex-direction: column;
        align-items: center;
    }

    .historia-card {
        width: 90%;
    }
}
</style>

</body>
</html>
