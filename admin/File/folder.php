<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<?php   
		include '../../header.php';
		include '../../db/database.php';
		include '../sidebarAdmin.php';
		if(!isset($_SESSION)) {session_start();} 
        $project_id = ($_GET['p_id']);
        $parent_id = ($_GET['fol_id']);
        $user_id = ($_SESSION['user_id']);
        $sql = "SELECT * FROM folder WHERE project_id = '$project_id' AND parent_id = '$parent_id'";
        $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
		$folders = mysqli_fetch_all($result,MYSQLI_ASSOC);
		$sql2 = "SELECT * FROM file WHERE project_id = '$project_id' AND folder_id = '$parent_id'";
        $result2 = mysqli_query($conn, $sql2) or die("Bad query: $sql2");
		$files = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    ?>
    <style>
		.avatar {
			text-align: center;
			width: 100px;
			height: 100px;
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
	</style>
</head>
<body>
	<div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
			<h1>Folder</h1>
        </div>
        <div class="w3-container">
			<br>
			<table class="table table-striped table-responsive-sm">
                <tr><th scope="col-6">Folder</th></tr>
                <tbody>
					<?php foreach($folders as $folder){ ?>
						<tr>
							<td><a href="folder.php?p_id=<?php echo $project_id?>&fol_id=<?php echo $folder['folder_id']?>"><i class="fas fa-folder">  <?php echo htmlspecialchars($folder['folder_name']); ?></i></td>
						</tr>
					<?php } ?>
                </tbody>
            </table>
			<table class="table table-striped table-responsive-sm">
                <tr>
                    <th scope="col">File Name</th>
                    <th scope="col">File type</th>
                    <th scope="col">Date of upload</th>
                    <th scope="col">Action</th>
                </tr>
                <tbody>
                <?php foreach($files as $file){ ?>
                    <tr>
                        <td><i class="fas fa-file"> <?php echo htmlspecialchars($file['file_name']); ?></i></td>
                        <td> <?php echo htmlspecialchars($file['file_type']); ?></td>
                        <td> <?php echo htmlspecialchars($file['file_upload_date']); ?></td>
                        <td><a href="download.php?f_id=<?php echo $file['file_id'];?>" target="_blank" class="btn btn-success btn-sm">Download</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
	<div class="container">
		<div class="row">
			<?php foreach($folders as $folder){?>
				<div class="card mr-2" style="width: 17rem;">
					<div class="card-body">
						<div class="card-title" style="text-align:center">
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
</body>
</html>