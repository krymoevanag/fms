<?php
include('db_connection.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];  // Get the logged-in user's ID

// Handle form submission for adding an investment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $roi = $_POST['roi'];  // Return on Investment percentage
    $start_date = $_POST['start_date'];

    // Prepare the SQL query to insert investment details into the database
    $query = "INSERT INTO investments (user_id, name, type, amount, roi, start_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issdss", $user_id, $name, $type, $amount, $roi, $start_date);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the dashboard after successful investment submission
        header("Location: dashboard.php");
    } else {
        // Display an error message if the query fails
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Investment</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your custom CSS file -->
</head>
<body>
    <h1>Add New Investment</h1>
    <form method="POST">
        <!-- Investment Name -->
        <label for="name">Investment Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter Investment Name" required><br>

        <!-- Investment Type -->
        <label for="type">Investment Type:</label>
        <input type="text" name="type" id="type" placeholder="Enter Investment Type (e.g., stocks, real estate)" required><br>

        <!-- Investment Amount -->
        <label for="amount">Amount Invested:</label>
        <input type="number" name="amount" id="amount" placeholder="Enter Investment Amount" required><br>

        <!-- ROI (Return on Investment) -->
        <label for="roi">Expected ROI (%) :</label>
        <input type="number" name="roi" id="roi" placeholder="Enter Expected ROI" step="0.01" required><br>

        <!-- Investment Start Date -->
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required><br>

        <!-- Submit Button -->
        <button type="submit">Add Investment</button>
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
