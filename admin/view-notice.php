<?php
include '../backend/db.php';

$query = "SELECT * FROM notice ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

echo "<h2>Notices</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Title</th><th>Content</th><th>Created At</th><th>Actions</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['title']}</td>
            <td>{$row['content']}</td>
            <td>{$row['created_at']}</td>
            <td>
                <a href='edit-notice.php?id={$row['id']}'>Edit</a> |
                <a href='delete-notice.php?id={$row['id']}'>Delete</a>
            </td>
        </tr>";
}

echo "</table>";
?>
