<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Base WHERE clause
$whereClause = "1=1";

// Filter by price range
if (isset($_GET['minPrice']) && isset($_GET['maxPrice']) && !empty($_GET['minPrice']) && !empty($_GET['maxPrice'])) {
    $minPrice = (int)$_GET['minPrice'];
    $maxPrice = (int)$_GET['maxPrice'];
    $whereClause .= " AND price BETWEEN $minPrice AND $maxPrice";
}
if (isset($_GET['facilities']) && !empty($_GET['facilities'])) {
    $facilities = explode(",", $_GET['facilities']);
    $facilitiesConditions = [];
    foreach ($facilities as $facility) {
        $facilitiesConditions[] = "features LIKE '%$facility%'";
    }
    $whereClause .= " AND (" . implode(" OR ", $facilitiesConditions) . ")";
}

// Filter by available dates (if set)
if (!empty($_GET['dateFrom']) && !empty($_GET['dateTo'])) {
    $dateFrom = $_GET['dateFrom'];
    $dateTo = $_GET['dateTo'];
    $whereClause .= " AND available_from <= '$dateTo' AND available_to >= '$dateFrom'";
}

// Fetch filtered rooms from database
$sql = "SELECT * FROM rooms WHERE $whereClause";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms - Hind Historia</title>
    <link rel="stylesheet" href="style.css">
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

    <h3 style="
    font-family: 'Cinzel', serif; 
    font-size: 28px; 
    font-weight: bold; 
    color: white; 
    text-align: center; 
    text-transform: uppercase; 
    padding: 15px 30px;
    background: linear-gradient(135deg, rgba(165,42,42,0.9), rgba(218,165,32,0.9)); 
    border-radius: 10px;
    box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.3);
    border: 2px solid rgba(255, 215, 0, 0.8);
    display: inline-block;"    >
    Book Rooms At Your Very Own Hind-Historia
</h3>
<div class="container">
    <!-- Filter Sidebar -->
    <aside class="filter-sidebar">
        <h2>Filter</h2>

        <label>Price Range:</label>
<div class="price-inputs">
    <input type="number" id="minPrice" placeholder="Min ₹" min="300" max="5000">
    <span> - </span>
    <input type="number" id="maxPrice" placeholder="Max ₹" min="300" max="5000">
</div>

        <label>Facilities:</label>
        <div class="facility-checkboxes">
            <label><input type="checkbox" value="WiFi"> WiFi</label>
            <label><input type="checkbox" value="Food"> Food</label>
            <label><input type="checkbox" value="Pool"> Pool</label>
            <label><input type="checkbox" value="Gym"> Gym</label>
            <label><input type="checkbox" value="Parking"> Parking</label>
            <label><input type="checkbox" value="1 Bed"> 1 Bed</label>
            <label><input type="checkbox" value="2 Beds"> 2 Beds</label>
            <label><input type="checkbox" value="3"> 3 Beds</label>
        </div>

        <!-- Date Selector -->
        <div class="date-selector">
            <label>Available From:</label>
            <input type="date" id="dateFrom">
            <label>Available To:</label>
            <input type="date" id="dateTo">
        </div>

        <button onclick="applyFilters()">Apply Filters</button>
    </aside>

    <!-- Rooms Grid -->
    <section class="rooms-container">
        <?php 
        if ($result->num_rows == 0) {
            echo "<p class='no-rooms-message'>No rooms available within this price range.</p>";
        } else {
            while ($row = $result->fetch_assoc()) { ?>
                <a href="room_details.php?room_name=<?= urlencode($row['room_name']) ?>" class="room-link">
                    <div class="room-card">
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="Room Image" 
                    onerror="this.onerror=null; this.src='default.jpg';">
                    <h3><?= $row['room_name'] ?></h3>
                        <p><strong>Location:</strong> <?= $row['location'] ?></p>
                        <p><strong>Price:</strong> ₹<?= $row['price'] ?> / night</p>
                        <p><strong>Facilities:</strong></p>
                        <ul>
                            <?php foreach (explode(",", $row['features']) as $facility) { ?>
                                <li><?= trim($facility) ?></li>
                            <?php } ?>
                        </ul>
                        <p><strong>Available:</strong> <?= date("d M", strtotime($row['available_from'])) ?> - <?= date("d M", strtotime($row['available_to'])) ?></p>
                    </div>
                </a>
                <?php } 
        } ?>
    </section>

    <section class="rooms-grid" id="roomsContainer">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="room-card" onclick="window.location.href='room_details.php?id=<?= $row['id'] ?>'">
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="Room Image" 
            onerror="this.onerror=null; this.src='default.jpg';">
                <h3><?= $row['room_name'] ?></h3>
                <p><strong>Location:</strong> <?= $row['location'] ?></p>
                <p><strong>Price:</strong> ₹<?= $row['price'] ?> / night</p>
                <p><strong>Facilities:</strong></p>
                <ul>
                    <?php foreach (explode(",", $row['features']) as $facility) { ?>
                        <li><?= trim($facility) ?></li>
                    <?php } ?>
                </ul>
                <p><strong>Available:</strong> <?= date("d M", strtotime($row['available_from'])) ?> - <?= date("d M", strtotime($row['available_to'])) ?></p>
            </div>
        <?php } ?>
    </section>
</div>

<script>
function applyFilters() {
    let minPrice = document.getElementById("minPrice").value;
    let maxPrice = document.getElementById("maxPrice").value;
    let facilities = [];
    document.querySelectorAll('.facility-checkboxes input:checked').forEach((checkbox) => {
        facilities.push(checkbox.value);
    });

    let dateFrom = document.getElementById("dateFrom").value;
    let dateTo = document.getElementById("dateTo").value;

    // Build query parameters
    let query = `rooms.php?`;

    if (minPrice !== "" && maxPrice !== "") {
    query += `minPrice=${minPrice}&maxPrice=${maxPrice}`;
    }
    
    if (facilities.length > 0) {
        query += `&facilities=${facilities.join(",")}`;
    }
    
    if (dateFrom && dateTo) {
        query += `&dateFrom=${dateFrom}&dateTo=${dateTo}`;
    }
    
    window.location.href = query; // Redirect with the filters applied
}
</script>

<style>
    /* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background: #f5f5f5;
    margin: 0;
    padding: 0;
}

/* Container Layout */
.container {
    display: flex;
    gap: 20px;
    padding: 20px;
}

/* Filter Sidebar */
.filter-sidebar {
    width: 250px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.filter-sidebar h2 {
    margin-bottom: 15px;
    text-align: center;
}

.filter-sidebar label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

.facility-checkboxes {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.filter-sidebar button {
    width: 100%;
    padding: 10px;
    background: #d4a017;
    color: white;
    border: none;
    margin-top: 15px;
    cursor: pointer;
    border-radius: 5px;
}

.filter-sidebar button:hover {
    background: #b3860b;
}

/* Rooms Grid */
.rooms-grid {
    
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.rooms-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Ensures responsive grid */
    gap: 20px;
    padding: 20px;
    justify-content: center;
    align-items: stretch; /* Ensures all cards stretch to fill the grid */
}

/* Fix issue where filtered items collapse */
.room-card {
    min-width: 300px; 
    height: auto; 
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.room-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-bottom: 2px solid #D2691E;
}

.room-card h3 {
    font-size: 20px;
    margin: 10px 0;
    color: #D2691E;
    font-weight: bold;
}

.room-card ul {
    list-style-type: none;
    padding: 0;
    margin: 5px 0;
}

.room-card ul li {
    font-size: 13px;
    color: #666;
    padding: 3px 0;
}

.room-card p {
    font-size: 14px;
    color: #444;
    margin: 5px 0;
}

.room-card:hover {
    transform: scale(1.05);
}

.container {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    padding: 20px;
    margin-top: 80px;
}

/* Filter Sidebar */
.filter-sidebar {
    width: 250px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 80px;
    border: 2px solid #D2691E;
}

/* Sidebar Heading */
.filter-sidebar h2 {
    text-align: center;
    font-size: 22px;
    margin-bottom: 15px;
    color: #333;
    font-weight: bold;
    border-bottom: 2px solid #D2691E;
    padding-bottom: 10px;
}

/* Filter Labels */
.filter-sidebar label {
    font-weight: bold;
    display: block;
    margin-top: 15px;
    color: #444;
}

/* Price Range Input */
.filter-sidebar input[type="range"] {
    width: 100%;
    margin-top: 5px;
}

/* Facilities Checkboxes */
.facility-checkboxes {
    display: flex;
    flex-direction: column;
    gap: 5px;
    margin-top: 5px;
}

.facility-checkboxes label {
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    padding: 5px;
    transition: background 0.3s ease-in-out;
    border-radius: 5px;
}

.facility-checkboxes input[type="checkbox"] {
    accent-color: #D2691E;
}

/* Date Selectors */
.date-selector {
    margin-top: 10px;
}

.price-inputs {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 5px;
}

.price-inputs input {
    width: 45%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.date-selector input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 5px;
}

/* Apply Filters Button */
.filter-sidebar button {
    width: 100%;
    background: #D2691E;
    color: white;
    border: none;
    padding: 12px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
    font-weight: bold;
}

.filter-sidebar button:hover {
    background: #8B4513;
}

/* Rooms Grid */


.rooms-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Centers content */
    gap: 20px; /* Space between cards */
    padding: 20px;
}

/* Room Card */
.room-card {
    width: calc(33.33% - 20px); /* 3 cards per row */
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
    cursor: pointer;
    border: 2px solid #D2691E;
    padding: 15px;
    box-sizing: border-box;
}

.room-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
}

/* Room Image */
.room-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-bottom: 2px solid #D2691E;
}

/* Room Details */
.room-card h3 {
    font-size: 20px;
    margin: 15px 0;
    color: #D2691E;
    font-weight: bold;
}

.room-card p {
    font-size: 14px;
    color: #444;
    margin: 5px 0;
}

/* Facilities List */
.room-card ul {
    list-style-type: none;
    padding: 0;
}

.room-card ul li {
    font-size: 13px;
    color: #666;
    padding: 3px 0;
}

/* No Rooms Message */
.no-rooms-message {
    font-size: 18px;
    color: red;
    text-align: center;
    font-weight: bold;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        align-items: center;
    }

    @media (max-width: 1024px) {
    .rooms-container {
        grid-template-columns: repeat(2, 1fr); /* 2 per row on medium screens */
    }
}

@media (max-width: 768px) {
    .rooms-container {
        grid-template-columns: repeat(1, 1fr); /* 1 per row on mobile */
    }
}

    .filter-sidebar {
        width: 100%;
        position: relative;
    }

    .rooms-grid {
        grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
    }
}
</style>

</body>
</html>

