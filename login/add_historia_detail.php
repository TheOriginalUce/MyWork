<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $site_name = $_POST['site_name'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Upload Multiple Images
    $target_dir = "uploads/";
    $image_paths = [];
    foreach ($_FILES["images"]["tmp_name"] as $key => $tmp_name) {
        $image_name = basename($_FILES["images"]["name"][$key]);
        $target_file = $target_dir . $image_name;
        move_uploaded_file($tmp_name, $target_file);
        $image_paths[] = $target_file;
    }

    $images = implode(",", $image_paths); 
    $stmt = $conn->prepare("INSERT INTO historia_detail (site_name, description, images, latitude, longitude) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $site_name, $description, $images, $latitude, $longitude);
    $stmt->execute();

    header("Location: admin_dashboard.php?section=historia_detail");
}
?>
