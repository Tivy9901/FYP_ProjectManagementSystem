<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>task Details Page</title>
    <?php   include '../../db/database.php';
            include '../../bar.php';
            include '../../sidebar.php';
            if (!isset($_SESSION)){session_start();} 
            $t_id = $_SESSION['team_id'];
            $user_id = $_SESSION['user_id'];
            if(isset($_GET['task_id'])){
                $task_id = mysqli_real_escape_string($conn, $_GET['task_id']);
                $sql = "SELECT * FROM task WHERE task_id = '$task_id'";
                $result = mysqli_query($conn, $sql);
                $task = mysqli_fetch_assoc($result);
                mysqli_free_result($result);

                $sqlAss = "SELECT * FROM task_assign WHERE task_id = '$task_id' ";
                $resAss = mysqli_query($conn,$sqlAss);
                $Ass = mysqli_fetch_assoc($resAss);

                $sql1 = "SELECT * FROM team WHERE team_id=  '$t_id' ";
                $res2 = mysqli_query($conn,$sql1);
                $team = mysqli_fetch_assoc($res2);

            }
    ?>
    <link rel="stylesheet" href="../../sidebar.css">
</head>
<body class="d-flex flex-column min-vh-100"> 
                            <h1 class="text-center">    
                                <?php echo $task['task_name'];?>
                                <br>
                                <!-- <?php echo $task['task_description'];?> -->
                            </h1>
                                <hr class="text-center" style="width:50rem;text-align:center;margin-left:25%;border:1px solid">
                                <div class="container d-flex justify-content-center" style="width: 50rem;">
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                        <?php if($task['task_completed'] == 0) :?>
                                            <li class="list-group-item list-group-item-success rounded mb-2">
                                                <!-- <div class="text-center">
                                                    <h6> <?php echo htmlspecialchars($task['task_name']); ?></h6>
                                                </div> -->
                                                <div class="text-center">
                                                    <h6 class="text-center">Assign to</h6>
                                                </div>
                                                <div class="row justify-content-center">
                                                <?php
                                                    $task_id = $task['task_id'];             
                                                    $sql4 = "SELECT u.* FROM user u JOIN task_assign ta ON ta.user_id=u.user_id WHERE ta.task_id=$task_id "; 
                                                    $result4 = mysqli_query($conn, $sql4);
                                                    $users = mysqli_fetch_all($result4, MYSQLI_ASSOC);
                                                ?>
                                                <?php foreach($users as $user){ ?>
                                                    <div class="d-inline-flex pl-1 pt-1 pr-1 ml-1 border border-dark rounded">
                                                    <h6 style="text-align:center"><i class="far fa-id-badge"></i> <?php echo ($user['user_name']); ?></h6>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <hr>
                                        <div class="text-center">
                                            <h6>Dead line</h6>
                                            <h6> <?php echo htmlspecialchars($task['task_deadline']); ?></h6>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <h6>Priority</h6>
                                            <h6> <?php echo htmlspecialchars($task['task_priority']); ?></h6>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <h6>Note</h6>
                                            <h6> <?php echo htmlspecialchars($task['task_description']); ?></h6>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <h6>Creator</h6>
                                            <?php
                                                $userId = $task['user_id'];
                                                $sqlTask = "SELECT user_username FROM user WHERE user_id = '$userId' " ;
                                                $resTask = mysqli_query($conn,$sqlTask);
                                                $taskCreator = mysqli_fetch_assoc($resTask);
                                            ?>
                                            <h6> <?php echo $taskCreator['user_username']; ?></h6>
                                        </div>
                                        <hr>
                                        <button class="btn btn-danger btn-sm" id="mark_undone" data-tid="<?php echo $task['task_id']; ?>">
                                            <i class="fa fa-times"></i> Mark as undone</button>
                                        <?php if($user_id == $task['user_id'] || $user_id == $team['user_id']):?>
                                            <button class="btn btn-warning btn-sm" id="updateTaskbtn" 
                                            data-id="<?php echo $task['task_id']; ?>"
                                            data-name="<?php echo $task['task_name']; ?>"
                                            data-desc="<?php echo $task['task_description'];?>"
                                            data-deadline="<?php echo $task['task_deadline'];?>"
                                            data-priority="<?php echo $task['task_priority'];?>"  
                                            data-toggle="modal" 
                                            data-target="#updateTask"><i class="fa fa-edit"></i> Edit</button>
                                        <?php endif;?>
                                        <button class="btn btn-danger btn-sm" id="assign" data-toggle="modal" data-target="#assignUserModal">
                                            <i class="fa fa-badge"></i> Assign/Remove user</button>                                    
                                    </li>
                                <?php else : ?>
                                    <li class="list-group-item list-group-item-dark rounded mb-2">
                                        <!-- <div class="text-center">
                                            <h6> <?php echo htmlspecialchars($task['task_name']); ?></h6>
                                        </div> -->
                                        <div class="text-center">
                                            <h6 class="text-center">Assign to</h6>
                                        </div>
                                            <div class="row justify-content-center">
                                                <?php         
                                                    $sql5 = "SELECT u.* FROM user u JOIN task_assign ta ON ta.user_id=u.user_id WHERE ta.task_id='$task_id'"; 
                                                    $result5 = mysqli_query($conn, $sql5);
                                                    $users = mysqli_fetch_all($result5, MYSQLI_ASSOC);
                                                ?>
                                                <?php foreach($users as $user){ ?>
                                                    <div class="d-inline-flex pl-1 pt-1 pr-1 ml-1 border border-dark rounded">
                                                    <h6><i class="far fa-id-badge"></i> <?php echo ($user['user_name']); ?></h6>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <hr>
                                        <div class="text-center">
                                            <h6>Dead line</h6>
                                            <h6> <?php echo htmlspecialchars($task['task_deadline']); ?></h6>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <h6>Priority</h6>
                                            <h6> <?php echo htmlspecialchars($task['task_priority']); ?></h6>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <h6>Note</h6>
                                            <h6> <?php echo htmlspecialchars($task['task_description']); ?></h6>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <h6>Creator</h6>
                                            <?php
                                                $userId = $task['user_id'];
                                                $sqlTask = "SELECT user_username FROM user WHERE user_id = '$userId' " ;
                                                $resTask = mysqli_query($conn,$sqlTask);
                                                $taskCreator = mysqli_fetch_assoc($resTask);
                                            ?>
                                            <h6> <?php echo $taskCreator['user_username']; ?></h6>
                                        </div>
                                        <hr>
                                        <button class="btn btn-success btn-sm" id="mark_done" data-tid="<?php echo $task['task_id']; ?>"><i class="fas fa-check"></i> Mark as done</button>
                                        <?php if($user_id == $task['user_id'] || $user_id == $team['user_id']):?>
                                        <button class="btn btn-warning btn-sm" id="updateTaskbtn" 
                                        data-id="<?php echo $task['task_id']; ?>"
                                        data-name="<?php echo $task['task_name']; ?>"
                                        data-desc="<?php echo $task['task_description'];?>"
                                        data-deadline="<?php echo $task['task_deadline'];?>"
                                        data-priority="<?php echo $task['task_priority'];?>"  
                                        data-toggle="modal" 
                                        data-target="#updateTask"><i class="fa fa-edit"></i> Edit</button>
                                        <?php endif;?>
                                        
                                        <button class="btn btn-danger btn-sm" id="assign" data-toggle="modal" data-target="#assignUserModal"><i class="fa fa-badge"></i> Assign/Remove user</button>                        
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
    <!-- assign/remove user task -->
    <div id="assignUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="assignUser_form">
					<div class="modal-header">						
						<h4 class="modal-title">Assign/Remove User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Assigned User</label>
							<div class="row">
                                 <?php         
                                    $sql5 = "SELECT u.* FROM user u JOIN task_assign ta ON ta.user_id=u.user_id WHERE ta.task_id='$task_id'"; 
                                    $result5 = mysqli_query($conn, $sql5);
                                    $users = mysqli_fetch_all($result5, MYSQLI_ASSOC);
                                ?>
                                <?php foreach($users as $user){ ?>
                                    <div class="pl-1 pt-1 pr-1 ml-2 border border-dark rounded">
                                    <h6><i class="far fa-id-badge"></i> <?php echo ($user['user_name']); ?>
                                    <i class="btn fas fa-times " id="ResignUser" data-uid="<?php echo ($user['user_id']); ?>" data-toggle="modal" data-target="#resignUserModal"></i>
                                    </h6>
                                    </div>
                                <?php }?>
                            </div>
						</div>
                        <hr>
                        <?php
				            $sql6 = "SELECT u.* FROM user u JOIN team_list tl ON tl.user_id= u.user_id WHERE tl.team_id='$t_id' ";
                            $result6 = mysqli_query($conn,$sql6);
                            $assign = mysqli_fetch_all($result6,MYSQLI_ASSOC);
                        ?>
                        <div class="form-group">
							<label>Assign user to task</label>
                            <input type="hidden" value="<?php echo $task_id ?>" name="task_id" id="task_id_assign">
                            <select class="form-control" name="user_id" id="user_id_assign">
                            <?php foreach($assign as $assigns) {?>
                                
                                    <option value="<?php echo $assigns['user_id'];?>"><?php echo $assigns['user_username'];?></option>
                            <?php }?>
                            </select>
						</div>	
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="104" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-asign-user">Assign</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <div id="resignUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Unassign User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="u_id_d" name="id" class="form-control">					
						<p>Are you sure you want to remove assigned user?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
                        <input type="hidden" value="<?php echo $task_id ?>" name="task_id" id="t_id">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="UnassginUser">Unassign</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <div id="updateTask" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateTaskForm">
                    <div class="modal-header">						
                        <h4 class="modal-title">Edit Task List</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="taskID" name="taskId_u" class="form-control" required>					
                        <div class="form-group">
                            <label>Task Name</label>
                            <input type="text" id="taskNAME" name="taskName_u" class="form-control" required>
                            </div>
                        <div class="form-group">
                            <label>Task Description</label>
                            <input type="text" id="taskDES" name="taskDes_u" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Priority</label>
                            <select name="taskpriority" class="custom-select">
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Deadline</label>
                            <input type="date" id="taskdeadline" name="deadline_u" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="hidden" value="97" name="type">
                            <button type="button" class="btn btn-info" id="btn-updateTask">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php include '../../footer.php';?>