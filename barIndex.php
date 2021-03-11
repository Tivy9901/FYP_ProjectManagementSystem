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
    // $user_id = $_SESSION['user_id'];
    // $sql = "SELECT * FROM user WHERE user_id = '$user_id' ";
    // $res = mysqli_query($conn,$sql);
    // $user = mysqli_fetch_assoc($res);
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
    <div style="float:right">
        <ul>
            <li>
                <span><img src="logo.png" class="image">
            </li>
        </ul>
    </div>
    <div>
        <ul>
            <li>
                <span>
                    <button style="margin:5px;" type="button" class="btn btn-outline-light" >
                    <a href="login&register/login.php" style="color:white;">Sign In</a></button>
                </span>
            </li>
            <li></li>
            <li>
                <span>
                    <button style="margin:5px" type="button" class="btn btn-light">
                    <a href="login&register/register.php" style="color:black">Try it Free!</a></button>
                </span>
            </li>
        </ul>
    </div>
    <!-- <div class="w3-dropdown-hover w3-right">
        <img src="<?php echo URL;?>/user/images/<?php echo $user['user_profileImage'];?>" class="image">
        <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
            <a href="<?php echo URL;?>/user/main.php" class="w3-bar-item w3-button">Profile</a>
            <a href="<?php echo URL;?>/login&register/logout.php" class="w3-bar-item w3-button">Logout</a>
        </div>
  </div> -->
</nav>
