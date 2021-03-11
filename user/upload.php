<?php 
    include '../db/database.php';
    if(!isset($_SESSION)) { session_start(); }
    if(count($_POST)>0){
        $userId = $_SESSION['user_id'];
        $valid_extensions = array('jpeg', 'jpg', 'png');
        $path = 'images/';
        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $fname = pathinfo($img, PATHINFO_FILENAME);
        $final_image = strtotime(date('y-m-d H:i')).'_'.$img;
        if(in_array($ext, $valid_extensions)){ 
            $path = $path.strtolower($final_image); 
            if(move_uploaded_file($tmp,$path)){
                $user_profileImage=$final_image;
                $sql = "UPDATE user SET user_profileImage='$user_profileImage' WHERE user_id = '$userId'";
                mysqli_query($conn, $sql);
                mysqli_close($conn);
            }
        }else{
             echo json_encode(array("statusCode"=>201));
        }
    }
?>
