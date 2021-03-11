<?php 
    include '../../db/database.php';
    include '../sidebarAdmin.php';
    include '../../header.php';
    $sn = 1;
    $sql = "SELECT * from project";
    $res = mysqli_query($conn,$sql);
    $projects = mysqli_fetch_all($res,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project List</title>
</head>
<body>
    <div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
            <h1>Project List
            <button class="btn btn-primary" data-toggle="modal" data-target="#addProjectModal"><i class="fa fa-plus"></i> Project</button>
            </h1>
        </div>
        <div class="form-group d-flex justify-content-center mt-2">
            <form class="form-inline" method="post" action="search.php">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">Search by project name</span>
            </div>
                <input type="text" class="form-control" id="project1" name="project1" placeholder="Enter project name">
                <button type="submit" name="save" class="btn btn-primary mt-1">Search</button>
            </form>
        </div>
        <div class="w3-container">
            
                <table class="table">
                    <tr>
                        <th>No.</th>
                        <th>Project Title</th>
                        <th>Project Description</th>
                    </tr>
                    <?php foreach($projects as $project){?>
                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td>
                            <a href="file&folders.php?p_id=<?php echo $project['project_id'];?>">
                            <?php echo $project['project_title'];?></td>
                        <td><?php echo $project['project_description'];?></td>
                    </tr>
                    <?php }?>
                </table>
        </div>
    </div>
</body>
</html>