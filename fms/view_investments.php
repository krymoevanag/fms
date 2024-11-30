<?php
include('db_connection.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];  // Get the logged-in user's ID

// Query to get all investments for the logged-in user
$query = "SELECT * FROM investments WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Investments</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS -->
</head>
<body>
    <h1>Your Investments</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Investment Name</th>
                    <th>Investment Type</th>
                    <th>Amount</th>
                    <th>ROI (%)</th>
                    <th>Start Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['type']); ?></td>
                        <td><?php echo number_format($row['amount'], 2); ?></td>
                        <td><?php echo number_format($row['roi'], 2); ?>%</td>
                        <td><?php echo date('F j, Y', strtotime($row['start_date'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no investments to display.</p>
    <?php endif; ?>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
