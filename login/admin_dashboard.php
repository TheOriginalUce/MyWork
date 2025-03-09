<?php
include("db.php");
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

// Handle Room Addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_room'])) {
    $room_name = $_POST['room_name'];
    $features = $_POST['features'];  // Features stored as comma-separated values
    $price = $_POST['price'];
    $image = $_POST['image'];
    $location = $_POST['location'];
    $available_from = $_POST['available_from'];
    $available_to = $_POST['available_to'];

    $sql = "INSERT INTO rooms (room_name, features, price, image, location, available_from, available_to) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissss", $room_name, $features, $price, $image, $location, $available_from, $available_to);

    if ($stmt->execute()) {
        echo "<script>alert('Room added successfully!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}


// Fetch existing rooms
$roomsResult = $conn->query("SELECT room_name FROM rooms");
// Handle room description submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["room_name"]) && isset($_POST["room_description"])) {
    $room_name = $conn->real_escape_string($_POST["room_name"]);
    $description = $conn->real_escape_string($_POST["room_description"]);

    // Check if a description already exists
    $checkQuery = $conn->query("SELECT * FROM room_descriptions WHERE room_name = '$room_name'");
    
    if ($checkQuery->num_rows > 0) {
        // Update existing description
        $sql = "UPDATE room_descriptions SET description = '$description' WHERE room_name = '$room_name'";
    } else {
        // Insert new description
        $sql = "INSERT INTO room_descriptions (room_name, description) VALUES ('$room_name', '$description')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Room description saved successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}


// Handle file upload for homepage carousel
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["carousel_image"])) {
    if (!empty($_FILES["carousel_image"]["name"])) {
        $image_name = $_FILES["carousel_image"]["name"];
        $image_tmp_name = $_FILES["carousel_image"]["tmp_name"];
        $image_path = "uploads/" . basename($image_name);

        if (move_uploaded_file($image_tmp_name, $image_path)) {
            $stmt = $conn->prepare("INSERT INTO homepage_carousel (image_path) VALUES (?)");
            $stmt->bind_param("s", $image_path);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('Image uploaded successfully!');</script>";
        } else {
            echo "<script>alert('Error uploading image.');</script>";
        }
    }
}
// Fetch all carousel images
$carousel_images = [];
$result = $conn->query("SELECT * FROM homepage_carousel ORDER BY id DESC");
while ($row = $result->fetch_assoc()) {
    $carousel_images[] = $row["image_path"];
}


// Handle section switching
$section = isset($_GET["section"]) ? $_GET["section"] : "rooms";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hind Historia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header class="hind-historia-header">
        <div class="header-container">
            <a href="index.html">
                <img src="logo.png" alt="Hind Historia Logo" class="logo">
            </a>
            <h1 class="site-title">Hind-Historia</h1>
        </div>
    </header>
    <style>
        .hind-historia-header {
            background: linear-gradient(to right, #4e342e, #3e2723);
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid #FFD700;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        }
    
        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    
        .logo {
            width: 60px;
            margin-right: 15px;
        }
    
        .site-title {
            font-family: 'Cinzel', serif;
            font-size: 30px;
            color: #FFD700;
            text-shadow: 2px 2px 6px rgba(255, 215, 0, 0.8);
        }
    </style>
    

    <!-- Navigation Bar -->
    <nav>
    <ul>
        <li><a href="admin_dashboard.php?section=rooms">
            <i class="fas fa-bed nav-icon"></i> Room Settings
        </a></li>
        <li><a href="admin_dashboard.php?section=homepage">
            <i class="fas fa-home nav-icon"></i> Homepage Settings
        </a></li>
        <li><a href="admin_dashboard.php?section=description">
            <i class="fas fa-file-alt"></i> Room Descriptions
        </a></li> 
        <li><a href="admin_dashboard.php?section=historia"><i class="fas fa-landmark"></i> Historia</a></li>
        <li><a href="admin_dashboard.php?section=historia_detail"><i class="fas fa-scroll"></i> Historia Detail</a></li>
        <li><a href="logout.php">
        <i class="fas fa-sign-out-alt nav-icon"></i> Logout
        </a></li>
    </ul>
</nav>

<!-- Font Awesome Link (Required for Icons) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<div class="admin-container">
    <?php if ($section === "rooms") { ?>
        <h2>Manage Rooms</h2>
        <form action="admin_dashboard.php?section=rooms" method="POST">
    <label>Room Name:</label>
    <input type="text" name="room_name" required>

    <label>Features (Separate by commas):</label>
    <textarea name="features" required></textarea>

    <label>Price (INR):</label>
    <input type="number" name="price" required>

    <label>Upload image:</label>
    <input type="text" name="image" placeholder="Add image" required>

    <label>Location (City in India):</label>
    <input type="text" name="location" required>

    <label>Available From:</label>
    <input type="date" name="available_from" required>

    <label>Available To:</label>
    <input type="date" name="available_to" required>

    <button type="submit" name="add_room">Add Room</button>
</form>
    

    <?php } elseif ($section === "homepage") { ?>
        <h2>Upload Carousel Image</h2>
        <form action="admin_dashboard.php?section=homepage" method="POST" enctype="multipart/form-data">
            <input type="file" name="carousel_image" required>
            <button type="submit">Upload Image</button>
        </form>

        <h2>Current Homepage Carousel</h2>
        <div class="carousel-container">
            <?php foreach ($carousel_images as $img) { ?>
                <img src="<?php echo $img; ?>" class="carousel-image">
            <?php } ?>
        </div>
    <?php } ?>
</div>

        <!-- Room Description -->
<div class="manage-room-descriptions">
<?php if (isset($_GET['section']) && $_GET['section'] == "description") { ?>
    <h2>Manage Room Descriptions</h2>
    <form action="admin_dashboard.php?section=description" method="POST">
        
<?php
        // Fetch existing rooms
    $roomsResult = $conn->query("SELECT room_name FROM rooms");

    if (!$roomsResult) {
    die("Error fetching rooms: " . $conn->error);
    }

    //Print the fetched room names
    echo "<p>Fetched Rooms:</p><ul>";
    while ($room = $roomsResult->fetch_assoc()) {
    echo "<li>" . htmlspecialchars($room['room_name']) . "</li>";
    }
    echo "</ul>";
?>
   <label for ="room_name">Select Room:</label>
   <select name="room_name" required>
    <option value="">-- Select a Room --</option><br>
    <?php
    $roomsResult = $conn->query("SELECT room_name FROM rooms");
    while ($room = $roomsResult->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($room['room_name']) . '">' . htmlspecialchars($room['room_name']) . '</option>';
    }
    ?>
    </select><br><br>
        <label for="room_description">Room Description:</label>
        <br><textarea name="room_description" rows="5" required placeholder="Enter room description here..."></textarea>
        <br><br><button type="submit">Save Description</button>
    </form>
<?php } ?>
</div>

<style>
/* Hind Historia Styling for Manage Room Descriptions */
.manage-room-descriptions {
    background: linear-gradient(to bottom, #3E2723, #4E342E); /* Rich Brown Gradient */
    color: #FFD700; /* Gold Text */
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
    width: 80%;
    margin: 30px auto;
    text-align: center;
    font-family: 'Cinzel', serif;
    border: 2px solid #D4AF37;
}

.manage-room-descriptions h2 {
    font-size: 26px;
    font-weight: bold;
    text-shadow: 2px 2px 6px rgba(255, 215, 0, 0.8);
    margin-bottom: 15px;
    color: #FFD700;
}

.manage-room-descriptions form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: rgba(255, 215, 0, 0.1);
    border: 2px solid #D4AF37;
    border-radius: 8px;
    box-shadow: 0px 2px 5px rgba(255, 215, 0, 0.3);
    width: 90%;
    margin: auto;
}

.manage-room-descriptions label {
    font-weight: bold;
    font-size: 16px;
    color: #FFD700;
    text-align: left;
    width: 100%;
    display: block;
}

.manage-room-descriptions select,
.manage-room-descriptions textarea {
    width: 100%;
    padding: 12px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background: #fff;
}

.manage-room-descriptions textarea {
    height: 120px;
    resize: vertical;
}

.manage-room-descriptions button {
    background: #D4AF37;
    color: #3E2723;
    font-size: 16px;
    font-weight: bold;
    padding: 12px 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.manage-room-descriptions button:hover {
    background: #FFD700;
    transform: scale(1.05);
    box-shadow: 0px 0px 10px rgba(255, 215, 0, 0.8);
}

/* Responsive Design */
@media (max-width: 768px) {
    .manage-room-descriptions {
        width: 95%;
    }

    .manage-room-descriptions form {
        width: 100%;
    }
}
    </style>

<!-- Historia Section -->
 <div class="historia-management">
<?php
if (isset($_GET['section']) && $_GET['section'] == "historia") { ?>
    <h2>Manage Historia</h2>
    <form method="POST" action="add_historia.php" enctype="multipart/form-data">
        <label>Site Name:</label>
        <input type="text" name="site_name" required>
        
        <label>Location:</label>
        <input type="text" name="location" required>
        
        <label>Upload Image:</label>
        <input type="file" name="image" accept="image/*" required>
        
        <button type="submit">Add Historia</button>
    </form>

    <h3>Existing Historical Sites</h3>
    <table>
        <tr><th>Site Name</th><th>Location</th><th>Image</th><th>Action</th></tr>
        <?php
        include("db.php"); 
        $result = $conn->query("SELECT * FROM historia");
        while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['site_name']) ?></td>
                <td><?= htmlspecialchars($row['location']) ?></td>
                <td><img src="<?= htmlspecialchars($row['image']) ?>" width="80"></td>
                <td>
                    <a href="delete_historia.php?site_name=<?= urlencode($row['site_name']) ?>" onclick="return confirm('Delete this site?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>
</div>

<?php
if (isset($_GET['section']) && $_GET['section'] == "historia_detail") { ?>
    <h2>Add Historia Details</h2>
    <form method="POST" action="add_historia_detail.php" enctype="multipart/form-data" class="historia-form">
        <label>Select Site:</label>
        <select name="site_name" required>
            <option value="">Select Site</option>
            <?php
            $result = $conn->query("SELECT site_name FROM historia");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . htmlspecialchars($row['site_name']) . "'>" . htmlspecialchars($row['site_name']) . "</option>";
            }
            ?>
        </select>

        <label>Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <label>Upload Multiple Images:</label>
        <input type="file" name="images[]" accept="image/*" multiple required>

        <label>Latitude:</label>
        <input type="text" name="latitude" required>

        <label>Longitude:</label>
        <input type="text" name="longitude" required>

        <button type="submit">Add Details</button>
    </form>

    <h3>Existing Details</h3>
    <table>
        <tr><th>Site Name</th><th>Description</th><th>Images</th><th>Action</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM historia_detail");
        while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['site_name']) ?></td>
                <td><?= htmlspecialchars(substr($row['description'], 0, 100)) ?>...</td>
                <td>
                    <?php 
                    $images = explode(',', $row['images']);
                    foreach ($images as $img) { 
                        echo "<img src='$img' width='50'>";
                    } 
                    ?>
                </td>
                <td>
                    <a href="delete_historia_detail.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this description?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>
    
    <style>
/* Hind Historia Styling for Historia Sections */
.historia-management, .historia-details-management {
    background: linear-gradient(to bottom, #3E2723, #4E342E); /* Deep Brown Gradient */
    color: #FFD700; /* Gold Text */
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
    width: 90%;
    margin: 30px auto;
    text-align: center;
    font-family: 'Cinzel', serif;
    border: 2px solid #D4AF37;
}

.historia-management h2, .historia-details-management h2 {
    font-size: 26px;
    font-weight: bold;
    text-shadow: 2px 2px 6px rgba(255, 215, 0, 0.8);
    margin-bottom: 15px;
    color: #FFD700;
}

.historia-management form, .historia-details-management form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: rgba(255, 215, 0, 0.1);
    border: 2px solid #D4AF37;
    border-radius: 8px;
    box-shadow: 0px 2px 5px rgba(255, 215, 0, 0.3);
    width: 80%;
    margin: auto;
}

.historia-management label, .historia-details-management label {
    font-weight: bold;
    font-size: 16px;
    color: #FFD700;
    text-align: left;
    width: 100%;
    display: block;
}

.historia-management input,
.historia-management select,
.historia-management textarea,
.historia-details-management input,
.historia-details-management select,
.historia-details-management textarea {
    width: 100%;
    padding: 12px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background: #fff;
}

.historia-management textarea, .historia-details-management textarea {
    height: 120px;
    resize: vertical;
}

.historia-management button, .historia-details-management button {
    background: #D4AF37;
    color: #3E2723;
    font-size: 16px;
    font-weight: bold;
    padding: 12px 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.historia-management button:hover, .historia-details-management button:hover {
    background: #FFD700;
    transform: scale(1.05);
    box-shadow: 0px 0px 10px rgba(255, 215, 0, 0.8);
}

/* Table Styling */
.historia-management table, .historia-details-management table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    background: #fff;
    color: #3E2723;
}

.historia-management th, .historia-details-management th {
    background: #D4AF37;
    color: #3E2723;
    padding: 10px;
    border: 1px solid #3E2723;
}

.historia-management td, .historia-details-management td {
    padding: 8px;
    border: 1px solid #3E2723;
}

.historia-management img, .historia-details-management img {
    border-radius: 5px;
    border: 2px solid #D4AF37;
    transition: transform 0.3s ease-in-out;
}

.historia-management img:hover, .historia-details-management img:hover {
    transform: scale(1.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    .historia-management, .historia-details-management {
        width: 95%;
    }

    .historia-management form, .historia-details-management form {
        width: 100%;
    }

    .historia-management table, .historia-details-management table {
        font-size: 14px;
    }

    .historia-management img, .historia-details-management img {
        width: 40px;
    }
}
    </style>

    <style>
        /* General Page Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

        /* Navigation Bar */
        nav {
    background: #3E2723;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    gap: 20px;
}

nav ul li {
    display: inline-block;
}

nav ul li a {
    text-decoration: none;
    color: white;
    font-size: 16px;
    font-weight: bold;
    padding: 10px 15px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease-in-out;
    border-radius: 5px;
}

nav ul li a:hover {
    background: #FFD700;
    color: #3E2723;
    transform: scale(1.1);
}

/* Icons */
.nav-icon {
    font-size: 18px;
    color: white;
}

nav ul li a:hover .nav-icon {
    color: #FFD700;
}

/* Admin Panel Section */
.admin-panel {
    width: 50%;
    margin: 40px auto;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

.admin-panel h2 {
    text-align: center;
    font-size: 24px;
    color: #3E2723;
}

.admin-panel form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.admin-panel label {
    font-weight: bold;
    color: #3E2723;
}

.admin-panel input, 
.admin-panel textarea {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
}

.admin-panel textarea {
    height: 80px;
}

.admin-panel button {
    background: #3E2723;
    color: white;
    font-size: 18px;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.admin-panel button:hover {
    background: #FFD700;
    color: #3E2723;
}

/* Room List */
.room-list {
    text-align: center;
    margin-top: 30px;
}

.rooms-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

/* Room Cards */
.room-card {
    background: white;
    padding: 15px;
    border-radius: 10px;
    border: 1px solid #ccc;
    width: 250px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    transition: 0.3s;
}

.room-card:hover {
    transform: scale(1.05);
}

.room-card img {
    width: 100%;
    border-radius: 10px;
}

.room-card h3 {
    margin-top: 10px;
    font-size: 18px;
    color: #3E2723;
}

.room-card p {
    margin: 5px 0;
    font-size: 14px;
    color: #555;
}

        /* Room Cards */
.room-list {
    text-align: center;
}

.rooms-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.room-card {
    background: white;
    padding: 15px;
    border-radius: 10px;
    border: 1px solid #ccc;
    width: 250px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
}

.room-card img {
    width: 100%;
    border-radius: 10px;
}

.room-card h3 {
    margin-top: 10px;
    font-size: 18px;
}

.room-card p {
    margin: 5px 0;
    font-size: 14px;
}

/* Homepage Carousel */

/* Carousel */
.carousel-container {
    display: flex;
    overflow-x: auto;
    gap: 10px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background: white;
    margin-top: 20px;
}

.carousel-image {
    width: 200px;
    height: 120px;
    border-radius: 10px;
    object-fit: cover;
} 

/* Admin Container */
.admin-container {
    width: 80%;
    margin: 30px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

/* Headings */
.admin-container h2 {
    color: #3E2723;
    font-size: 24px;
    margin-bottom: 15px;
}

/* Forms */
.admin-container form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    padding: 15px;
    border: 2px solid #D4AF37;
    background: rgba(255, 215, 0, 0.1);
    border-radius: 8px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    width: 60%;
    margin: auto;
}

/* Labels */
.admin-container label {
    font-weight: bold;
    color: #3E2723;
}

/* Inputs & Textarea */
.admin-container input,
.admin-container textarea {
    width: 80%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

/* Submit Buttons */
.admin-container button {
    background: #D4AF37;
    color: #3E2723;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

.admin-container button:hover {
    background: #FFD700;
    transform: scale(1.1);
}

/* Carousel Container */
.carousel-container {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
    padding: 15px;
    border-radius: 8px;
    border: 2px solid #3E2723;
    background: rgba(255, 215, 0, 0.1);
}

/* Carousel Images */
.carousel-image {
    width: 150px;
    height: 100px;
    border-radius: 8px;
    border: 2px solid #D4AF37;
    transition: transform 0.3s ease-in-out;
}

.carousel-image:hover {
    transform: scale(1.1);
    box-shadow: 0px 0px 10px rgba(255, 215, 0, 0.8);
}

/* Responsive Design */
@media (max-width: 768px) {
    .admin-container form {
        width: 90%;
    }

    .carousel-container {
        flex-wrap: wrap;
    }

    .carousel-image {
        width: 120px;
        height: 80px;
    }
}

    </style>

    <style>
.historia-form {
    background: linear-gradient(to bottom, #3E2723, #4E342E); /* Deep Brown Gradient */
    color: #FFD700; /* Gold Text */
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
    width: 80%;
    margin: 30px auto;
    text-align: center;
    font-family: 'Cinzel', serif;
    border: 2px solid #D4AF37;
}

.historia-form h2 {
    font-size: 26px;
    font-weight: bold;
    text-shadow: 2px 2px 6px rgba(255, 215, 0, 0.8);
    margin-bottom: 15px;
    color: #FFD700;
}

.historia-form label {
    font-weight: bold;
    font-size: 16px;
    color: #FFD700;
    text-align: left;
    width: 100%;
    display: block;
    margin-bottom: 5px;
}

.historia-form select,
.historia-form textarea,
.historia-form input {
    width: 100%;
    padding: 12px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background: #fff;
    margin-bottom: 10px;
}

.historia-form textarea {
    height: 120px;
    resize: vertical;
}

.historia-form button {
    background: #D4AF37;
    color: #3E2723;
    font-size: 16px;
    font-weight: bold;
    padding: 12px 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.historia-form button:hover {
    background: #FFD700;
    transform: scale(1.05);
    box-shadow: 0px 0px 10px rgba(255, 215, 0, 0.8);
}

/* Responsive Design */
@media (max-width: 768px) {
    .historia-form {
        width: 95%;
    }
}
    </style>

</body>
</html>
