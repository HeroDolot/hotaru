<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page
header('Location: ../../hotaru/index.php'); // Change to your login page URL
exit();
?>
