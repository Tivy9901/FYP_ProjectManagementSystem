<?php 
    include '../db/database.php';
    include '../bar.php';
    include '../sidebar.php';
    if (!isset($_SESSION)){session_start();} 
    $user_id = $_SESSION['user_id'];
    $tasklist_id = ($_GET['tl_id']);
    $team_id=$_SESSION['team_id'];
    $sql = "SELECT * FROM task_list WHERE tasklist_id ='$tasklist_id'";
    $result = mysqli_query($conn, $sql);
    $list = mysqli_fetch_assoc($result);

    $sql2 = "SELECT * FROM team WHERE team_id ='$team_id'";
    $result2 = mysqli_query($conn, $sql2);
    $team = mysqli_fetch_assoc($result2);

    $sql3 = "SELECT * FROM task WHERE tasklist_id='$tasklist_id' ";
    $result3 = mysqli_query($conn, $sql3);
    $tasks = mysqli_fetch_all($result3, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sidebar.css">
    <title>To-dos</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <br>
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="card mr-4 mb-2" style="width: 50rem;">
                <!-- list detail -->
                    <div class="card-header text-center">
                        <!-- <div class="row" style="text-align:center">
                            <div class="col-sm-4 mt-4">
                                <button class="btn btn-primary btn-sm" id="new_task" 
                                data-toggle="modal" data-target="#addTaskInList"><i class="fa fa-plus"></i> Add new Task</button>
                            </div>
                            <div class="col-sm-4"><h1></h1></div>
                            <div class="col-sm-4"></div>
                        </div>  -->
                        <h1><?php echo htmlspecialchars($list['tasklist_name']); ?></h1>
                        <h4 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($list['tasklist_description']); ?></h4>
                        <button class="btn btn-primary btn-sm mt-2" id="new_task" 
                                data-toggle="modal" data-target="#addTaskInList"><i class="fa fa-plus"></i> Add new Task</button>
                    </div>
                <!-- list detail -->
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                        <?php foreach($tasks as $task){ ?>
                        <!-- undone -->
                            <?php if($task['task_completed'] == 0) :?>
                                <li class="list-group-item list-group-item-success rounded mb-2">
                                    <div style="text-align:center">
                                        <h1><?php echo htmlspecialchars($task['task_name']); ?></h1>
                                    </div> 
                                    <div class="text-center">
                                        <h3> <?php echo htmlspecialchars($task['task_description']); ?></h3>
                                        <hr>
                                    </div>
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
                                            <h6><i class="far fa-id-badge"></i> <?php echo ($user['user_name']); ?></h6>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                    <?php echo $task['task_id'];?>
                                        <h6>Dead line</h6>
                                        <h6> <?php echo htmlspecialchars($task['task_deadline']); ?></h6>
                                    </div>
                                    <hr>
                                    <div class="row" style="text-align:center">
                                        <div class="col-sm-10"></div>
                                        <div class="col-sm-1">
                                    <?php if($task['user_id'] == $user_id || $team['user_id'] == $user_id):?>
                                        <button class="btn btn btn-sm" id="delete_todo" 
                                            data-id="<?php echo $task['task_id']; ?>"
                                            data-toggle="modal" data-target="#deleteTodoModal"><i class="fa fa-trash-o" style="font-size:24px;color:red"></i> 
                                        </button>
                                    <?php endif;?>
                                        </div>
                                        <div class="col-sm-1">
                                        <a href="task/task.php?task_id=<?php echo $task['task_id'];?>"><i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </li>
                        <!-- done -->
                            <?php else : ?>
                                <li class="list-group-item list-group-item-dark rounded mb-2">
                                    <div style="text-align:center">
                                    <h1><?php echo htmlspecialchars($task['task_name']); ?></h1>
                                    </div> 
                                    <div class="text-center">
                                        <h3> <?php echo htmlspecialchars($task['task_description']); ?></h3>
                                        <hr>
                                    </div>
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
                                    <div class="row" style="text-align:center">
                                        <div class="col-sm-10"></div>
                                        <div class="col-sm-1">
                                    <?php if($task['user_id'] == $user_id || $team['user_id'] == $user_id):?>
                                        <button class="btn btn btn-sm" id="delete_todo" 
                                            data-id="<?php echo $task['task_id']; ?>"
                                            data-toggle="modal" data-target="#deleteTodoModal"><i class="fa fa-trash-o" style="font-size:24px;color:red"></i> 
                                        </button>
                                    <?php endif?>
                                        </div>
                                        <div class="col-sm-1">
                                        <a href="task/task.php?task_id=<?php echo $task['task_id'];?>"><i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    
    <div id="addTaskInList" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
            <form id="addTaskInListForm">
                <div class="modal-header">						
                    <h4 class="modal-title">Add New Task</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Task Name</label>
                        <input type="text" id="name" name="taskName_i" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Task Description</label>
                        <input type="text" id="username" name="taskDes_i" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <select name="priority_i" class="custom-select">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deadline</label>
                        <input type="date" id="deadline" name="deadline_i" class="form-control" required>
                    </div>
                </div>
                    <div class="modal-footer">
                        <input type="hidden" name="listId_i" value="<?php echo $tasklist_id ?>">
                        <input type="hidden" name="userId_i" value="<?php echo $user_id ?>">
                        <input type="hidden" value="100" name="type">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="button" class="btn btn-danger" id="btn-addTaskInList">Add New</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
    <div id="deleteTodoModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Task</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="todo_id_d" name="id" value="<?php echo $task['task_id'];?>" class="form-control">					
						<p>Are you sure you want to delete this task?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="deleteTask">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php include '../footer.php';?>