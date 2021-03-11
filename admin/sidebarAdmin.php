<?php
    define('urlAdmin',"http://localhost/firsttry/admin/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro Studio</title>
</head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    .image {
        width: 50px;
        height: 50px;
        /* border-radius: 50%; */
    }
</style>
<body>
    <div class="w3-sidebar w3-grey w3-bar-block" style="width:8%">
        <a href="<?php echo urlAdmin;?>"><img src="<?php echo urlAdmin;?>../logo.png" style="width:50px,height:50px"
        class="w3-bar-item w3-button w3-border-bottom"></a>
        <a href="<?php echo urlAdmin;?>user.php" class="w3-bar-item w3-button w3-border-bottom">
        <i class="fa fa-user icon"></i> User</a>
        <a href="<?php echo urlAdmin;?>team.php" class="w3-bar-item w3-button w3-border-bottom">
        <i class="fa fa-users icon"></i> Team</a>
        <a href="#homeSubmenu" data-toggle="collapse" class="dropdown-toggle w3-bar-item w3-button w3-border-bottom">
        <i class="fa fa-project-diagram"></i> Project</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="<?php echo urlAdmin;?>project.php" class="w3-bar-item w3-button ">
                    All Project<i class="fa fa-diagram"></i> </a>
                </li>
                <li>
                    <a href="<?php echo urlAdmin;?>file/index.php" class="w3-bar-item w3-button ">
                    <i class="fa fa-file"></i> File</a>
                </li>
                <li>
                    <a href="<?php echo urlAdmin;?>task/index.php" class="w3-bar-item w3-button ">
                    <i class="fa fa-tasks"></i> Task</a>
                </li>
                <li>
                    <a href="<?php echo urlAdmin;?>forum/index.php" class="w3-bar-item w3-button ">
                    <i class="fa fa-lightbulb-o"></i> Forum</a>
                </li>
                <li>
                    <a href="<?php echo urlAdmin;?>event/index.php" class="w3-bar-item w3-button w3-border-bottom">
                    <i class="fa fa-calendar"></i> Event</a>
                </li>
            </ul>
        <a href="<?php echo urlAdmin;?>user/main.php" class="w3-bar-item w3-button w3-border-bottom">
        <i class="far fa-user-circle"></i> Profile</a>
        <a href="<?php echo urlAdmin;?>../login&register/logout.php" class="w3-bar-item w3-button w3-border-bottom">
        <i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</body>
</html>