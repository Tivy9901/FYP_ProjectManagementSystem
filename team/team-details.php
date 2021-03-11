<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Details Page</title>
    <?php   include '../db/database.php';
			include '../bar.php';
			if(!isset($_SESSION)) { session_start(); }
            if(isset($_GET['t_id'])){
                $t_id = mysqli_real_escape_string($conn, $_GET['t_id']);
                $_SESSION['team_id'] = $t_id;
                $user_id =$_SESSION['user_id'];
                $sql = "SELECT * FROM team WHERE team_id = $t_id";
                $result = mysqli_query($conn, $sql);
                $team = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
				$sql2 = "SELECT u.* FROM user u JOIN team_list tl ON tl.user_id= u.user_id WHERE tl.team_id='$t_id' ";
                $result2 = mysqli_query($conn, $sql2);
				$users = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                mysqli_free_result($result2);
			}
			$_SESSION['team_id'] = $t_id;
    ?>
	<style>
		.headerAdd {
			display: flex;
			align-items: center;
		}

		.headerAdd::after {
			content: '';
			flex: 1;
			margin-left: 1rem;
			height: 0.5px;
			background-color: #000;
		}
		.avatar {
			vertical-align: middle;
			width: 50px;
			height: 50px;
			border-radius: 50%;
			}
	</style>
</head>
<body class="d-flex flex-column min-vh-100">
	<div class="jumbotron container-fluid" style="text-align:center">
		<div class="row">
			<h3 class="col-3">
			<a href="../team/index.php"><i class="fa fa-arrow-circle-o-left"></i> Go to Team</a>
			</h3>
			<h1 class="col-6 text-center"><?php echo $team['team_name']?></h1>
			<h3 class="col-3">
			<a href="../project/index.php"><i class="fa fa-arrow-circle-o-right"></i> Go to Project </a>
			</h3>
		</div>
		<div class="row">
			<h3 class="col-3">
			</h3>
			<h2 class="col-6 text-center">   
			<?php echo htmlspecialchars($team['team_description'])?>
			</h2>
			<h3 class="col-3">
			</h3>
		</div>
	</div>
	</div>
	<div class="container">
		<div class="header">
			<h3 class="headerAdd">Team Member
			<?php if($user_id==$team['user_id']){ ?>
				<button class="btn btn-primary btn-sm ml-3" id="add_user_team"  data-toggle="modal" data-target="#addUserModal">
				<i class="fas fa-plus"></i> Add User</button>
				<button class="btn btn-danger btn-sm ml-3" id="remove_user"  data-toggle="modal" data-target="#removeUserModal">
				<i class="fas fa-minus"></i> Remove User</button>
				<?php if($team['team_notice'] !== null):?>
					<button id="showNotice" data-toggle="modal" class="btn" data-target="#noticeModal" 
							data-id="<?php echo $team['team_id'];?>" data-notice="<?php echo $team['team_notice'];?>">
							<i class="fas fa-envelope fa-2x"></i><span class="badge">1</span>
					</button>
				<?php else:?>
					<button id="showNotice" data-toggle="modal" class="btn" data-target="#noticeModal" >
						<i class="fas fa-envelope  fa-2x"></i><span class="badge badge-light"></span>
					</button>
				<?php endif;?>
			</h3>
			<?php }else if($user_id !=$team['user_id']){ ?>
				<button class="btn btn-danger btn-sm ml-3" id="leave_team"  data-toggle="modal" data-target="#leaveTeamModal">Leave team</button>
				<?php if($team['team_notice'] !== null):?>
					<button id="showNotice" data-toggle="modal" class="btn" data-target="#noticeModal" 
							data-id="<?php echo $team['team_id'];?>" data-notice="<?php echo $team['team_notice'];?>">
							<i class="fas fa-envelope fa-2x"></i><span class="badge">1</span>
					</button>
				<?php else:?>
					<button id="showNotice" data-toggle="modal" class="btn" data-target="#noticeModal" >
						<i class="fas fa-envelope  fa-2x"></i><span class="badge badge-light"></span>
					</button>
				<?php endif;?>
			<?php } ?>
			</h3>
		</div>
	</div>
	<!-- team member list -->
    <div class="container">
        <div class="row">
    	<?php foreach($users as $user){ ?>
            <div class="card mr-2 mt-2 ml-3" style="width: 15rem;">
                <div class="card-body">
                    <div class="card-title">
						<img src="../user/images/<?php echo $user['user_profileImage'];?>" style="border:1px solid" alt="Avatar" class="avatar">
						<?php echo htmlspecialchars($user['user_name']); ?>
						<?php if ($user['user_id'] == $team['user_id']):?>
						<?php else:?>
						<?php endif;?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
		<br>
		<hr style="border:1px solid">
		<div class="card text-center mb-5 mt-5">
			<div class="card-header">
			<br>
			</div>
			<div class="card-body">
				<h5 class="card-title">Quick Chat</h5>
				<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				<a href="../chatroom/index.php" class="btn btn-primary">Chat Here!</a>
			</div>
			<div class="card-footer text-muted">
				<br>
			</div>
		</div>

	</div>
	
    <!--add user Modal -->
    <div id="addUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="add_user_team_form">
					<div class="modal-header">						
						<h4 class="modal-title">Add user</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Enter username</label>
							<input type="text" id="user_username" name="user_username" class="form-control" required>
						</div>				
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="88" name="type">
                        <input type="hidden" value="<?php echo $t_id ;?>" name="team_id">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add-user-team">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- leave Modal HTML -->
	<div id="leaveTeamModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Leave team</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="team_id_leave" name="id" value="<?php echo $team['team_id']?>" class="form-control">
                        <input type="hidden" id="user_id_leave" name="id" value="<?php echo $user_id?>" class="form-control">										
						<p>Are you sure you want to leave?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="leaveteam">Leave</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- remove user Modal HTML -->
	<div id="removeUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Remove</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="team_id_remove" name="id" value="<?php echo $team['team_id']?>" class="form-control">
                        <select class="form-control" name="user_id" id="user_id_remove">
							<?php foreach($users as $user){
								if($user['user_id'] == $team['user_id']){
							?>
								<option value=<?php echo $user['user_id']?> disabled><?php echo $user['user_name'];?></option>
							<?php }else{?>
								<option value=<?php echo $user['user_id']?>><?php echo $user['user_name'];?></option>
							<?php }}?>
						</select>
						<p>Are you sure you want to remove this user?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="removeuser">Remove</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- show notice modal -->
	<div id="noticeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Notice</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<?php 
								$t_id = $team['team_id'];
								$sql = "SELECT * FROM team WHERE team_id = '$t_id'";
								$res = mysqli_query($conn,$sql);
								$notice = mysqli_fetch_all($res,MYSQLI_ASSOC);
							?>
							<?php foreach ($notice as $notices) {?>
								<h4 style="text-align:center"><?php echo $notices['team_notice'];?></h4>
								<?php if($notices['team_notice'] == NULL):?>
									<h4 style="text-align:center">No notice!</h4>
								<?php endif;?>
							<?php }?>
							
						</div>			
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>
<?php include '../footer.php';?>