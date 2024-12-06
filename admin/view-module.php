<?php
include '../backend/db.php';

// Fetch all users
$query = "SELECT * FROM modules";
$result = mysqli_query($conn, $query);

echo "<h2>All Modules</h2>";
echo "<table>";
echo "<tr><th>ID</th>
            <th>name</th>
            <th>description</th>
            <th>Created At</th><th>Actions</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['description']}</td>
            <td>{$row['created_at']}</td>
            <td>
                <a href='edit-user.php?id={$row['id']}'>Edit</a> |
                <a href='delete-user.php?id={$row['id']}'>Delete</a>
            </td>
        </tr>";
}

echo "</table>";
?>

