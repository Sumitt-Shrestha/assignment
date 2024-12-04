<!DOCTYPE html>
<html>
    <?php 
       
        
    ?>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css?<?php echo time(); ?> /">
        <link rel="stylesheet" href="css/style1.css?<?php echo time(); ?> /">
        <link rel="stylesheet" href="css/tile.css?<?php echo time(); ?> /">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> 
        <title>Admin Dashboard</title>
    </head>
    <body>
        <div class="container">
            <div class="wrapper">
                <h1>Welcome 
                <?php 
                    if (isset($_GET['id'])) {
                        $user = mysqli_real_escape_string($conn, $_GET['id']);
                        $sql = "SELECT * FROM users WHERE username = '$user'"; 
                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    
                        while($row = mysqli_fetch_array($result)) { 
                            $name = $row['name'];
                            echo " " . $name . " (Admin)";
                        }
                    }
                ?>
                </h1>
                <hr>
                
                <div class="row">
                    <!-- Module Management Section -->
                    <div class="col-md-6">
                        <h3>Courses Management</h3>
                        <div class="btn-group-vertical">
                            <button type="button" class="btn btn-primary">
                                <a href="../admin/admin-view-modules.php" style="color: white;">View Modules</a>
                            </button>
                            <button type="button" class="btn btn-warning">
                                <a href="../admin/add-module.php" style="color: white;">Add Module</a>
                            </button>
                        </div>
                    </div>

                    <!-- Assessment Management Section -->
                    <div class="col-md-6">
                        <h3>Assessment Management</h3>
                        <div class="btn-group-vertical">
                            <button type="button" class="btn btn-primary">
                                <a href="../admin/view-assessments.php" style="color: white;">View Assessments</a>
                            </button>
                            <button type="button" class="btn btn-warning">
                                <a href="../admin/view-marking-schemes.php" style="color: white;">View Marking Schemes</a>
                            </button>
                            <button type="button" class="btn btn-info">
                                <a href="../admin/add-assessment.php" style="color: white;">Add Assessment</a>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- User Management Section -->
                    <div class="col-md-6">
                        <h3>User Management</h3>
                        <div class="btn-group-vertical">
                            <button type="button" class="btn btn-primary">
                                <a href="../admin/view-users.php" style="color: white;">View Users</a>
                            </button>
                            <button type="button" class="btn btn-warning">
                                <a href="../admin/view-students.php" style="color: white;">View Students</a>
                            </button>
                            <button type="button" class="btn btn-info">
                                <a href="../admin/view-lecturers.php" style="color: white;">View Lecturers</a>
                            </button>
                            <button type="button" class="btn btn-danger">
                                <a href="../admin/add-user.php" style="color: white;">Add User</a>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>

<style type="text/css">
    a, a:hover, a:active, a:visited { 
        color: white;
        text-decoration: none;
    }
    .btn-group-vertical .btn {
        width: 100%;
    }
</style>
