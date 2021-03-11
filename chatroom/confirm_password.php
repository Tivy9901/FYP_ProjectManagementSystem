<?php
	if(!isset($_SESSION)) {session_start();} 
	include '../db/database.php';
	include '../header.php';
	$cid=$_POST['chatid'];
	$pass=$_POST['chat_pass'];
	
	$query=mysqli_query($conn,"select * from chatroom where chatroom_id='$cid'");
	$row=mysqli_fetch_array($query);
	
	if ($row['chatroom_password']==$pass){
		mysqli_query($conn,"insert into chatmember (user_id, chatroom_id) values ('".$_SESSION['user_id']."', '$cid')");
		header('location: chatroom.php?id='.$cid);
	}
	
	else{
		?>
		<script>
			window.alert('Incorrect Password!');
			window.history.back();
		</script>
		<?php
	}
?>