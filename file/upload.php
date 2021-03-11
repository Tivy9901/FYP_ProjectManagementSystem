<?php
include '../db/database.php';
if(count($_POST)>0){
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'docx' , 'ppt' , 'pptx'); // valid extensions
$path = 'upload/'; // upload directory


$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];


// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
$fname = pathinfo($img, PATHINFO_FILENAME);
// can upload same image using rand function
$final_image = strtotime(date('y-m-d H:i')).'_'.$img;

// check's valid format
    if(in_array($ext, $valid_extensions)){ 
        $path = $path.strtolower($final_image); 
        if(move_uploaded_file($tmp,$path)){
            // echo "<img src='$path' />";

            $file = $_FILES['image']['name'];
            $file_name=$fname;
            $file_type=$ext;
            $file_path=$final_image;
            $folder_id=$_POST['folder_id'];
            $user_id=$_POST['user_id'];
            $project_id=$_POST['project_id'];

            //insert form data in the database
            // $insert = $db->query("INSERT uploading (name,email,file_name) VALUES ('".$name."','".$email."','".$path."')");
            $sql = "INSERT INTO `file`( `file_name`,`file_type`,`file_path`,`folder_id`,`user_id`,`project_id`) 
                    VALUES ('$file_name','$file_type','$file_path','$folder_id','$user_id','$project_id')";

            mysqli_query($conn, $sql);
            mysqli_close($conn);
        }

    }else{
         echo json_encode(array("statusCode"=>201));
        }

    }
?>