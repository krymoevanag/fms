<?php
include('db_connection.php');


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit(); // Stop further script execution if not logged in
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1, h2, h3 {
            text-align: center;
            color: #333;
        }

        h1 {
            font-size: 2.5em;
            margin-top: 20px;
        }

        h2 {
            font-size: 1.8em;
            margin-top: 10px;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        th, td {
            padding: 12px 20px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        form {
            width: 80%;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="number"], input[type="date"] {
            padding: 10px;
            margin: 10px;
            width: 60%;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        input[type="text"]{
            padding: 10px;
            margin: 10px;
            width: 60%;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Your Dashboard</h1>
        <h2>Total Savings: <?php echo $savings_result['total_savings']; ?></h2>

        <h3>Your Savings:</h3>
        <table>
            <tr>
                <th>Amount</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
            <?php while ($row = $savings_list_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['date']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <form method="POST" action="save_savings.php">
    <input type="number" name="amount" placeholder="Amount" required>
    <input type="date" name="date" required>
    <input type="text" name="description" placeholder="Description" required>
    <button type="submit">Add Savings</button>
   
</form>
    </div>
    <form action="logout.php">
    <button style="margin-left:43%;"    type="submit"  onclick="logout()">Logout</button>


    </form>
</body>
</html>
