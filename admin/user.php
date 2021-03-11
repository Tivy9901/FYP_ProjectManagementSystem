<?php
	include '../db/database.php';
	include '../header.php';
	include 'sidebarAdmin.php';
	include 'save.php';
	if(!isset($_SESSION)) { session_start(); }
	$sql = "SELECT * FROM user ORDER BY user_username asc";
    $res = mysqli_query($conn,$sql);
    $user = mysqli_fetch_all($res, MYSQLI_ASSOC);
	$sn = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
	</style>
    <title>Admin Panel - User Manage</title>
</head>
<body>
	<?php include 'error.php';?>			
	<div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
            <h1>User
            <button class="btn btn-primary" data-target="#addUserModal" data-toggle="modal">Add New</button>
			</h1>
        </div>
        <div class="w3-container">
       		<br>
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>User Name</th>
					<th>Email</th>
					<th>Phone Number</th>
                    <th>User Type</th>
                    <th>Action</th>
                </tr>
			<?php foreach($user as $users){ ?>    
				<?php if($users['user_disable'] == 0) :?>
					<tr>
						<td><?php echo $sn++; ?></td>
						<td><?php echo $users['user_name']; ?></td>
						<td><?php echo $users['user_username']; ?></td>
						<td><?php echo $users['user_email'];?></td>
						<td><?php echo $users['user_phoneNumber'];?></td>
						<td>
							<?php
								$_SESSION['u_type'] = $users['user_type'];
								if($_SESSION['u_type']==1){
									echo "user";
								}else if($_SESSION['u_type']==2){
									echo "admin";
								}
							?>
						</td>
						<td>
							<button class="btn btn-primary btn-sm" 
									id="updateUser" 
									data-id="<?php echo $users['user_id']; ?>"
									data-name="<?php echo $users['user_name']; ?>"
									data-username="<?php echo $users['user_username'];?>" 
									data-password="<?php echo $users['user_password']; ?>"
									data-email="<?php echo $users['user_email']; ?>"
									data-phoneNumber="<?php echo $users['user_phoneNumber']; ?>"
									data-type="<?php echo $users['user_type'];?>"
									data-toggle="modal" 
									data-target="#updateUserModal">
							Update</button>
							<button class="btn btn-danger btn-sm" id="disable" 
									data-id="<?php echo $users['user_id']; ?>">
									<i class="fas fa-ban"></i>
							Disable</button>
						</td>
					</tr>
				<?php elseif($users['user_disable'] == 1) :?>
					<tr>
						<td><?php echo $sn++; ?></td>
						<td><?php echo $users['user_name']; ?></td>
						<td><?php echo $users['user_username']; ?></td>
						<td><?php echo $users['user_email'];?></td>
						<td><?php echo $users['user_phoneNumber'];?></td>
						<td>
							<?php
								$_SESSION['u_type'] = $users['user_type'];
								if($_SESSION['u_type']==1){
									echo "user";
								}else if($_SESSION['u_type']==2){
									echo "admin";
								}
							?>
						</td>
						<td>
							<button class="btn btn-primary btn-sm" 
									id="updateUser" 
									data-id="<?php echo $users['user_id']; ?>"
									data-name="<?php echo $users['user_name']; ?>"
									data-username="<?php echo $users['user_username'];?>" 
									data-password="<?php echo $users['user_password']; ?>"
									data-email="<?php echo $users['user_email']; ?>"
									data-phoneNumber="<?php echo $users['user_phoneNumber']; ?>"
									data-type="<?php echo $users['user_type'];?>"
									data-toggle="modal" 
									data-target="#updateUserModal">
							Update</button>
							<button class="btn btn-success btn-sm" id="enable" 
									data-id="<?php echo $users['user_id']; ?>">
									<i class="fas fa-toggle-on"></i>
							Enable</button>
						</td>
					</tr>
					<?php endif;?>
			<?php }?>
            </table>
        </div>
	</div>
    <!-- add modal -->
	<div id="addUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="addUserForm">
					<div class="modal-header">		
						<h4 class="modal-title">Add New User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="name" name="name_i" class="form-control" required>
						</div>
						<div class="form-group">
							<label>User Name</label>
							<input type="text" id="username" name="username_i" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" id="email" name="email_i" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Phone Number</label>
							<input type="number" id="phonNumber" name="phoneNumber_i" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" id="password" name="password_i" class="form-control" required>
						</div>
						<div class="form-group">
							<label>User Type</label>
							<select name="type_i" class="custom-select">
								<option value="1">user</option>
								<option value="2">admin</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" value="10" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="btn-add-user">Add New</button>
					</div>
				</form>
			</div>
		</div>	
	</div>
    <!-- delete user modal-->
    <div id="deleteUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="user_id" name="id" class="form-control">					
						<p>Are you sure you want to delete this user?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="hidden" value="4" name="type">
						<button type="button" class="btn btn-danger" id="btn-delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
    <!-- edit user modal -->
    <div id="updateUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="updateUserForm">
					<div class="modal-header">						
						<h4 class="modal-title">Edit User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="u_id" name="id_u" class="form-control" required>					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="u_name" name="name_u" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>User Name</label>
							<input type="text" id="u_username" name="username_u" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" id="u_email" name="email_u" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Phone Number</label>
							<input type="number" id="u_phoneNumber" name="phoneNumber_u" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Password</label>
							<input type="password" id="u_password" name="password_u" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>User Type</label>
                            <select name="user_type_u" class="custom-select"> 
								<option value="1">user</option>
								<option value="2">admin</option>
                            </select>
						</div>								
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
    					<input type="hidden" value="3" name="type">
						<button type="button" class="btn btn-info" id="btn-update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
