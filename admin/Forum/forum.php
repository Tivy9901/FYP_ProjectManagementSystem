<?php 
    include '../../db/database.php';
    include '../sidebarAdmin.php';
    include '../../header.php';
    $sn = 1;
    $msg_id = $_GET['forum_id'];
    $sql1 = "SELECT * FROM msg_comment WHERE msg_id = '$msg_id' ";
    $res1 = mysqli_query($conn,$sql1);
    $comment = mysqli_fetch_all($res1,MYSQLI_ASSOC);
    $sql2 = "SELECT * FROM msg_board WHERE msg_id = '$msg_id' ";
    $res2 = mysqli_query($conn,$sql2);
    $msg = mysqli_fetch_assoc($res2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Details</title>
</head>
<style>
    .avatar {
        vertical-align: middle;
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }
</style>
<body>
    <div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
            <h1>Comment List</h1>
        </div>
        <div class="w3-container">
            <div class="card">
                <div class="header text-center">
                    <h1><?php echo $msg['msg_title'];?></h1>
                </div>
                <hr>
                <?php foreach($comment as $comments){?>
                <div class="card-body">
                <?php 
                    $user_id = $comments['user_id'];
                    $sql3 = "SELECT * FROM user WHERE user_id = '$user_id' ";
                    $res3 = mysqli_query($conn,$sql3);
                    $user = mysqli_fetch_all($res3,MYSQLI_ASSOC);
                    foreach($user as $users){
                    $image = $users['user_profileImage'];
                ?>
                <div class="row ">
                    <div class="col-sm-2 text-center">
                    <img src="../../user/images/<?php echo $users['user_profileImage'];?>" class="avatar">
                    </div>
                    <div class="col-sm-10 ">
                        <div class="card">
                            <div class="card-body">
                                <?php echo $comments['comment_description'];?>
                                <?php 
                                    $formatted_datetime = date("F j, Y, g:i a", strtotime($comments['comment_createdTime']));
                                ?>
                                <td><p class="text-right"><?php echo $formatted_datetime;?></p></td>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</body>
</html>