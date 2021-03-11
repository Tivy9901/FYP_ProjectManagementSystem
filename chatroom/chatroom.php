<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Room</title>
    <?php
    include '../db/database.php';
    // include '../header.php';
    include '../bar.php';
    $id=$_REQUEST['id'];
    $_SESSION['room_id']=$id;
	$t_id=$_SESSION['team_id'];
	$chatq=mysqli_query($conn,"select * from chatroom where chatroom_id='$id'");
	$chatrow=mysqli_fetch_array($chatq);
	
    $cmem=mysqli_query($conn,"select * from chatmember where chatroom_id='$id'");
    // print_r($_SESSION);
    ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <div class="container">
            <div class="card" style="border: none;">
				<span class="text-center" style="font-size:20px;">
                    <strong>
                        <a href="#show_member" data-toggle="modal" style="text-decoration: none;">
                            <span class="fas fa-male"></span>
                            <span class="badge badge-pill badge-dark"><?php echo mysqli_num_rows($cmem); ?></span>
                        </a> 
                    <?php echo $chatrow['chatroom_name']; ?>
                    </strong>
                </span>
                <hr>
					<?php
						if ($chatrow['user_id']==$_SESSION['user_id']){
							?>
                            <div class="container text-center mb-1">
							<a href="index.php" class="btn btn-primary"><span class="fas fa-arrow-left"></span> Lobby</a>
							<a href="#delete_room" data-toggle="modal" class="btn btn-danger">Delete Room</a>
                            <button class="btn btn-primary" 
                                id="updateRoom"
                                data-id="<?php echo $chatrow['chatroom_id']; ?>"
                                data-name="<?php echo $chatrow['chatroom_name']; ?>"
                                data-password="<?php echo $chatrow['chatroom_password'];?>"
                                data-toggle="modal" 
                                data-target="#update_room">
                            Update</button>
							<a href="#add_member" data-toggle="modal" class="btn btn-primary">Add Member</a>
                            </div>
							<?php
						}
						else{
							?>
                            <div class="container text-center mb-1">
							<a href="index.php" class="btn btn-primary"><span class="fas fa-arrow-left"></span> Lobby</a>
							<a href="#leave_room" data-toggle="modal" class="btn btn-warning">Leave Room</a>
							</div>
                            <?php
						}
					?>
				
			</div>
        </div>
			<div class="container mt-2">
				<div class="card " style="height: 400px;">
					<div style="height:10px;"></div>
					<span style="margin-left:10px;">Welcome to Chatroom</span><br>
					<span style="font-size:10px; margin-left:10px;"><i>Note: Avoid using foul language and hate speech to avoid banning of account</i></span>
					<div style="height:10px;"></div>
					<div id="chat_area" style="margin-left:10px; max-height:320px; overflow-y:scroll;">
					</div>
				</div>
				
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Type message..." id="chat_msg">
                    <input type="hidden" class="form-control" id="chatroom_id" value="<?php echo $id; ?>">
                    <input type="hidden" class="form-control" id="user_id" value="<?php echo $_SESSION['user_id']; ?>">
					<span class="input-group-btn">
					<button class="btn btn-success" type="submit" id="send_msg">
					<span class="fas fa-comment"></span> Send
					</button>
					</span>
				</div>
				
			</div>			
		</div>


<!-- Leave Room -->
    <div class="modal fade" id="leave_room" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Leaving Room...</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
					<h3><center>Are you sure?</center></h3>
					<span style="font-size: 11px;"><center><i>Note: Once you leave the room and you wanted to come back, password is needed for a locked room.</i></center></span>
                    <input type="hidden" class="form-control" id="chatroom_id" value="<?php echo $id; ?>">
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fas fa-ban"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning" id="confirm_leave"><span class="fas fa-check"></span> Leave</button>
				
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- /.modal -->
        
<!-- Delete Room -->
<div class="modal fade" id="delete_room" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Deleting Room...</h4></center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
					<h3><center>Are you sure?</center></h3>
                    <input type="hidden" class="form-control" id="chatroom_id" value="<?php echo $id; ?>">
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-danger" id="confirm_delete"><span class="glyphicon glyphicon-check"></span> Delete</button>
				
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- /.modal -->
    
<!-- Add Member -->
    <div class="modal fade" id="add_member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Add Member</h4></center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
					
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Select:</span>
						<select style="width:350px;" class="form-control" name="user" id="user_id_add">
							<?php
							// include('../conn.php');
								$mem=array();
								$um=mysqli_query($conn,"select * from `chatmember` where chatroom_id='$id'");
								while($umrow=mysqli_fetch_array($um)){
									$mem[]=$umrow['user_id'];
								}
								$users=implode($mem, "', '");
								
								$u=mysqli_query($conn,"select * from user join team_list on team_list.user_id= user.user_id where team_list.team_id=$t_id");
								if(mysqli_num_rows($u)<1){
									?>
									<option value="">No User Available</option>
									<?php
								}
								else{
								while($urow=mysqli_fetch_array($u)){
									?>
										<option value="<?php echo $urow['user_id']; ?>"><?php echo $urow['user_name']; ?></option>	
									<?php
								}
								}
							
							?>
						</select>
					</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-primary" id="add_new_member"><span class="glyphicon glyphicon-check"></span> Add</button>
					
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- /.modal -->

<!-- show member -->
<div class="modal fade" id="show_member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Chat room member list</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
                <?php 
                $sql = "SELECT u.* FROM user u JOIN chatmember cm ON cm.user_id= u.user_id WHERE cm.chatroom_id='$id' ";
                $result = mysqli_query($conn, $sql);
                $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $sql2 = "SELECT * FROM chatroom WHERE chatroom_id='$id' ";
                $result2 = mysqli_query($conn, $sql2);
                $room = mysqli_fetch_assoc($result2);
                // print_r($users);
                ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($users as $user){ ?>
                            <tr>
                            <td><?php echo htmlspecialchars($user['user_name']); ?></td>
                            <?php if($user['user_id']==$room['user_id']){ ?>
                                <td>Room Creator</td>
                            <?php }else{ ?>
                                <td>Room Member</td>
                            <?php } ?>
                            <?php if($_SESSION['user_id']==$room['user_id']){ ?>
                                <?php if($_SESSION['user_id']==$user['user_id']){ ?>
                                <td>
                                </td>
                                <?php }else{ ?>
                                    <td><button class="btn btn-danger btn-sm" id="delete_user" data-uid="<?php echo $user['user_id']; ?>" data-toggle="modal" data-target="#deleteUserModal"><i class="fa fa-user-slash"></i> Kick</button></td>
                                <?php } ?>
                            <?php }else{ ?>
                                <td></td>
                            <?php } ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"></span>Close</button>				
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- /.modal -->

<!-- Delete Modal HTML -->
<div id="deleteUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Remove Chat Member</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="user_id_d" name="id" class="form-control">					
						<p>Are you sure you want to remove this user?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="deleteUser">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

                <div id="update_room" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="roomdetailupdate">
                                <div class="modal-header">						
                                    <h4 class="modal-title">Update Chat Room Details</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="room_id" name="room_id_u" class="form-control" required>					
                                    <div class="form-group">
                                        <label>Chat Room Name</label>
                                        <input type="text" id="room_name" name="room_name_u" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Chat Room Password</label>
                                        <input type="text" id="room_password" name="room_password_u" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="hidden" value="7" name="type">
                                    <button type="button" class="btn btn-info" id="btn-updateChatRoom">Update!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

</html>
<?php include '../footer.php';?>