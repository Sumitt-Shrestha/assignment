<?php
session_start();

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

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    // Query to fetch user details
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userrow = $result->fetch_assoc();

        // Debugging: Check the role
        var_dump($userrow['role']); // Check if the role is correct
        // Debugging: Check session variables
        var_dump($_SESSION['logged_in'], $_SESSION['role']); // Check session values

        // Verify password
        if (md5($user_password) === $userrow['password']) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user_username;
            $_SESSION['role'] = $userrow['role'];

            // Debugging: Check if session is correctly set
            var_dump($_SESSION['role']); // Check session role

            // Redirect based on role
            if ($userrow['role'] === 'admin') {
                header("Location: backend/admin_panel.php");
                exit();
            } elseif ($userrow['role'] === 'teacher') {
                header("Location: teachers/teacher_panel.php");
                exit();
            } elseif ($userrow['role'] === 'student') {
                header("Location: students/student_panel.php");
                exit();
            }
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "User not found!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Reset styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-page {
            width: 360px;
            background: #ffffff;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .login-form label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .login-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-form button:hover {
            background-color: #0056b3;
        }
        .login-form p {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-page">
        <div class="login-form">
            <h2>Login</h2>
            <!-- Display error message -->
            <?php if ($message): ?>
                <p><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <!-- Login Form -->
            <form action="login.php" method="POST">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username" required autocomplete="current-username">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required autocomplete="current-password">
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
