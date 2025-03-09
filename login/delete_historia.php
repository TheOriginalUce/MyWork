<?php
include("db.php");

if (isset($_GET['site_name'])) {
    $site_name = $_GET['site_name'];
    $conn->query("DELETE FROM historia WHERE site_name = '$site_name'");
    header("Location: admin_dashboard.php?section=historia");
}
?>
