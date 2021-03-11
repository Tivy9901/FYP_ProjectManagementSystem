<?php
	
	include '../db/database.php';
	session_start();
	$id=$_SESSION['room_id'];
		
		$query=mysqli_query($conn,"select * from `chatmessage` left join `user` on user.user_id=chatmessage.user_id where chatroom_id='$id' order by chatmessage_date_created asc") or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		?>	
		<div>
			<img src="../user/images/<?php echo $row['user_profileImage'];?>" style="height:30px; width:30px; position:relative; top:15px; left:10px;">
			<span style="font-size:10px; position:relative; top:7px; left:15px;"><i><?php echo date('M-d-Y h:i A',strtotime($row['chatmessage_date_created'])); ?></i></span><br>
			<span style="font-size:11px; position:relative; top:-2px; left:50px;"><strong><?php echo $row['user_name']; ?></strong>: <?php echo $row['chatmessage']; ?></span><br>
		</div>
		<div style="height:5px;"></div>
		<?php
		}
		
?>

