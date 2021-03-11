<?php 
    include '../../db/database.php';
    include '../sidebarAdmin.php';
    // include 'save.php';
    include '../../header.php';
    $sn = 1;
    $sql2 = "SELECT * FROM team";
    $res2 = mysqli_query($conn,$sql2);
    $teams = mysqli_fetch_all($res2,MYSQLI_ASSOC);
    $teamNew = mysqli_fetch_assoc($res2);
    $sql3 = "SELECT team.* FROM team JOIN project ON project.team_id = team.team_id";
    $res3 = mysqli_query($conn,$sql3);
    $projectTeams = mysqli_fetch_assoc($res3);
    if(count($_POST)>0) {
        $project1=$_POST['project1'];
        // $variable = mysql_real_escape_string($project1);
        $sql = "SELECT * from project where project_title LIKE'%{$project1}%'";
        $res = mysqli_query($conn,$sql);
        $projects = mysqli_fetch_all($res,MYSQLI_ASSOC);
        // $result = mysqli_query($conn,"SELECT * FROM project where project_title='$roll_no' ");
    }

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
            <h1>Project List</h1>
        </div>
        <br>
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
            <br>
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
                            <a href="event.php?p_id=<?php echo $project['project_id'];?>">
                            <?php echo $project['project_title'];?></td>
                        <td><?php echo $project['project_description'];?></td>
                    </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>