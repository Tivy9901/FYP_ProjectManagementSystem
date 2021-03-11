<?php 
    include '../../db/database.php';
    include '../sidebarAdmin.php';
    include '../../header.php';
    $sn = 1;
    $project_id = $_GET['p_id'];
    $sql1 = "SELECT * FROM msg_board WHERE project_id = '$project_id' ";
    $res1 = mysqli_query($conn,$sql1);
    $msgList = mysqli_fetch_all($res1,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum List</title>
</head>
<body>
    <div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
            <h1>Forum List</h1>
        </div>
        <div class="w3-container">
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created Time</th>
                    <th>Creator</th>
                    <th>Project</th>
                </tr>
                <?php foreach($msgList as $msgLists){?>
                <tr>
                    <td><?php echo $sn++;?></td>
                    <?php 
                        $msg_id = $msgLists['msg_id'];
                        $sql3 = "SELECT * FROM msg_comment WHERE msg_id = '$msg_id'";
                        $res3 = mysqli_query($conn,$sql3);
                        if(mysqli_num_rows($res3)>0):
                    ?>
                    <td><a href="forum.php?forum_id=<?php echo $msg_id;?>"><?php echo $msgLists['msg_title'];?></td>
                    <?php else:?>
                        <td><?php echo $msgLists['msg_title'];?>
                    <?php endif;?>
                    <td><?php echo $msgLists['msg_description'];?></td>
                    <?php 
                        $formatted_datetime = date("F j, Y, g:i a", strtotime($msgLists['msg_createdTime']));
                    ?>
                    <td><?php echo $formatted_datetime;?></td>
                    <?php 
                        $user_id = $msgLists['user_id'];
                        $sql2 = "SELECT * FROM user WHERE user_id = '$user_id' ";  
                        $res2 = mysqli_query($conn,$sql2);
                        $msgCreator = mysqli_fetch_assoc($res2);
                    ?>
                    <td><?php echo $msgCreator['user_username'];?></td>
                    <?php 
                        $p_id = $msgLists['project_id'];
                        $sql3 = "SELECT * FROM project WHERE project_id = '$p_id' ";  
                        $res3 = mysqli_query($conn,$sql3);
                        $msgProject = mysqli_fetch_assoc($res3);
                    ?>
                    <td><?php echo $msgProject['project_title'];?></td>
                </tr>
                <?php }?>
            </table>
        </div>
    </div>
</body>
</html>