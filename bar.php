<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<?php
    include 'header.php';
    include 'db/database.php';
    if (!isset($_SESSION)){session_start();} 
    // if (!isset($_SESSION['username'])) { 
    //     $_SESSION['msg'] = "You have to log in first"; 
    //     header('location: login&register/login.php'); 
    // } 
    define("URL","http://localhost/firsttry");
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user WHERE user_id = '$user_id' ";
    $res = mysqli_query($conn,$sql);
    $user = mysqli_fetch_assoc($res);
?>
<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    li {
        float: left;
    }

    li a {
        color: white;
        text-align: center;
        padding: 2px;
        text-decoration: none;
        font-size: 20px;
    }
    .image {
        width: 50px;
        height: 50px;
        /* border-radius: 50%; */
    }
</style>
<nav class="navbar sticky-top bg-dark">
<!-- <nav class="navbar navbar-expand-sm navbar-inverse bg-dark"> -->
    <div style="float:right">
        <!-- <ul>
            <li>
                <a href="<?php echo URL;?>/home.php">
                <img src="<?php echo URL;?>/logo.png" class="image"></a>
            </li>

            <li>
                <span><i class="fa fa-users" style="color:white"></i><a href="<?php echo URL;?>/team/index.php"> Teams </a></span>
            </li>
        </ul> -->
        <ul class="navbar navbar-expand-sm navbar-inverse bg-dark">
                <a class="navbar-brand" href="<?php echo URL;?>/home.php">
                <img src="<?php echo URL;?>/logo.png" class="image"></a>
            <li class="nav-item p-2">
                <span class="nav-link"><i class="fa fa-users" style="color:white"></i><a href="<?php echo URL;?>/team/index.php" style="text-decoration: none;"> Teams </a></span>
            </li>
            </div>
        <!-- <li class="nav-item ml-auto" style="list-style-type: none;"> -->
        <div class="w3-dropdown-hover w3-right">
            <img src="<?php echo URL;?>/user/images/<?php echo $user['user_profileImage'];?>" class="image" style="border-radius:50%">
            <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
                <a href="<?php echo URL;?>/user/main.php" class="w3-bar-item w3-button">Profile</a>
                <a href="<?php echo URL;?>/login&register/logout.php" class="w3-bar-item w3-button">Logout</a>
            </div>
        </div>
        <!-- </li> -->
        </ul>
    <!-- </div>
    <div class="w3-dropdown-hover w3-right">
        <img src="<?php echo URL;?>/user/images/<?php echo $user['user_profileImage'];?>" class="image" style="border-radius:50%;">
        <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
            <a href="<?php echo URL;?>/user/main.php" class="w3-bar-item w3-button">Profile</a>
            <a href="<?php echo URL;?>/login&register/logout.php" class="w3-bar-item w3-button">Logout</a>
        </div>
  </div> -->
</nav>
