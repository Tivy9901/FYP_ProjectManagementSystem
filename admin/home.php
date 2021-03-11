<?php
    include '../db/database.php';
    include '../header.php';
    include 'sidebarAdmin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
</head>
<body>
    <div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
            <h1>Admin</h1>
        </div>
        <div class="w3-container">
        <br>
            <div class="row">
            <!-- team -->
                <div class="col-sm-6 col-lg-4">
                    <div class="card" style="max-width: 30rem;">
                        <div class="card-header bg-dribble content-center">
                            <i class="fa fa-users icon text-black my-4 display-4"> Team</i>
                        </div>
                        <div class="card-body row text-center">
                            <div class="col">
                                <div class="text-value-xl">
                                    <?php echo $conn->query('SELECT * FROM team')->num_rows ?>
                                </div>
                                <div class="text-uppercase text-muted small">Teams</div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- user -->
                <div class="col-sm-6 col-lg-4">
                    <div class="card" style="max-width: 30rem;">
                        <div class="card-header bg-dribble content-center">
                            <i class="fa fa-user icon text-black my-4 display-4"> User</i>
                        </div>
                        <div class="card-body row text-center">
                            <div class="col">
                                <div class="text-value-xl">
                                    <?php echo $conn->query('SELECT * FROM user')->num_rows ?>
                                </div>
                                <div class="text-uppercase text-muted small">Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- project -->
                <div class="col-sm-6 col-lg-4">
                    <div class="card" style="max-width: 30rem;">
                        <div class="card-header bg-dribble content-center">
                            <i class="fa fa-book icon text-black my-4 display-4"> Project</i>
                        </div>
                        <div class="card-body row text-center">
                            <div class="col">
                                <div class="text-value-xl">
                                    <?php echo $conn->query('SELECT * FROM project')->num_rows ?>
                                </div>
                                <div class="text-uppercase text-muted small">Projects</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>