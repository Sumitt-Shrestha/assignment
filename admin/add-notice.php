<?php
include '../backend/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $sql = "INSERT INTO notice (title, content, created_at) VALUES ('$title', '$content', NOW())";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Notice added successfully!');
            window.location.href = 'view-notice.php'; // Redirect to notice list page
        </script>";
    } else {
        echo "<script>
            alert('Error: Could not add notice.');
        </script>";
    }
}
?>

<form method="POST" action="add-notice.php">
    <label for="title">Title:</label>
    <input type="text" name="title" required>

    <label for="content">Content:</label>
    <textarea name="content" required></textarea>

    <button type="submit">Add Notice</button>
</form>
