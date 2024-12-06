<?php
session_start();
include '../backend/db.php';


if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'teacher') {
    header("Location: /Assignment/login.php"); // Redirect to login page
    exit();
}


// Fetch teacher's assigned subjects and their assignments
$teacher_id = $_SESSION['admin_id']; 
$query = "SELECT subjects.name AS subject_name, assignments.id, assignments.title, assignments.due_date 
          FROM assignments
          INNER JOIN subjects ON assignments.subject_id = subjects.id
          WHERE assignments.teacher_id = '$teacher_id'";

$result_assignments = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Teacher Panel</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['admin_username']; ?>!</h1>
    
    <!-- Create Assignment Form -->
    <section>
        <h2>Create Assignment</h2>
        <form action="add-assignment.php" method="POST">
            <label for="subject">Subject:</label>
            <select name="subject" id="subject" required>
                <?php
                // Fetch the subjects assigned to the teacher
                $subject_query = "SELECT id, name FROM subjects WHERE teacher_id = '$teacher_id'";
                $subjects_result = mysqli_query($conn, $subject_query);

                while ($row = mysqli_fetch_assoc($subjects_result)) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline" required>

            <button type="submit">Create</button>
        </form>
    </section>

    <!-- View Assignments -->
    <section>
        <h2>My Assignments</h2>
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Title</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display assignments
                if (mysqli_num_rows($result_assignments) > 0) {
                    while ($row = mysqli_fetch_assoc($result_assignments)) {
                        echo "<tr>
                                <td>{$row['subject_name']}</td>
                                <td>{$row['title']}</td>
                                <td>{$row['due_date']}</td>
                                <td><a href='view-submissions.php?assignment_id={$row['id']}'>View Submissions</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No assignments found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- View Submissions -->
    <section>
        <h2>Student Submissions</h2>
        <?php
        // Fetch submissions for a specific assignment
        if (isset($_GET['assignment_id'])) {
            $assignment_id = $_GET['assignment_id'];

            $submission_query = "SELECT submissions.id AS submission_id, users.username AS student_name, 
                                        submissions.file, submissions.submission_date
                                 FROM submissions
                                 INNER JOIN users ON submissions.student_id = users.id
                                 WHERE submissions.assignment_id = '$assignment_id'";

            $submission_result = mysqli_query($conn, $submission_query);

            echo "<table>
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>File</th>
                            <th>Submission Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = mysqli_fetch_assoc($submission_result)) {
                echo "<tr>
                        <td>{$row['student_name']}</td>
                        <td><a href='../uploads/{$row['file']}' download>Download</a></td>
                        <td>{$row['submission_date']}</td>
                        <td><a href='grade-submission.php?submission_id={$row['submission_id']}'>Grade</a></td>
                      </tr>";
            }
            echo "</tbody></table>";
        }
        ?>
    </section>

    <!-- Post Notices -->
    <section>
        <h2>Post Notice</h2>
        <form action="add-notice.php" method="POST">
            <label for="notice_title">Title:</label>
            <input type="text" id="notice_title" name="notice_title" required>

            <label for="notice_content">Content:</label>
            <textarea id="notice_content" name="notice_content" required></textarea>

            <button type="submit">Post</button>
        </form>
    </section>

</body>
</html>
