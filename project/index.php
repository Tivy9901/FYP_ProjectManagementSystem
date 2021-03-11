<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    
    <?php   include '../db/database.php';
			include '../bar.php';
			include '../sidebar.php';
			if (!isset($_SESSION)){session_start();} 
			if(!isset($_SESSION['team_id'])){
				header('location: ../team/index.php');
			}
			$team_id = $_SESSION['team_id'];
			$user_id = $_SESSION['user_id'];
			$sql = "SELECT * FROM project WHERE team_id ='$team_id' ORDER BY project_id";
			$result = mysqli_query($conn, $sql);
			$projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
</head>
<!-- <link rel="stylesheet" href="../sidebar.css"> -->
<body class="d-flex flex-column min-vh-100">
	<div class="jumbotron container-fluid" style="text-align:center">
		<h1 class="display-4">It's time to start your Project!</h1>
		<p class="lead">You may create your project now.
		<hr class="my-4">
		<p>You can only Edit your project through the option button</p>
		<p class="lead">
			<button class="btn btn-primary btn-sm" id="new_project" data-toggle="modal" 
			data-target="#addProjectModal"><i class="fa fa-plus"></i> Start Project Now</button>
		</p>
	</div>
    <div class="container">
        <div class="row">
			<?php foreach($projects as $project){ ?>
				<?php if($project['project_disable'] == 1):?>
					<div class="card mr-3" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-title"><?php echo htmlspecialchars($project['project_title']); ?>
                        </div>
                        <p class="card-text"><?php echo htmlspecialchars($project['project_description']); ?></p>
                        <a href="project-details.php?p_id=<?php echo $project['project_id'];?>" class="card-link">Enter project</a>
                    </div>
				</div>
				<?php elseif($project['project_disable'] == 0):?>
                <div class="card mr-3" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-title"><?php echo htmlspecialchars($project['project_title']); ?>
						<?php if($user_id == $project['user_id']):?>
                            <i class="fas fa-ellipsis-v float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item" id="update_project" type="button"
										data-id="<?php echo $project['project_id'];?>"
										data-title="<?php echo $project['project_title'];?>"
										data-desc="<?php echo $project['project_description'];?>"
										data-toggle="modal" data-target="#editProjectModal">Edit</button>
                            </div>
						<?php endif;?>
                        </div>
                        <p class="card-text"><?php echo htmlspecialchars($project['project_description']); ?></p>
                        <a href="project-details.php?p_id=<?php echo $project['project_id'];?>" class="card-link">Enter project</a>
                    </div>
				</div>
				<?php endif;?>
            <?php } ?>
        </div>
    </div>
    <div>
    <!-- Modal -->
    <div id="addProjectModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="project_form">
					<div class="modal-header">						
						<h4 class="modal-title">Add Project</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Project title</label>
							<input type="text" id="title" name="title" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Project description</label>
							<input type="text" id="description" name="description" class="form-control">
						</div>				
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
                        <input type="hidden" value="<?php echo $team_id ?>" name="team_id">
                        <input type="hidden" value="<?php echo $user_id ?>" name="user_id">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add-project">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>

     <!-- Edit Modal HTML -->
	<div id="editProjectModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_pform">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Folder</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control"required>					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="title_u" name="title" class="form-control" required>
                            <label>Desc</label>
							<input type="text_area" id="desc_u" name="desc" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="btn-update-project">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
<?php include '../footer.php';?>
</html>