<?php 
    include '../../db/database.php';
    include '../sidebarAdmin.php';
    include '../../header.php';
    $sn = 1; 
    $tlist_id = $_GET['tasklist_id'];
    $sql1 = "SELECT * FROM task WHERE tasklist_id = '$tlist_id' ";
    $res1 = mysqli_query($conn,$sql1);
    $task = mysqli_fetch_all($res1,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
</head>
<body>
    <div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
            <h1>Task</h1>
        </div>
        <div class="w3-container">
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Creator</th>
                    <th>Status</th>
                </tr>
                <?php foreach($task as $tasks){?>
                <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $tasks['task_name'];?></td>
                    <td><?php echo $tasks['task_description'];?></td>
                    <td><?php echo $tasks['task_priority'];?></td>
                    <td><?php echo $tasks['task_deadline'];?></td>
                    <?php 
                        $user_id = $tasks['user_id'];
                        $sql2 = "SELECT * FROM user WHERE user_id = '$user_id' ";  
                        $res2 = mysqli_query($conn,$sql2);
                        $taskCreator = mysqli_fetch_assoc($res2);
                    ?>
                    <td><?php echo $taskCreator['user_username'];?></td>
                    <?php if($tasks['task_completed'] == 1):?>
                        <td>Haven't Complete</td>
                    <?php else:?>
                        <td>Completed</td>
                    <?php endif;?>
                </tr>
                <?php }?>
            </table>
        </div>
    </div>
</body>
</html>