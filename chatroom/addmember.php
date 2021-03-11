<?php
	if(!isset($_SESSION)) {session_start();} 
	include '../db/database.php';
	include '../header.php';
	if (isset($_POST['id'])){
		$id=$_POST['id'];
		
		$query=mysqli_query($conn,"select * from chatmember where chatroom_id='$id' and user_id='".$_SESSION['user_id']."'");
		if (mysqli_num_rows($query)<1){
			mysqli_query($conn,"insert into chatmember (chatroom_id, user_id) values ('$id', '".$_SESSION['user_id']."')");
		}
	}
?>