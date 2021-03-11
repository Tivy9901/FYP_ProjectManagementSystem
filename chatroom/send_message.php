<?php
	include '../db/database.php';
	if(!isset($_SESSION)) {session_start();} 
	if(isset($_POST['msg'])){		
		$msg=$_POST['msg'];
		$id=$_POST['id'];
		mysqli_query($conn,"insert into `chatmessage` (chatroom_id, chatmessage, user_id) values ('$id', '$msg' , '".$_SESSION['user_id']."'") or die(mysqli_error());
	}
?>