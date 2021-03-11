<?php
    // include 'db.php';
    // session_start();
    if(!isset($_SESSION)) {session_start();} 
    $u_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user WHERE user_id = $u_id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    $_SESSION['u_type'] = $user['user_type'];
    if($_SESSION['u_type']==1){
        if($user['user_disable'] == 1){
            // header('refresh:0');
            $_SESSION['disable'] = "This account has been disable!";
        }else{
            header("Location: ../home.php");
        }
    }else if($_SESSION['u_type']==2){
        if($user['user_disable'] == 1){
            // header('refresh:0');
            $_SESSION['disable'] = "This account has been disable!";
        }else{
            header("Location: ../admin/home.php");
        }
    }
?>

