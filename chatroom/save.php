<?php 
include '../db/database.php';
if(!isset($_SESSION)) {session_start();} 
$errorMSG = '';
if(count($_POST)>0){
	if($_POST['type']==1){
        $name=$_POST['chatname'];
        $pass=$_POST['chatpass'];
        $team_id=$_POST['team_id'];
        $errorMSG="";
		if($name==''){
			$errorMSG .= "Name is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$user_id=$_SESSION['user_id'];
			$sql = "INSERT INTO `chatroom`( `chatroom_name`, `chatroom_password`,`user_id`,`team_id`) 
			VALUES ('$name','$pass','$user_id','$team_id')";
			if (mysqli_query($conn, $sql)) {
                $sql2 = "INSERT INTO `chatmember` (`user_id`,`chatroom_id`)
						VALUES('$user_id',LAST_INSERT_ID())";
				mysqli_query($conn,$sql2);
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
                $errorMSG .= mysqli_error($conn);
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}


if(count($_POST)>0){
	if($_POST['type']==2){
        $msg=$_POST['msg'];
        $user_id=$_POST['user_id'];
        $chatroom_id=$_POST['chatroom_id'];
        $errorMSG="";
		if($msg==''){
			$errorMSG .= "Please enter a message!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$sql = "INSERT INTO `chatmessage`( `chatmessage`, `user_id`,`chatroom_id`) 
			VALUES ('$msg','$user_id','$chatroom_id')";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
                $errorMSG .= mysqli_error($conn);
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}

if(count($_POST)>0){
	if($_POST['type']==3){
        $user_id=$_SESSION['user_id'];
        $chatroom_id=$_POST['chatroom_id'];
        $errorMSG="";
			$sql = "DELETE FROM `chatmember` WHERE user_id=$user_id AND chatroom_id=$chatroom_id";
			if (mysqli_query($conn, $sql)) {
                $r=mysqli_query($conn,"select * from chatmember where chatroom_id='$chatroom_id'");
                if (mysqli_num_rows($r)<1){
                    mysqli_query($conn,"delete from chatroom where chatroom_id='$chatroom_id'");
                }
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
                $errorMSG .= mysqli_error($conn);
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		
	}
}

if(count($_POST)>0){
	if($_POST['type']==4){
        $chatroom_id=$_POST['chatroom_id'];
        $errorMSG="";
			$sql = "DELETE FROM `chatmessage` WHERE chatroom_id=$chatroom_id";
			if (mysqli_query($conn, $sql)) {
                mysqli_query($conn,"delete from chatmember where chatroom_id='$chatroom_id'");
                mysqli_query($conn,"delete from chatroom where chatroom_id='$chatroom_id'");
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
                $errorMSG .= mysqli_error($conn);
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		
	}
}

if(count($_POST)>0){
	if($_POST['type']==5){
        $uid=$_POST['user_id'];
        $chatroom_id=$_SESSION['room_id'];
		$errorMSG="";
		$sql1 = "SELECT * FROM chatmember WHERE user_id = '$uid' AND chatroom_id = '$chatroom_id' ";
		$res = mysqli_query($conn,$sql1);
		if(mysqli_num_rows($res) > 0){
			$errorMSG .= "This user is already a member of this chat room!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$sql = "INSERT INTO `chatmember`(`user_id`,`chatroom_id`) 
			VALUES ('$uid','$chatroom_id')";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
                $errorMSG .= mysqli_error($conn);
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
	}
}

if(count($_POST)>0){
	if($_POST['type']==6){
        $user_id=$_POST['id'];
        $errorMSG="";
			$sql = "DELETE FROM `chatmember` WHERE user_id=$user_id";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			}else{
                $errorMSG .= mysqli_error($conn);
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		
	}
}
if(count($_POST)>0){
	if($_POST['type']==7){
		$chatroom_id=$_POST['room_id_u'];
		$chatroom_name=$_POST['room_name_u'];
		$chatroom_password=$_POST['room_password_u'];
		if($chatroom_name == ''){
			$errorMSG .= "Name is required!";
			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
		}else{
			$sql = "UPDATE chatroom SET chatroom_name='$chatroom_name',
									chatroom_password='$chatroom_password'
									WHERE chatroom_id='$chatroom_id' ";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
			} 
			else {
				$errorMSG .= mysqli_error($conn);
				echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
			}
			mysqli_close($conn);
		}
		
	}
}
?>