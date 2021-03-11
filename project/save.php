<?php
include '../db/database.php';
$errorMSG = "";
if(count($_POST)>0){
	if($_POST['type']==1){
		$title=$_POST['title'];
		if($title==''){
			$errorMSG .= "Project Title is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$description=$_POST['description'];
			$team_id=$_POST['team_id'];
			$user_id=$_POST['user_id'];
			$sql = "INSERT INTO `project`( `project_title`, `project_description`,`user_id`,`team_id`) 
			VALUES ('$title','$description','$user_id','$team_id')";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			} 
			else {
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}

if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$title=$_POST['title'];
		$desc=$_POST['desc'];
		if($title==''){
			$errorMSG .= "Project Title is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$sql = "UPDATE `project` SET `project_title`='$title',`project_description`='$desc' WHERE project_id=$id";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			} 
			else {
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}

if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `project` WHERE project_id = $id ";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}



?>