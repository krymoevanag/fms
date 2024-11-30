<?php
// Include dp.php for session and database connection
include("db_connection.php");
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to save savings.");
}

$user_id = $_SESSION['user_id']; // Get the logged-in user ID

// Assuming you have a form with fields for amount, description, and date
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description']; // Get description from form input

    // Get the user_id (it could come from the session or form data)
    $user_id = $_SESSION['user_id']; // Or get it another way

    // Prepare and execute the query to insert the savings data
    $query = "INSERT INTO savings (user_id, amount, description, date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("idss", $user_id, $amount, $description, $date);

    if ($stmt->execute()) {
        echo "Savings record added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}

    // Redirect to dashboard after saving
    header("Location: dashboard.php");
    exit();

?>
