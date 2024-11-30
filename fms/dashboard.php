<?php
include('db_connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch savings summary
$savings_query = "SELECT SUM(amount) AS total_savings FROM savings WHERE user_id = ?";
$savings_stmt = $conn->prepare($savings_query);
$savings_stmt->bind_param("i", $user_id);
$savings_stmt->execute();
$savings_result = $savings_stmt->get_result()->fetch_assoc();

// Fetch all savings
$savings_list_query = "SELECT * FROM savings WHERE user_id = ?";
$savings_list_stmt = $conn->prepare($savings_list_query);
$savings_list_stmt->bind_param("i", $user_id);
$savings_list_stmt->execute();
$savings_list_result = $savings_list_stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to Your Dashboard</h1>
    <h2>Total Savings: <?php echo $savings_result['total_savings']; ?></h2>

    <h3>Your Savings:</h3>
    <table>
        <tr>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        <?php while ($row = $savings_list_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['date']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <form method="POST" action="save_savings.php">
        <input type="number" name="amount" placeholder="Amount" required>
        <input type="date" name="date" required>
        <button type="submit">Add Savings</button>
    </form>
</body>
</html>
