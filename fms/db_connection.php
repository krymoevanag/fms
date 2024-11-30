<?php
// Start the session
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "Timothy2004.";
$dbname = "finacial";

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Redirect function to use in other files
function redirectToHome($delay = 0) {
    header("refresh:$delay; url=home.html");  // Redirects to home.html after a specified delay (in seconds)
    exit();
}
?>
