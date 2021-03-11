<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Room List Page</title>
    <?php 
	 include '../db/database.php';
	//  include '../header.php';
	 include '../bar.php';
	//  print_r($_SESSION);
	 $team_id = $_SESSION['team_id'];
    ?>
	
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link href="../css/dataTables.bootstrap.css" rel="stylesheet">
	<link href="../css/dataTables.responsive.css" rel="stylesheet">
	<script src="ajax.js"></script> -->
</head>
<body class="d-flex flex-column min-vh-100">
<div class="container">
	<div class="card" style="height:50px;">
		<div class="row">
			<h4 class="mt-2 ml-4"><strong><span class="fas fa-list"></span> List of Chat Rooms</strong></h4>
			<div class="ml-2" style="margin-right:10px; margin-top:7px;">
				<a href="#add_chatroom" data-toggle="modal" class="btn btn-primary"><span class="fa fa-plus"></span> Add</a>
			</div>
		</div>
	</div>
	<table width="100%" class="table table-striped table-bordered table-hover" id="chatRoom">
        <thead>
            <tr>
                <th>Chat Room Name</th>
				<th>Date Created</th>
				<th><span class="fas fa-lock"></span> Password || <span class="fas fa-male"></span> Member</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$query=mysqli_query($conn,"select * from chatroom where team_id ='$team_id' order by chatroom_date_created desc");
			while($row=mysqli_fetch_array($query)){
				$password= $row['chatroom_password'];
			?>
			<tr>
				<input type="hidden" value="
				<?php
				$usera=array();
				$m=mysqli_query($conn,"select * from chatmember where chatroom_id='".$row['chatroom_id']."'");
				while($mrow=mysqli_fetch_array($m)){
					$usera[]=$mrow['user_id'];
				}
				//1 member
				if (in_array($_SESSION['user_id'], $usera)){
					echo "1";
				}	
				else{
					//2 not member w/ pass
					if (!empty($row['chatroom_password'])){
						echo "2";
					}
					else{
					//3 not member w/o pass
						echo "3";
					}
				}
				?>
				
				"  id="status<?php echo $row['chatroom_id']; ?>">
				<td>
					<?php
					$num=mysqli_query($conn,"select * from chatmember where chatroom_id='".$row['chatroom_id']."'");
					?>
					<span class="badge badge-pill badge-dark"><?php echo mysqli_num_rows($num); ?></span> <?php echo $row['chatroom_name']; ?>
				</td>
				<td><?php echo date('M d, Y - h:i A', strtotime($row['chatroom_date_created'])); ?></td>
				<td><button value="<?php echo $row['chatroom_id']; ?>" class="btn btn-info join_chat"><span class="glyphicon glyphicon-comment"></span> Join</button>
					
					<?php if (!empty($password)){ ?>
							<span class="fas fa-lock"></span>
					<?php } ?>
					<?php 
					$qq=mysqli_query($conn,"select * from chatmember where chatroom_id='".$row['chatroom_id']."' and user_id='".$_SESSION['user_id']."'");
					if (mysqli_num_rows($qq)>0){
					?>
						<span class="fas fa-male"></span>
					<?php }
					?>
				</td>
			</tr>
			<?php
			}
		?>
        </tbody>
    </table>                     
</div>

<!-- Add Chat Room -->
<div class="modal fade" id="add_chatroom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add New Chat Room</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Chat Room Name:</span>
						<input type="text" style="width:350px;" class="form-control" id="chat_name" required>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Password:</span>
						<input type="text" style="width:350px;" class="form-control" id="chat_password">
					</div>
                </div> 
				</div>
                <div class="modal-footer">
					<input type="hidden" style="width:350px;" class="form-control" id="team_id" value="<?php echo $_SESSION['team_id']?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="button" class="btn btn-primary" id="addchatroom"><span class="glyphicon glyphicon-check"></span> Add</button>
				</form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- /.modal -->

<!-- Chat Room Password -->
<div class="modal fade" id="join_chat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Input Password</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="confirm_password.php">
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Password:</span>
						<input type="text" style="width:350px;" class="form-control" name="chat_pass" required>
						<input type="hidden" id="chatid" name="chatid">
					</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Confirm</button>
				</form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- /.modal -->
</body>
</html>
<?php include '../footer.php';?>