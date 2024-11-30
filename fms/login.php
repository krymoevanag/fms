<?php
// Start session at the very beginning
session_start();

// Ensure $_SERVER['REQUEST_METHOD'] is set before accessing it
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Step 1: Set up the MySQL connection with the updated credentials
    $servername = "localhost"; // or the IP address of the database server
    $username = "root"; // your MySQL username
    $password = "Timothy2004."; // the password you provided
    $dbname = "finacial"; // the name of the database

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Step 2: Ensure that username and password are available in the POST data
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $user = $_POST['email'];
        $pass = $_POST['password'];

        // Step 3: Prepare and execute SQL query to check user credentials
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        // Step 4: Check if user exists and verify password directly
        if ($result->num_rows > 0) {
            // User found, fetch the user data
            $row = $result->fetch_assoc();

            // Verify password (plain text comparison)
            if ($pass == $row['password']) {
                // Step 5: Successful login, set session variable and redirect to dashboard.php
                $_SESSION['user_id'] = $row['id'];  // Store user_id in session
                $_SESSION['user_email'] = $row['email']; // Optional: Store email in session for convenience
                header("Location: dashboard.php"); // Redirect to dashboard
                exit();
            } else {
                // Incorrect password
                echo "Invalid password.";
            }
        } else {
            // User not found
            echo "No user found with that username.";
        }
    } else {
        // Form data not set, display an error or handle accordingly
        echo "Username and password are required.";
    }

    // Close the database connection
    $conn->close();
} else {
    // If it's not a POST request, display an error message or handle differently
    echo "Please submit the form.";
}
?>

<!-- Optional: Debugging output to check if the POST data is being sent -->
<?php
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<pre>";
    var_dump($_POST);  // This will show the POST data for debugging
    echo "</pre>";
}
?>
