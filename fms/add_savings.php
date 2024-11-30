<?php
include('db_connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    $query = "INSERT INTO savings (user_id, amount, date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ids", $user_id, $amount, $date);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Savings</title>
</head>
<body>
    <form method="POST">
        <input type="number" name="amount" placeholder="Amount" required>
        <input type="date" name="date" required>
        <button type="submit">Save</button>
    </form>
</body>
</html>
