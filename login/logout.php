<?php
session_start();
session_destroy(); // Destroy session

echo "<script>
    alert('Thank you for using Hind Historia');
    window.location.href = 'login.php'; // Redirect to login page
</script>";
exit();
?>
