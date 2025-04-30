<?php
session_start(); // Start the session

// Destroy all session data
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Redirect to sign-in page
header("Location: signin.php");
exit();
?>
