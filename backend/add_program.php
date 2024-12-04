<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: ../index.php');
    exit();
}
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $program_name = $_POST['program_name'];

    $sql = "INSERT INTO programs (program_name) VALUES ('$program_name')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New program added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Program</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Add New Program</h2>
        <form action="add_program.php" method="POST">
            <label for="program_name">Program Name</label>
            <input type="text" name="program_name" id="program_name" required>
            <button type="submit">Add Program</button>
        </form>
    </div>
</body>
</html>
