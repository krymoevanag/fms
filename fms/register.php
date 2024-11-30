<?php
// Include your database connection file
include('db_connection.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Debugging: Check if password is being received
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    // Check if the password and confirm password match
    if ($password === $confirm_password) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query to insert the user into the database
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $hashed_password);

        // Execute the query and check if the user was successfully added
        if ($stmt->execute()) {
            echo "Registration successful!";
            // Redirect to login page (optional)
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Passwords do not match!";
    }
}

?>
