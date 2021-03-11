<?php
include '../db/database.php';
$errorMSG = "";
if(count($_POST)>0){
	if($_POST['type']==1){
		$folder_name=$_POST['folder_name'];
        $user_id=$_POST['user_id'];
        $project_id=$_POST['project_id'];
		$parent_id=$_POST['parent_id'];
		if($folder_name == ''){
			$errorMSG .= "Folder Name is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$sql = "INSERT INTO `folder`( `folder_name`, `user_id`,`project_id`,`parent_id`) 
			VALUES ('$folder_name','$user_id','$project_id','$parent_id')";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}

if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$name=$_POST['name'];
		if($name == ''){
			$errorMSG .= "Folder Name is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$sql = "UPDATE `folder` SET `folder_name`='$name' WHERE folder_id=$id";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}

if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `folder` WHERE folder_id = $id OR parent_id = $id";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

if(count($_POST)>0){
	if($_POST['type']==9){
		$id=$_POST['id'];
		$path=$_POST['path'];
		$sql = "DELETE FROM `file` WHERE file_id = $id";
		// $paths = "SELECT `file_path` FROM `file` WHERE file_id = $id";
		// $result = mysqli_query($conn, $paths);
		// $path = mysqli_fetch_assoc($result);
		if (mysqli_query($conn, $sql)) {
			unlink('upload/'.$path);
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

?>