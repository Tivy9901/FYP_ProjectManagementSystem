<?php
include '../db/database.php';
$errorMSG = "";
//insert task list
if(count($_POST)>0){
	if($_POST['type']==1){
		$name=$_POST['name'];
		if($name==''){
			$errorMSG .= "Name is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$description=$_POST['description'];
			$project_id=$_POST['project_id'];
			$user_id=$_POST['user_id'];
			$sql = "INSERT INTO `task_list`( `tasklist_name`, `tasklist_description`,`user_id`,`project_id`) 
			VALUES ('$name','$description','$user_id','$project_id')";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}
//update task list
if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$name=$_POST['name'];
		$desc=$_POST['desc'];
		if($name == ''){
			$errorMSG .= "Name is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$sql = "UPDATE `task_list` SET `tasklist_name`='$name',`tasklist_description`='$desc' WHERE tasklist_id='$id'";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
				}
			mysqli_close($conn);
		}
	}
}
//delete task list
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "SELECT * FROM `task` WHERE tasklist_id = $id ";
		$res = mysqli_query($conn,$sql);
		if(mysqli_num_rows($res) > 0){
			$errorMSG .= "You need to delete task first!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$sql1 = "DELETE FROM `task_list` WHERE tasklist_id = $id ";
			if (mysqli_query($conn, $sql1)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}

//insert task
if(count($_POST)>0){
	if($_POST['type']==100){
		$name=$_POST['taskName_i'];
		$deadline=$_POST['deadline_i'];
		if($name==''){
			$errorMSG .= "Name is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}
		else if($deadline==''){
			$errorMSG .= "Deadline is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}
		else{
			$description=$_POST['taskDes_i'];
			$list_id=$_POST['listId_i'];
			$priority=$_POST['priority_i'];
			$user_id=$_POST['userId_i'];
			$sql = "INSERT INTO `task`( `task_name`, `task_description`,`tasklist_id`,`task_priority`,`task_deadline`,`user_id`) 
			VALUES ('$name','$description','$list_id','$priority','$deadline','$user_id')";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			//mysqli_close();
		}
	}
}

//delete task
if(count($_POST)>0){
	if($_POST['type']==101){
		$id=$_POST['id'];
		$sql = "SELECT * FROM `task_assign` WHERE task_id = $id ";
		$res = mysqli_query($conn,$sql);
		if(mysqli_num_rows($res) > 0){
			$errorMSG .= "You need to unassign user first!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$sql1 = "DELETE FROM `task` WHERE task_id = $id ";
			if (mysqli_query($conn, $sql1)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}


?>