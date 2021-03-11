<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Page</title>
    
    <?php   include '../db/database.php';
			include '../bar.php';
			// session_start();
			if(!isset($_SESSION)) { session_start(); }
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT t.* FROM team t JOIN team_list tl ON tl.team_id= t.team_id WHERE tl.user_id='$user_id' ";
			$result = mysqli_query($conn, $sql);
			$teams = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // print_r($projects);
    ?>
<style>
.sec{
    position: relative;
    right: -13px;
    top:-22px;
	top: -24px !important;
}

.counter.counter-lg {
    
}
</style>
</head>
<body class="d-flex flex-column min-vh-100">
	<div class="jumbotron" style="text-align:center">
		<h3 class="display-4">Welcome!</h3>
		<p class="lead">This is Team Page, you need to create a team before proceed to your PROJECT.</p>
		<hr>
		<p>You can edit or delete you TEAM through the option button</p>
		<button class="btn btn-primary btn-sm" id="new_team" data-toggle="modal" data-target="#addTeamModal">
		<i class="fa fa-plus"></i> New Team</button>
	</div>
	<div class="container">
		<div class="row">
			<?php foreach($teams as $team){ ?>
				<div class="card mr-2" style="width: 17rem;">
					<div class="card-body">
						<div class="card-title"><?php echo htmlspecialchars($team['team_name']); ?>
						
						<?php if($user_id == $team['user_id']):?>
							<i class="fas fa-ellipsis-v float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<button class="dropdown-item" id="update_team" type="button" 
											data-id="<?php echo $team['team_id'];?>"
											data-title="<?php echo $team['team_name'];?>"
											data-desc="<?php echo $team['team_description'];?>"
											data-toggle="modal" data-target="#editTeamModal">Edit</button>
									<button class="dropdown-item" type="button" id="delete_team"
											data-id="<?php echo $team['team_id'];?>"
											data-toggle="modal" data-target="#deleteTeamModal">Delete</button>
								</div>
						<?php endif;?>
							</div>
							<p class="card-text"><?php echo htmlspecialchars($team['team_description']); ?></p>
							<a href="team-details.php?t_id=<?php echo $team['team_id'];?>" class="card-link">Enter team</a>
						</div>
					</div>
				<?php } ?>	
			</div>
		</div>	
	</div>
    <!-- Add Modal -->
    <div id="addTeamModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="team_form">
					<div class="modal-header">
											
						<h4 class="modal-title">New Team</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Team Name</label>
							<input type="text" id="name" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Team description</label>
							<input type="text" id="description" name="description" class="form-control">
						</div>				
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
                        <input type="hidden" value="<?php echo $user_id ?>" name="user_id">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add-team">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- Edit Modal HTML -->
	<div id="editTeamModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_tform">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Team Details</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="team_id" class="form-control" required>					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="title_u" name="team_name" class="form-control" required>
                            <label>Desc</label>
							<input type="text_area" id="desc_u" name="team_desc" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="btn-update-team">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- delete modal -->
	<div id="deleteTeamModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Team</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="team_id_d" name="id" value="<?php echo $team['team_id']?>" class="form-control">					
						<p>Are you sure you want to delete this team?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="btn-delete-team">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>
<?php include '../footer.php';?>
