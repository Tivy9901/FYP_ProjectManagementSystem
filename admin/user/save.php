<?php
    include '../../db/database.php';
    $errorMSG = "";
    if(!isset($_SESSION)) { session_start(); }
    if(count($_POST)>0){
        if($_POST['type']==1){
            $userId = $_SESSION['user_id'];
            $username =  mysqli_real_escape_string($conn, $_POST['username']);
            $name =  mysqli_real_escape_string($conn, $_POST['name_i']);
            $email =  mysqli_real_escape_string($conn, $_POST['email']);
            $phoneNumber =  mysqli_real_escape_string($conn, $_POST['phoneNumber']);
            if($username == ''){
                $errorMSG .= "Name is required!";
                echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else{
                $sql = "UPDATE user SET user_username='$username',
                                        user_name = '$name',
                                        user_email ='$email',
                                        user_phoneNumber = '$phoneNumber'
                                        WHERE user_id = '$userId'";
                if (mysqli_query($conn, $sql)) {
                    echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
                    $_SESSION['username']=$username;
                }else{
                    echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
                    }
                mysqli_close($conn);
            }
        }
    }
?>