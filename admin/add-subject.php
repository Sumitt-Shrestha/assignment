<?php
include '../backend/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $module_id = $_POST['module_id'];
    $teacher_id = $_POST['teacher_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "INSERT INTO subjects (name, module_id, teacher_id, description, created_at) 
            VALUES ('$name', '$module_id', '$teacher_id', '$description', NOW())";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Subject added successfully!');
            window.location.href = 'admin-view-modules.php'; // Redirect to modules list page
        </script>";
    } else {
        echo "<script>
            alert('Error: Could not add subject.');
        </script>";
    }
}
?>

<form method="POST" action="add-subject.php">
    <label for="module_id">Select Module:</label>
    <select name="module_id" required>
        <?php
        // Fetch modules from the database  
        $modules = mysqli_query($conn, "SELECT * FROM modules");
        while ($module = mysqli_fetch_assoc($modules)) {
            echo "<option value='{$module['id']}'>{$module['name']}</option>";
        }
        ?>
    </select>

    <label for="teacher_id">Assign Teacher:</label>
    <select name="teacher_id" required>
        <?php
        // Fetch teachers from the database
        $teachers = mysqli_query($conn, "SELECT * FROM users WHERE role = 'teacher'");
        while ($teacher = mysqli_fetch_assoc($teachers)) {
            echo "<option value='{$teacher['id']}'>{$teacher['username']}</option>";
        }
        ?>
    </select>

    <label for="name">Subject Name:</label>
    <input type="text" name="name" required>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>

    <button type="submit">Add Subject</button>
</form>
