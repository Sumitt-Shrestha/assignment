<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
  
    /* Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa; /* Light gray background */
        color: #333;
        padding: 20px;
    }

    /* Navbar */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #222; /* Dark navbar */
        padding: 10px 20px;
        color: white;
        position: fixed; /* Make it sticky */
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
    }

    .navbar h1 {
        font-size: 18px;
        margin: 0;
    }

    .navbar a {
        text-decoration: none;
        color: white;
        font-size: 14px;
        margin-left: 10px;
    }

    /* Welcome Section */
    .welcome {
        text-align: center;
        margin-top: 80px; /* Adjust for sticky navbar */
        margin-bottom: 40px;
    }

    .welcome h1 {
        font-size: 24px;
        color: #444;
    }

    /* Management Sections */
    .section {
        margin: 20px 0; /* Add gap between each management section */
        max-width: 900px;
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        margin-left: 256px;
    }

    .section h3 {
        font-size: 18px;
        color: #333;
        margin-bottom: 10px;
        width: 100%; /* Align header above buttons */
    }

    /* Buttons */
    button {
        padding: 15px 25px;
        margin-right: 16px; /* Reduced gap between buttons */
        margin-bottom: 10px; /* Add bottom margin for spacing */
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
    }

    /* Button Colors */
    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-warning {
        background-color: #ffc107;
        color: white;
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    /* Button Links */
    button a {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    /* Center Alignment */
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
hr{
    margin-top: 10px;
}

    </style>
    <title>Admin Dashboard</title>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <h1>Assignment Management System</h1>
        <div>
            <a href="#" id="home-link">Home</a>
            <a href="#" id="logout-link">Logout</a>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="welcome">
        <h1>Welcome, Admin</h1>
        <hr>
    </div>

    <!-- Module Management -->
    <div class="section">
        <h3>Module Management</h3>
        <button class="btn-primary"><a href="../admin/view-module.php">View Modules</a></button>
        <button class="btn-warning"><a href="../admin/add-module.php">Add Module</a></button>
        <button class="btn-info"><a href="../admin/add-subject.php">Add Subject</a></button>
    </div>

    <!-- Assessment Management -->
    <div class="section">
        <h3>Assessment Management</h3>
        <button class="btn-primary"><a href="../admin/view-assessments.php">View Assessments</a></button>
        <button class="btn-warning"><a href="../admin/view-marking-schemes.php">View Marking Schemes</a></button>
        <button class="btn-info"><a href="../admin/add-assessment.php">Add Assessment</a></button>
    </div>

    <!-- User Management -->
    <div class="section">
        <h3>User Management</h3>
        <button class="btn-primary"><a href="../admin/view-users.php">View Users</a></button>
        <button class="btn-warning"><a href="../admin/view-students.php">View Students</a></button>
        <button class="btn-info"><a href="../admin/view-lecturers.php">View Lecturers</a></button>
        <button class="btn-danger"><a href="../admin/add-user.php">Add User</a></button>
    </div>

    <div class="section">
        <h3>Notice Management</h3>
        <button class="btn-primary"><a href="../admin/add-notice.php"> Add Notice</a></button>
        <button class="btn-info"><a href="../admin/view-notice.php">View Notice</a></button>
    </div>

    <script>
        // Add logic for Home and Logout links
        document.getElementById("home-link").addEventListener("click", function() {
            window.location.href = "../backend/admin_panel.php"; // Replace with actual homepage URL
        });

        document.getElementById("logout-link").addEventListener("click", function() {
            // Add logout logic here (clear session/cookie, etc.)
            window.location.href = "../login.php"; // Replace with actual logout URL
        });
    </script>
</body>
</html>
