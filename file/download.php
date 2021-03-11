<?php 
include '../db/database.php';
$path = 'upload/';
// $file_path=$_POST['path'];
$file_id=$_GET['f_id'];
// $file_type=$_POST['type'];
// $file = ($path.$file_path);
// $file = ("assets/uploads/".$fname);

$sql = "SELECT * FROM `file` WHERE file_id = $file_id";
                $result = mysqli_query($conn, $sql);
                $file = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
                mysqli_close($conn);

$fname=$file['file_path'];   
       $file2 = ("upload/".$fname);
       
       header ("Content-Type: ".filetype($file2));
       header ("Content-Length: ".filesize($file2));
       header ("Content-Disposition: attachment; filename=".$file['file_name'].'.'.$file['file_type']);

       readfile($file2);
    echo "download"
?>