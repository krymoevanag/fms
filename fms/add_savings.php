<?php
// Include dp.php for database connection and session management
include("db_connection.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to save savings.");
}

$user_id = $_SESSION['user_id']; // Get the logged-in user ID

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $amount = $_POST['amount'];
    $date = $_POST['date']; // Date input from the form

    // Insert savings data into the database
    $query = "INSERT INTO savings (user_id, amount, created_at) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ids", $user_id, $amount, $date); // 'i' for integer, 'd' for double, 's' for string (date)
    $stmt->execute();

    // Redirect to dashboard after saving
    header("Location: dashboard.php");
    exit();
}
?>
