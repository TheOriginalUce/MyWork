<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Hind Historia</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General Page Styling */
        body {
            font-family: 'Cinzel', serif;
            background: linear-gradient(to right, #4e342e, #3e2723);
            color: white;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* About Section */
        .about-container {
            width: 80%;
            margin: 50px auto;
            padding: 30px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            border: 2px solid #D4AF37;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.6);
        }

        .about-container h1 {
            font-size: 32px;
            text-shadow: 2px 2px 6px rgba(255, 215, 0, 0.8);
        }

        .about-container p {
            font-size: 18px;
            line-height: 1.6;
            color: #FFD700;
        }

        /* Navigation Button */
        .nav-button {
            display: inline-block;
            margin: 20px auto;
            padding: 12px 25px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            color: #3e2723;
            background-color: #FFD700;
            border-radius: 5px;
            transition: 0.3s ease-in-out;
        }

        .nav-button:hover {
            background-color: #D4AF37;
            box-shadow: 0px 0px 10px rgba(255, 215, 0, 1);
        }

        /* Why Us Section */
        .why-us {
            margin: 50px auto;
            width: 80%;
            padding: 30px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            border: 2px solid #FFD700;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.6);
        }

        .why-us h2 {
            font-size: 28px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 6px rgba(255, 215, 0, 0.8);
        }

        .features-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .feature-box {
            width: 200px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            border: 2px solid #FFD700;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            transition: transform 0.3s ease-in-out;
        }

        .feature-box:hover {
            transform: scale(1.1);
            box-shadow: 0px 0px 10px rgba(255, 215, 0, 1);
        }

        /* Copyright Section */
        .copyright {
            margin-top: 50px;
            padding: 10px;
            font-size: 16px;
            background: #3e2723;
            color: #FFD700;
            border-top: 2px solid #D4AF37;
        }
    </style>
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

    <!-- About Section -->
    <div class="about-container">
        <h1>About Hind Historia</h1>
        <p>Hind Historia is your ultimate guide to exploring India's rich heritage. 
            Our platform allows you to discover detailed historical site information, 
            book hotel at the very own Hind-Historia Hotels</p>
        <a href="homepage.php" class="nav-button">Back to Homepage</a>
    </div>

    <!-- Why Us Section -->
    <div class="why-us">
        <h2>Why Choose Us?</h2>
        <div class="features-container">
            <div class="feature-box">🏨 Quick Hotel Booking</div>
            <div class="feature-box">📜 Details About Historical Sites</div>
            <div class="feature-box">🌟 Amazing Reviews</div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="copyright">
        &copy; 2024 Hind Historia. All Rights Reserved.
    </div>

</body>
</html>
