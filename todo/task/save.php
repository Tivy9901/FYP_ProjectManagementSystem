<?php 
include '../../db/database.php';
$errorMSG = "";
if(count($_POST)>0){
	if($_POST['type']==97){
		$id=$_POST['taskId_u'];
		$name=$_POST['taskName_u'];
		$desc=$_POST['taskDes_u'];
		$priority=$_POST['taskpriority'];
		$deadline=$_POST['deadline_u'];
		if($name==''){
			$errorMSG .= "Name is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}
		else if($deadline==''){
			$errorMSG .= "Deadline is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}
		else{
			$sql = "UPDATE `task` SET `task_name`='$name',
									`task_description`='$desc',
									`task_priority`='$priority',
									`task_deadline`='$deadline' WHERE task_id='$id'";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}
//assign
// if(count($_POST)>0){
// 	if($_POST['type']==104){
// 		$user_id=$_POST['user_id'];
// 		$task_id =$_POST['task_id'];
// 		if($user_id==''){
// 			$_SESSION['task_error']="Input please";
// 		}else{
// 			$sql = "SELECT * FROM user WHERE user_id='$user_id'";
// 				if (mysqli_query($conn, $sql)) {
// 					$result = mysqli_query($conn, $sql);    
// 					$user = mysqli_fetch_assoc($result);
// 					$user_id = $user['user_id'];

// 					$sql2 = "INSERT INTO `task_assign` (`task_id`,`user_id`)
//                     		VALUES('$task_id','$user_id')";
//             		$res = mysqli_query($conn,$sql2);
// 					echo json_encode(array("statusCode"=>200));
// 				} 
// 				else {
// 				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// 				}
// 				mysqli_close($conn);
// 		}
// 	}
// }
//assign
	if(count($_POST)>0){
		if($_POST['type']==104){
			$user_id=$_POST['user_id'];
			$task_id =$_POST['task_id'];
			$sql1 = "SELECT * FROM task_assign WHERE user_id = '$user_id' AND task_id = '$task_id' ";
			$res1 = mysqli_query($conn,$sql1);
			if(mysqli_num_rows($res1) > 0){
				$errorMSG .= "This user is already assigned to this task!";
				echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
			}else{
				$sql2 = "INSERT INTO `task_assign` (`task_id`,`user_id`)VALUES('$task_id','$user_id')";
				if (mysqli_query($conn, $sql2)) {
					echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
				}else{
					$errorMSG .= mysqli_error($conn);
					echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
				}
				mysqli_close($conn);
			}
		}
	}

//delete asign task
if(count($_POST)>0){
	if($_POST['type']==103){
        $uid=$_POST['uid'];
        $tid=$_POST['tid'];
		$sql = "DELETE FROM `task_assign` WHERE user_id = $uid AND task_id = $tid";
		if (mysqli_query($conn, $sql)) {
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

if(count($_POST)>0){
	if($_POST['type']==99){
        $id=$_POST['id'];
        $ac=0;
		$sql = "UPDATE `task` SET `task_completed`='$ac' WHERE task_id='$id'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

//undone
if(count($_POST)>0){
	if($_POST['type']==98){
        $id=$_POST['id'];
        $ac=1;
		$sql = "UPDATE `task` SET `task_completed`='$ac' WHERE task_id='$id'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
?>