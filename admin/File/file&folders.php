<?php 
    include '../../db/database.php';
    include '../../header.php';
    include '../sidebarAdmin.php';
    $projectId = $_GET['p_id'];
    $sql = "SELECT * FROM project WHERE project_id = '$projectId' ";
    $res = mysqli_query($conn,$sql);
    $project = mysqli_fetch_assoc($res);
    $sql1 = "SELECT * FROM folder WHERE project_id = '$projectId' ";
    $res1 = mysqli_query($conn,$sql1);
    $folders = mysqli_fetch_all($res1,MYSQLI_ASSOC);
    $sql2 = "SELECT * FROM file WHERE project_id = '$projectId' ";
    $res2 = mysqli_query($conn,$sql2);
    $files = mysqli_fetch_all($res2,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
</head>
<body>
    <div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
            <h1><?php echo $project['project_title'];?> - <?php echo $project['project_description'];?></h1>
        </div>
        <div class="w3-container">
            <br>
                <table class="table table-striped table-responsive-sm">
                    <tr>
                        <th scope="col-6">Folder Name</th>
                    </tr>
                    <tbody>
                    <?php foreach($folders as $folder){ ?>
                        <tr>
                            <td><a href="folder.php?p_id=<?php echo $projectId?>&fol_id=<?php echo $folder['folder_id']?>"><i class="fas fa-folder">  <?php echo htmlspecialchars($folder['folder_name']); ?></i></td>
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
            </div>
        </div>
    </div>
</body>
</html>