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

$whereClause = "1=1";
if (isset($_GET['price'])) {
    $priceRange = explode("-", $_GET['price']);
    $whereClause .= " AND price BETWEEN {$priceRange[0]} AND {$priceRange[1]}";
}

if (isset($_GET['features'])) {
    $facilities = explode(",", $_GET['features']);
    foreach ($facilities as $facility) {
        $whereClause .= " AND facilities LIKE '%$facility%'";
    }
}

if (isset($_GET['dateFrom']) && isset($_GET['dateTo'])) {
    $dateFrom = $_GET['dateFrom'];
    $dateTo = $_GET['dateTo'];

 $sql .= " AND available_from <= '$dateTo' AND available_to >= '$dateFrom'";
}
 $sql = "SELECT * FROM rooms WHERE $whereClause";
$result = $conn->query($sql); 

if ($result->num_rows == 0) {
    echo "<p class='no-rooms-message'>No rooms available as per your requirements.</p>";
} else {
    // Display rooms if available
    while ($row = $result->fetch_assoc()) {
        echo "<div class='room-card'>
                <img src='{$row['image']}' alt='{$row['room_name']}'>
                <h3>{$row['room_name']}</h3>
                <p><strong>Location:</strong> {$row['location']}</p>
                <p><strong>Price:</strong> ₹{$row['price']}</p>
                <p><strong>Features:</strong></p>
                <ul>";
        $features = explode(',', $row['features']); // Assuming features are stored as comma-separated values
        foreach ($features as $feature) {
            echo "<li>$feature</li>";
        }
        echo "</ul>
                <p><strong>Available:</strong> {$row['available_from']} to {$row['available_to']}</p>
                <a href='room_details.php?id={$row['id']}' class='btn'>View Details</a>
              </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rooms - Hind Historia</title>
    <link rel="stylesheet" href="styles.css">
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

    <div class="container">
        <!-- Filter Sidebar -->
        <aside class="filter-sidebar">
            <h2>Filter</h2>

            <label>Price Range:</label>
            <input type="range" id="priceRange" min="300" max="5000" step="100">
            <p>₹ <span id="priceValue">300</span> - ₹5000</p>

            <label>Facilities:</label>
            <div class="facility-checkboxes">
                <label><input type="checkbox" value="WiFi"> WiFi</label>
                <label><input type="checkbox" value="Breakfast"> Breakfast</label>
                <label><input type="checkbox" value="Pool"> Pool</label>
                <label><input type="checkbox" value="Gym"> Gym</label>
                <label><input type="checkbox" value="Parking"> Parking</label>
            </div>

            <label for="dateFrom">Available From:</label>
            <input type="date" id="dateFrom" name="dateFrom">
    
            <label for="dateTo">Available To:</label>
            <input type="date" id="dateTo" name="dateTo">

            <button onclick="applyFilters()">Apply Filters</button>
        </aside>
        <style>/* Filter Sidebar */
.filter-sidebar {
    width: 250px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    height: fit-content;
    position: sticky;
    top: 20px;
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

/* Date Pickers */
.filter-sidebar input[type="date"] {
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

/* Responsive Design */
@media (max-width: 768px) {
    .filter-sidebar {
        width: 100%;
        text-align: center;
        position: relative;
    }
}
</style>


        <!-- Rooms Grid -->
        <section class="rooms-grid" id="roomsContainer">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="room-card" onclick="window.location.href='room_details.php?id=<?= $row['id'] ?>'">
                    <img src="<?= $row['image'] ?>" alt="Room Image">
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
<style>
/* Rooms Grid */
.rooms-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    padding: 20px;
}

/* Room Card */
.room-card {
    width: 280px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    text-align: center;
    transition: transform 0.3s ease-in-out;
    cursor: pointer;
    border: 2px solid #D2691E;
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

/* Responsive Design */
@media (max-width: 768px) {
    .rooms-grid {
        flex-direction: column;
        align-items: center;
    }
    
    .room-card {
        width: 90%;
    }
}
</style>

<script>
    // Update price range value
    document.getElementById("priceRange").addEventListener("input", function() {
        document.getElementById("priceValue").innerText = this.value;
    });

    function applyFilters() {
        let price = document.getElementById("priceRange").value;
        let facilities = [];
        document.querySelectorAll('.facility-checkboxes input:checked').forEach((checkbox) => {
            facilities.push(checkbox.value);
        });

        let query = `rooms.php?price=300-${price}`;
        if (facilities.length > 0) {
            query += `&facilities=${facilities.join(",")}`;
        }

        window.location.href = query;
    }
</script>

<style>
</style>
</body>
</html>
