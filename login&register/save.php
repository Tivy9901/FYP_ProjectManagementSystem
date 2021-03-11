<?php
    include '../db/database.php';
    if(!isset($_SESSION)) {session_start();} 
    $errors = array();
    // $msg = array();
    if(isset($_POST['btn-reg'])){
        $username =  mysqli_real_escape_string($conn, $_POST['username']);
        $name =  mysqli_real_escape_string($conn, $_POST['name']);
        $password =  mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($password);
        $email =  mysqli_real_escape_string($conn, $_POST['email']);
        $phoneNumber =  mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        $sql = "SELECT * FROM user WHERE user_username = '$username' ";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res) > 0){
            $_SESSION['error_msg'] = "Sorry...username already taken!";
        }else{
            if(count($errors) == 0){
            $sql = "INSERT INTO user (user_username,user_name,user_password,user_type,user_email,user_phoneNumber)
                    VALUES('$username','$name','$password','1','$email','$phoneNumber')";
            $res = mysqli_query($conn,$sql);
            $_SESSION['username']=$username;
            header('location: login.php');
            }
        }
    }

    //login
    if(isset($_POST['btn-login'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($password);
        if(count($errors) == 0){
            $sql = "SELECT * FROM user WHERE user_username='$username' and user_password='$password'";
            $result = mysqli_query($conn, $sql);    
            $user = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['username'] = $username;
                $_SESSION['user_id']=$user['user_id'];
                include 'check.php';
            }else{
                array_push($errors,"Wrong username/password");
            }
        }else{
            array_push($errors,"Wrong username/password");
        }
    }
?>
