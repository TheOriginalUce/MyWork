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

// Ensure user is logged in
if (!isset($_SESSION['email'])) {
    die("Unauthorized access!");
}

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $rating = intval($_POST['rating']);
    $review_text = $conn->real_escape_string($_POST['review_text']);

    $query = "INSERT INTO reviews (user_name, email, rating, review_text) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssis", $user_name, $email, $rating, $review_text);
    
    if ($stmt->execute()) {
        echo "<script>alert('Review submitted successfully!'); window.location.href='homepage.php';</script>";
    } else {
        echo "<script>alert('Error submitting review. Try again later.'); window.location.href='homepage.php';</script>";
    }
}
?>
