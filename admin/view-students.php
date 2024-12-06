<?php
include '../backend/db.php';

// Fetch all students
$query = "SELECT * FROM users WHERE role='student'";
$result = mysqli_query($conn, $query);

echo "<h2>Students</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Created At</th><th>Actions</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['username']}</td>
            <td>{$row['email']}</td>
            <td>{$row['created_at']}</td>
            <td>
                <a href='edit-user.php?id={$row['id']}'>Edit</a> |
                <a href='delete-user.php?id={$row['id']}'>Delete</a>
            </td>
        </tr>";
}

echo "</table>";
?>

