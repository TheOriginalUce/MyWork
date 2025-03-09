<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    die("You must be logged in to view this page.");
}

$email = $_SESSION['email'];

// Fetch user details
$user_query = "SELECT fname, lname, email, profile_pic FROM users WHERE email = '$email'";
$user_result = $conn->query($user_query);
$user = $user_result->fetch_assoc();

// Profile Picture Upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_pic"])) {
    $target_dir = "uploads/";
    $image_name = basename($_FILES["profile_pic"]["name"]);
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        $update_query = "UPDATE users SET profile_pic = '$target_file' WHERE email = '$email'";
        $conn->query($update_query);
        header("Location: user_profile.php"); // Refresh page after upload
    } else {
        echo "Error uploading image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Hind Historia</title>
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

<!-- User Profile Section -->
<div class="user-profile-container">
    <h2>Hello, <?= htmlspecialchars($user['fname']) ?>! Have a great and safe trip! 😊</h2>

    <!-- Profile Picture -->
    <div class="profile-picture">
        <img src="<?= $user['profile_pic'] ?: 'default-profile.png' ?>" alt="Profile Picture">
    </div>

    <!-- User Details -->
    <p><strong>Full Name:</strong> <?= htmlspecialchars($user['fname'] . " " . $user['lname']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

    <!-- Profile Picture Upload Form -->
    <form action="user_profile.php" method="POST" enctype="multipart/form-data">
        <label for="profile_pic">Upload Profile Picture:</label>
        <input type="file" name="profile_pic" required>
        <button type="submit">Upload</button>
    </form>
</div>

<br><br><form action="logout.php" method="POST">
    <button type="submit" class="logout-btn">Logout</button>
</form>


<style>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap');

body {
    font-family: 'Cinzel', serif;
    background: #f5f5f5;
    margin: 0;
    padding: 0;
}

/* User Profile Section */
.user-profile-container {
    max-width: 500px;
    margin: 30px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.user-profile-container h2 {
    font-size: 22px;
    color: #D2691E;
}

/* Profile Picture */
.profile-picture img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 3px solid #D4AF37;
    object-fit: cover;
}

/* User Details */
.user-profile-container p {
    font-size: 16px;
    color: #444;
    margin: 10px 0;
}

/* Upload Form */
.user-profile-container form {
    margin-top: 15px;
}

.user-profile-container input[type="file"] {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 10px;
}

/* Upload Button */
.user-profile-container button {
    background: #D2691E;
    color: white;
    border: none;
    padding: 10px 15px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

.user-profile-container button:hover {
    background: #8B4513;
}

.logout-btn {
    background: #D2691E; /* Brown */
    color: white;
    border: none;
    padding: 10px 15px;
    font-size: 16px;
    cursor: pointer;
    position: center;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

.logout-btn:hover {
    background: #8B4513; /* Darker Brown */
}

</style>

</body>
</html>
