<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "assignment_management";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = $_POST['username'];
    $admin_password = $_POST['password'];

    // Prepare SQL query to fetch admin details from the database
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $admin_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Admin found
        $row = $result->fetch_assoc();

        // Verify password (assuming passwords are stored using md5, change it if you're using something else)
        if (md5($admin_password) === $row['password']) {
            $_SESSION['admin'] = $admin_username; // Store the admin username in the session
            header("Location: backend/admin_panel.php"); // Redirect to the admin panel
            exit; // Stop further script execution after redirection
        } else {
            echo "<p style='color: red;'>Invalid password!</p>"; // Error message for incorrect password
        }
    } else {
        echo "<p style='color: red;'>Admin not found!</p>"; // Error message for invalid username
    }

    $stmt->close(); // Close the prepared statement
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-form">
        <h2>Admin Login</h2>
        <!-- Form submits data to the same file (index.php) -->
        <form action="index.php" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
