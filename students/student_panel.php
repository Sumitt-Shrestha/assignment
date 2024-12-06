<?php
session_start();
include '../backend/db.php';

// Ensure only students can access this page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Student Panel</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['admin_username']; ?>!</h1>
    
    <!-- View Assignments -->
    <section>
        <h2>Your Assignments</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch assignments
                $student_id = $_SESSION['admin_username']; // Or fetch student ID
                $query = "SELECT * FROM assignments";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['title']}</td>
                            <td>{$row['description']}</td>
                            <td>{$row['deadline']}</td>
                            <td><form action='upload-submission.php' method='POST' enctype='multipart/form-data'>
                                    <input type='hidden' name='assignment_id' value='{$row['id']}'>
                                    <input type='file' name='submission' required>
                                    <button type='submit'>Submit</button>
                                </form></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    
    <!-- View Notices -->
    <section>
        <h2>Notices</h2>
        <ul>
            <?php
            // Fetch notices
            $query = "SELECT * FROM notices";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>{$row['notice']}</li>";
            }
            ?>
        </ul>
    </section>
</body>
</html>
