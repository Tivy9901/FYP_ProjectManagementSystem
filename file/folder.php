<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Folder Page</title>
    <?php   include '../db/database.php';
			include '../bar.php';
			include '../sidebar.php';
			if(!isset($_SESSION)) {session_start();} 
            $project_id = ($_GET['p_id']);
            $parent_id = ($_GET['fol_id']);
			$user_id = ($_SESSION['user_id']);
	
            //print_r($parent_id);
            $sql = "SELECT * FROM folder WHERE project_id = '$project_id' AND parent_id = '$parent_id'";
            $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
			$folders = mysqli_fetch_all($result,MYSQLI_ASSOC);
			$sql2 = "SELECT * FROM file WHERE project_id = '$project_id' AND folder_id = '$parent_id'";
            $result2 = mysqli_query($conn, $sql2) or die("Bad query: $sql2");
			$files = mysqli_fetch_all($result2, MYSQLI_ASSOC);
			$sql3 = "SELECT * FROM folder WHERE folder_id = $parent_id";
            $result3 = mysqli_query($conn, $sql3);
			$folder3 = mysqli_fetch_assoc($result3);
			$parentID = $folder3['parent_id'];
			//print_r($_GET);
    ?>
	<link rel="stylesheet" href="../sidebar.css">
    <style>
		.avatar {
			text-align: center;
			width: 100px;
			height: 100px;
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
		.jumbotron{
        /* background-image: url("forum.png"); */
		height:400px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: linear-gradient(to bottom, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.9) 100%),
        url("file.webp");
        /* height:600; */
        }
	</style>
</head>
<body class="d-flex flex-column min-vh-100">
	<div class="jumbotron bg-cover" style="text-align:center">
        <h1 class="display-4">File & docs</h1>
        <p class="lead">
        <hr class="my-4">
		<button class="btn btn-primary btn-sm" id="new_folder" data-toggle="modal" data-target="#addFolderModal"><i class="fa fa-plus"></i> New Folder</button>
		<button class="btn btn-primary btn-sm" id="new_file" data-toggle="modal" data-target="#addFileModal"><i class="fa fa-plus"></i> New File</button>
        </p>
		<?php if($parentID > 0):?>
		<a href="folder.php?p_id=<?php echo $project_id?>&fol_id=<?php echo $folder3['parent_id']?>" class="btn btn-small"><i class="fa fa-arrow-circle-o-right"></i> Go to previous folder </a>
		<?php else : ?>
		<a href="../file/index.php?p_id=<?php echo $project_id;?>" class="btn btn-small"><i class="fa fa-arrow-circle-o-right"></i> Go to previous folder</a>
		<?php endif;?>
    </div>
	<div class="container">
		<div class="row">
			<?php foreach($folders as $folder){?>
				<div class="card mr-2" style="width: 17rem;">
					<div class="card-body">
						<div class="card-title" style="text-align:center">
						<?php if($user_id == $folder['user_id']):?>
							<i class="fas fa-ellipsis-v float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<button class="dropdown-item" id="update_folder" 
										data-id="<?php echo $folder['folder_id']; ?>" 
										data-name="<?php echo $folder['folder_name']; ?>" 
										data-toggle="modal" data-target="#editFolderModal">Rename</button>
                				<button class="dropdown-item" id="delete_folder" 
										data-id="<?php echo $folder['folder_id']; ?>" data-toggle="modal" 
										data-target="#deleteFolderModal">Delete</button>
                            </div>
						<?php endif;?>
							<h3>
							<a href="folder.php?p_id=<?php echo $project_id?>&fol_id=<?php echo $folder['folder_id']?>">
							<i class="fas fa-folder">  <?php echo htmlspecialchars($folder['folder_name']); ?></i></a>
							</h3>
						</div>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
	<!-- end of folder -->
	<!-- files -->
	<div>
		<hr class="my-4" style="border:1px solid black;width:80%;text-align:center;margin-left:8.6%">
	</div>
	<div class="container" style="text-align:center">
		<div class="row">
			<?php foreach ($files as $file){?>
				<div class="card mr-2" style="width: 17rem">
					<div class="card-body">
						<h3><div class="card-title"><?php echo $file['file_name'];?></div></h3>
						<?php if($file['file_type'] == 'jpg' || $file['file_type'] == 'jpeg' || $file['file_type'] == 'png'):?>
							<img src="upload/<?php echo $file['file_path'];?>" alt="" class="avatar">
						<?php elseif($file['file_type'] == 'pdf'):?>
							<img src="icon/pdf.png" alt="pdf" class="avatar">
						<?php elseif($file['file_type'] == 'docx' || $file['file_type'] == 'doc'):?>
							<img src="icon/doc.png" alt="pdf" class="avatar">
						<?php elseif($file['file_type'] == 'pptx' || $file['file_type'] == 'ppt'):?>
							<?php echo $file['file_type'];?>
							<img src="icon/ppt.png" alt="pdf" class="avatar">
						<?php endif?>
						<h2><a href="download.php?f_id=<?php echo $file['file_id'];?>" 
						target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download</a></h2>
						<?php if($user_id == $file['user_id']):?>
							<h2><button class="btn btn-danger btn-sm" id="delete_file" 
							data-fid="<?php echo $file['file_id']; ?>" data-fpath="<?php echo $file['file_path']; ?>" 
							data-toggle="modal" data-target="#deleteFileModal"><i class="fa fa-minus"></i> Delete</button>
							</h2>
						<?php endif;?>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
	<!-- end of files -->
</body>
    


    <!-- add folder Modal -->
    <div id="addFolderModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="folder_form">
					<div class="modal-header">						
						<h4 class="modal-title">Create Folder</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Folder name</label>
							<input type="text" id="folder_name" name="folder_name" class="form-control" required>
						</div>				
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
                        <input type="hidden" value="<?php echo $user_id ;?>" name="user_id">
                        <input type="hidden" value="<?php echo $project_id ;?>" name="project_id">
                        <input type="hidden" value="<?php echo $parent_id ;?>" name="parent_id">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add-folder">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- Delete Modal HTML -->
	<div id="deleteFolderModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete Folder</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="folder_id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete this folder?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="deletefolder">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
    
    <!-- Edit Modal HTML -->
	<div id="editFolderModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Folder</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="name_u" name="name" class="form-control" required>
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

	<!--File Modal-->
    <div id="addFileModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="file_form" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Create Folder</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Select File</label>
						    <input type='file' name='image' id='file' class='form-control'>
						</div>				
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="<?php echo $parent_id?>" name="folder_id">
                        <input type="hidden" value="<?php echo $user_id ;?>" name="user_id">
                        <input type="hidden" value="<?php echo $project_id ;?>" name="project_id">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add-file">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="deleteFileModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete File</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
                        <input type="hidden" id="file_path_d" name="file_path" class="form-control">
						<input type="hidden" id="file_id_d" name="file_id" class="form-control">					
						<p>Are you sure you want to delete this file?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="deletefile">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<br>
<?php include '../footer.php';?>