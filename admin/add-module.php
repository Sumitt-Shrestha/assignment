<?php
include '../backend/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $module_name = mysqli_real_escape_string($conn, $_POST['name']);
    $module_description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "INSERT INTO modules (name, description, created_at) 
            VALUES ('$module_name', '$module_description', NOW())";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Module added successfully!');
            window.location.href = 'admin-view-modules.php'; // Redirect to modules list page
        </script>";
    } else {
        echo "<script>
            alert('Error: Could not add module.');
        </script>";
    }
}
?>

<form method="POST" action="add-module.php">
    <label for="name">Module Name:</label>
    <input type="text" name="name" required>

    <label for="description">Description:</label>
    <textarea name="description"></textarea>

    <button type="submit">Add Module</button>
</form>
