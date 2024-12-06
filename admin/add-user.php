<?php
include '../backend/db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Hash password using MD5
    $hashed_password = md5($password);

    // Insert query to add the user into the database
    $sql = "INSERT INTO users (username, email, password, role) 
            VALUES ('$name', '$email', '$hashed_password', '$role')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('User added successfully!');
                window.location.href = 'admin-view-users.php'; // Redirect to users list page
              </script>";
    } else {
        echo "<script>
                alert('Error: Could not add user.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Add User</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: white;
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            margin-top: 64px;
            max-width: 560px;
            width: 100%;
            background: #fff;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            border: 2px solid #00bdaa;
            border-radius: 8px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 15px;
            margin: 0 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background: #f2f2f2;
        }

        button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            background: #4CAF50;
            width: 100%;
            border: 0;
            padding: 15px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover, button:active, button:focus {
            background: #43A047;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
    <script>
        function validateForm(event) {
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let role = document.getElementById('role').value;
            let errors = [];

            // Check email format
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                errors.push("Invalid email format.");
            }

            // Check password length
            if (password.length < 6) {
                errors.push("Password must be at least 6 characters.");
            }

            // Check role selection
            if (!role) {
                errors.push("Please select a role.");
            }

            // Display errors
            const errorDiv = document.getElementById('errors');
            errorDiv.innerHTML = "";
            if (errors.length > 0) {
                event.preventDefault(); // Stop form submission
                errors.forEach(err => {
                    let p = document.createElement('p');
                    p.className = "error";
                    p.textContent = err;
                    errorDiv.appendChild(p);
                });
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Add User</h2>
        <div id="errors"></div> <!-- Validation Errors -->
        <form action="../admin/add-user.php" method="POST" onsubmit="validateForm(event)" class="login-form">
            <!-- First Name -->
            <div class="form-group">
                <label for="name">First Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- Account Level -->
            <div class="form-group">
                <label for="role">Account Level:</label>
                <select id="role" name="role" required>
                    <option value="">-- SELECT --</option>
                    <option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit">Add User</button>
        </form>
    </div>
</body>
</html>
