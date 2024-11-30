<?php
// Start the session
include ("db_connection.php");
// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Optionally, delete the session cookie (to ensure it's fully cleared)
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/'); // Expire the cookie
}

// Redirect to the login or homepage
header("Location: index.php");
exit; // Make sure no further code is executed
?>
