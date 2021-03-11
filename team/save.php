<?php
include '../db/database.php';
session_start();
$errorMSG = "";
if(count($_POST)>0){
	if($_POST['type']==1){
		$name=$_POST['name'];
		if ($name == ''){
			$errorMSG .= "Name is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$description=$_POST["description"];
			$user_id =$_POST['user_id'];
			$sql = "INSERT INTO `team`( `team_name`, `team_description`,`user_id`) 
				VALUES ('$name','$description','$user_id')";
			if (mysqli_query($conn, $sql)) {
				$sql2 = "INSERT INTO `team_list` (`team_id`,`user_id`)
						VALUES(LAST_INSERT_ID(),'$user_id')";
				$res = mysqli_query($conn,$sql2);
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
		$id=$_POST['team_id'];
		$name=$_POST['team_name'];
		$desc=$_POST['team_desc'];
		if($name==''){
			$errorMSG .= "Name is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$sql = "UPDATE `team` SET `team_name`='$name',`team_description`='$desc' WHERE team_id=$id";
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
		$sql = "DELETE FROM `team_list` WHERE team_id = $id ";
		if (mysqli_query($conn, $sql)) {
			$sql2 = "DELETE FROM `team` WHERE team_id = $id ";
            $res = mysqli_query($conn,$sql2);
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

if(count($_POST)>0){
	if($_POST['type']==99){
		$team_id=$_POST['team_id'];
		$user_id=$_POST['user_id'];
		$sql = "DELETE FROM `team_list` WHERE team_id = $team_id AND user_id =$user_id";
		if (mysqli_query($conn, $sql)) {
			
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

if(count($_POST)>0){
	if($_POST['type']==88){
		$user_username=$_POST['user_username'];
		$team_id =$_POST['team_id'];
		if($user_username==''){
			$errorMSG .= "Name is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$sql = "SELECT * FROM user WHERE user_username='$user_username'";
			$res = mysqli_query($conn, $sql);
			$user = mysqli_fetch_assoc($res);
			if (mysqli_num_rows($res)>0) /*found same name*/{
				$user_id = $user['user_id'];
				$sql1 = "SELECT * FROM team_list WHERE user_id= '$user_id' AND team_id = '$team_id'";
				$res1 = mysqli_query($conn,$sql1);
				if(mysqli_num_rows($res1)>0){
					$errorMSG .= "User already exist!";
					echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
				}else{
					$sql2 = "INSERT INTO `team_list` (`team_id`,`user_id`)VALUES('$team_id','$user_id')";
					if (mysqli_query($conn, $sql2)) {
						echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
					} 
					else {
						echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
					}
				}
			}else{
				$errorMSG .= "This user is not exist";
				echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}

if(count($_POST)>0){
	if($_POST['type']==77){
		$team_id=$_POST['team_id'];
		$user_id=$_POST['user_id'];
		$sql = "DELETE FROM `team_list` WHERE team_id = $team_id AND user_id =$user_id";
		if (mysqli_query($conn, $sql)) {
			
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

?>