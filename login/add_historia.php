<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $site_name = $_POST['site_name'];
    $location = $_POST['location'];

    // Upload Image
    $target_dir = "uploads/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $stmt = $conn->prepare("INSERT INTO historia (site_name, location, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $site_name, $location, $target_file);
    $stmt->execute();

    header("Location: admin_dashboard.php?section=historia");
}
?>
