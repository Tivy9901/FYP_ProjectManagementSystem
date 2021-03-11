<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Index Page</title>
    
    <?php   include '../db/database.php';
			include '../bar.php';
			include '../sidebar.php';
			if(!isset($_SESSION)) { session_start(); }
			if(!$_GET['p_id']){
				header('location: ../project/index.php');
			} 
			$user_id = $_SESSION['user_id'];
            $team_id=$_SESSION['team_id'];
            $project_id = $_SESSION['project_id'];
            $sql = "SELECT * FROM task_list WHERE project_id ='$project_id'";
            $result = mysqli_query($conn, $sql);
			$lists = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			$sql2 = "SELECT * FROM team WHERE team_id ='$team_id'";
            $result2 = mysqli_query($conn, $sql2);
			$team = mysqli_fetch_assoc($result2);
			
			
    ?>
	<link rel="stylesheet" href="../sidebar.css">
	<style>
		.jumbotron{
        /* background-image: url("forum.png"); */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: linear-gradient(to bottom, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.9) 100%),
        url("todo.jpg");
        height:450;
        }
	</style>
</head>

<body class="d-flex flex-column min-vh-100">
	<div class="jumbotron bg-cover" style="text-align:center">
        <h1 class="display-4">Todo Page</h1>
        <p class="lead">You can post anything here and comment with others
		<hr class="my-4" style="border:1px solid black;width:90%;text-align:center;margin-left:8.6%">
	    <button class="btn btn-primary btn-sm" id="new_todolist" data-toggle="modal" data-target="#addListModal"><i class="fa fa-plus"></i> New List</button>
        </p>
    </div>
    <div class="container">
        <div class="row">
        <?php foreach($lists as $list){ ?>
		<?php 
			$one= 1;//undone
			$sqlNum = "SELECT * FROM task where task_completed='".$one."' and tasklist_id = '".$list['tasklist_id']."'";
			$num=mysqli_query($conn,$sqlNum);	
			$zero=0;//done
			$sqlNum0 = "SELECT * FROM task where task_completed='".$zero."' and tasklist_id = '".$list['tasklist_id']."'";
			$num0=mysqli_query($conn,$sqlNum0);
			
		?>
        <div class="card mr-3 mb-3" style="width: 18rem;">
            <div class="card-header text-center">
                <a href="tasklist.php?tl_id=<?php echo $list['tasklist_id'];?>" class="card-link">
                    <h5 class="card-title"><?php echo htmlspecialchars($list['tasklist_name']); ?></h5>
                </a>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($list['tasklist_description']); ?></h6>
				<span class="badge badge-secondary mb-2"> <?php echo mysqli_num_rows($num);?></span> <br>
				<?php if($user_id==$list['user_id'] || $user_id==$team['user_id']): ?>
					<button class="btn btn-primary btn-sm far fa-edit" id="edit_todolist" 
							data-id="<?php echo $list['tasklist_id'];?>" 
							data-title="<?php echo $list['tasklist_name']?>"
							data-desc="<?php echo $list['tasklist_description']?>" 
							data-toggle="modal" data-target="#editListModal"></button>
					<button class="btn btn-danger btn-sm fas fa-trash" data-id="<?php echo $list['tasklist_id'];?>" id="delete" data-toggle="modal" data-target="#deleteListModal"></button>
				<?php endif; ?>
            </div>
			<!-- total num of task undone -->
            <div class="card-body">
				<h4 class="text-center">
					<?php 
					$taskListId = $list['tasklist_id'];
					$sql3 = "SELECT * FROM task WHERE tasklist_id = '$taskListId' ";
					$res3 = mysqli_query($conn,$sql3);
					$taskInList = mysqli_fetch_all($res3,MYSQLI_ASSOC);?>
					<?php foreach($taskInList as $taskInLists){?>
					<?php echo $taskInLists['task_name'];?><hr>
					<?php }?>
				</h4>
            </div>
        </div>
        <?php } ?>
    </div>
    </div>
    <div>
    <!-- Add Task List Modal -->
    <div id="addListModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="list_form">
					<div class="modal-header">						
						<h4 class="modal-title">New List</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>List Name</label>
							<input type="text" id="name" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>List description</label>
							<input type="text" id="description" name="description" class="form-control">
						</div>				
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
                        <input type="hidden" value="<?php echo $user_id ?>" name="user_id">
                        <input type="hidden" value="<?php echo $project_id ?>" name="project_id">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add-list">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- Edit List HTML -->
	<div id="editListModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_tlform">
					<div class="modal-header">						
						<h4 class="modal-title">Edit List</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="title_u" name="name" class="form-control" required>
                            <label>Desc</label>
							<input type="text" id="desc_u" name="desc" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Delete Modal HTML -->
	<div id="deleteListModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete List</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="list_id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete this list?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="deletelist">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php include '../footer.php';?>