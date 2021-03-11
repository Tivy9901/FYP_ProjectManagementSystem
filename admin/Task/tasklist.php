<?php 
    include '../../db/database.php';
    include '../sidebarAdmin.php';
    include '../../header.php';
    $sn = 1;
    $project_id = $_GET['p_id'];
    $sql1 = "SELECT * FROM task_list WHERE project_id = '$project_id' ";
    $res1 = mysqli_query($conn,$sql1);
    $taskList = mysqli_fetch_all($res1,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
</head>
<body>
    <div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
            <h1>Task List</h1>
        </div>
        <div class="w3-container">
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Creator</th>
                    <th>Project Name</th>
                </tr>
                <?php foreach($taskList as $taskLists){?>
                <tr>
                    <td><?php echo $sn++;?></td>
                    <?php 
                        $taskListId = $taskLists['tasklist_id'];
                        $sql4 = "SELECT * FROM task WHERE tasklist_id = $taskListId";
                        $res4 = mysqli_query($conn,$sql4);
                        $task = mysqli_fetch_all($res4,MYSQLI_ASSOC);
                    ?>
                    <?php if(mysqli_num_rows($res4) > 0):?>
                    <td><a href="task.php?tasklist_id=<?php echo $taskListId;?>"><?php echo $taskLists['tasklist_name'];?></td>
                    <?php else:?>
                    <td><?php echo $taskLists['tasklist_name'];?></td>
                    <?php endif;?>
                    <td><?php echo $taskLists['tasklist_description'];?></td>
                    <?php 
                        $user_id = $taskLists['user_id'];
                        $sql2 = "SELECT * FROM user WHERE user_id = '$user_id' ";  
                        $res2 = mysqli_query($conn,$sql2);
                        $taskCreator = mysqli_fetch_assoc($res2);
                    ?>
                    <td><?php echo $taskCreator['user_username'];?></td>
                    <?php 
                        $p_id = $taskLists['project_id'];
                        $sql3 = "SELECT * FROM project WHERE project_id = '$p_id' ";  
                        $res3 = mysqli_query($conn,$sql3);
                        $taskProject = mysqli_fetch_assoc($res3);
                    ?>
                    <td><?php echo $taskProject['project_title'];?></td>
                </tr>
                <?php }?>
            </table>
            
        </div>
    </div>
</body>
</html>