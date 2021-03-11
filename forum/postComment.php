<?php 
    include '../db/database.php';
    include '../bar.php';
    include '../sidebar.php';
    include 'save.php';
    $uId = $_SESSION['user_id'];
    $msgId_url = $_GET['msgId'];
    // print_r($_GET['msgId']);
    $team_id = $_SESSION['team_id'];
    $sql1 = "SELECT * FROM msg_board WHERE msg_id='$msgId_url'";
    $res1 = mysqli_query($conn,$sql1);
    $msg = mysqli_fetch_assoc($res1);
    $sql2 = "SELECT msg_comment.* from msg_comment JOIN user on user.user_id = msg_comment.user_id where msg_id = $msgId_url ORDER BY msg_comment.comment_createdTime ASC ";
    $res2 = mysqli_query($conn,$sql2);
    $join = mysqli_fetch_all($res2,MYSQLI_ASSOC);
    $sql3 = "SELECT * FROM team WHERE team_id ='$team_id'";
    $res3 = mysqli_query($conn, $sql3);
    $team = mysqli_fetch_assoc($res3);
    // print_r($msgId_url);
    // print_r($msg);
?>
<!DOCTYPE html>
<head>
    <title>Forum Panel</title>
    <link rel="stylesheet" href="../sidebar.css">
    <style>
        .avatar {
            vertical-align: middle;
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        .thumbnail {
            padding:0px;
        }
        .panel {
            position:relative;
        }
        .panel>.panel-heading:after,.panel>.panel-heading:before{
            position:absolute;
            top:11px;left:-16px;
            right:100%;
            width:0;
            height:0;
            display:block;
            content:" ";
            border-color:transparent;
            border-style:solid solid outset;
            pointer-events:none;
        }
        .panel>.panel-heading:after{
            border-width:7px;
            border-right-color:#f7f7f7;
            margin-top:1px;
            margin-left:2px;
        }
        .panel>.panel-heading:before{
            border-right-color:#ddd;
            border-width:8px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <div class="header"> 
            <h1 class="text-center"><?php echo $msg['msg_title'];?></h1>
                <h1 class="text-center"><?php echo $msg['msg_description'];?></h1>
                <p class="text-right">
                    <?php 
                        $time = $msg['msg_createdTime'];
                        $formatted_datetime = date("F j, Y, g:i a", strtotime($time));
                        echo $formatted_datetime;
                    ?>
                </p>
        </div>
        <form id="commentForm">
            <div class="input-group mb-3">
                <input type="text" name="commentDes" class="form-control" placeholder="comment here">
                <div class="input-group-append">
                    <input type="hidden" id="msgId" name="msg_id" value="<?php echo $msgId_url;?>">
                    <input type="hidden" id="uId" name="user_id" value="<?php echo $uId;?>">
                    <input type="hidden" value="5" name="type">
                    <button type="button" id="btn-comment" class="btn btn-primary" >Comment!</button>
                </div>
            </div>    
        </form>
        <hr>
        <h2 class="text-center">Comment</h2>
        <?php foreach ($join as $joins){?>   
            <?php 
                // print_r($joins['user_id']);
                $uid = $joins['user_id'];
                $sql3 = "SELECT * FROM user WHERE user_id = $uid ";
                $res3 = mysqli_query($conn,$sql3);
                $user = mysqli_fetch_all($res3,MYSQLI_ASSOC);
                foreach($user as $users){
                    $image = $users['user_profileImage'];
                }
            ?> 
            <?php if($uId == $joins['user_id']):?>
            <div class="row">
                <div class="col-sm-11">
                    <div class="card">
                        <div class="card-header">
                            <strong><?php echo $joins['comment_description'];?></strong> 
                            <p class="text-right">
                                <?php 
                                    $formatted_datetime = date("F j, Y, g:i a", strtotime($joins['comment_createdTime']));
                                    echo $formatted_datetime;
                                ?>
                            </p> 
                            <?php if($uId == $team['user_id'] || $uId == $joins['user_id']):?>
                            <button class="btn btn-danger btn-sm" 
                                id="updateCommentbtn" 
                                data-id="<?php echo $joins['comment_id']; ?>"
                                data-des="<?php echo $joins['comment_description']; ?>"
                                data-time="<?php echo $joins['comment_createdTime'];?>"
                                data-toggle="modal" 
                                data-target="#updateCommentModal">
                            Update</button>
                            <button class="btn btn-danger btn-sm" 
                                    id="deleteCommentbtn" 
                                    data-id="<?php echo $joins['comment_id'];?>"
                                    data-toggle="modal" 
                                    data-target="#deleteCommentModal">
                            delete</button>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1"><img src="../user/images/<?php echo $image;?>" class="avatar"></div>
            </div>
            <?php elseif($uId !== $joins['user_id']):?>
                <div class="row">
                    <div class="col-sm-2"><img src="../user/images/<?php echo $image;?>" class="avatar" style="border:1px solid"></div>
                    <div class="col-sm-10">
                        <div class="card">
                        <div class="card-header">
                            <strong><?php echo $joins['comment_description'];?></strong> 
                            <p class="text-right">
                                <?php 
                                    $formatted_datetime = date("F j, Y, g:i a", strtotime($joins['comment_createdTime']));
                                    echo $formatted_datetime;
                                ?>
                            </p> 
                            <?php if($uId == $team['user_id']|| $uId == $joins['user_id']):?>
                            <button class="btn btn-danger btn-sm" 
                                id="updateCommentbtn" 
                                data-id="<?php echo $joins['comment_id']; ?>"
                                data-des="<?php echo $joins['comment_description']; ?>"
                                data-time="<?php echo $joins['comment_createdTime'];?>"
                                data-toggle="modal" 
                                data-target="#updateCommentModal">
                            Update</button>
                            <button class="btn btn-danger btn-sm" 
                                    id="deleteCommentbtn" 
                                    data-id="<?php echo $joins['comment_id'];?>"
                                    data-toggle="modal" 
                                    data-target="#deleteCommentModal">
                            delete</button>
                            <?php endif;?>
                        </div>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <br>
        <?php }?>
    </div>
                <!-- delete comment -->
                <div id="deleteCommentModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">						
                                    <h4 class="modal-title">Delete Comment</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="comment_id" name="commentId_d" class="form-control">					
                                    <p>Are you sure you want to delete this post?</p>
                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="hidden" value="3" name="type">
                                    <button type="button" class="btn btn-danger" id="btn-deleteComment">Delete Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- edit comment -->
                <div id="updateCommentModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="updateCommentForm">
                                <div class="modal-header">						
                                    <h4 class="modal-title">Edit Comment</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="commentId" name="comment_id_u" class="form-control" required>					
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <input type="text" id="commentDes" name="comment_description_u" class="form-control" required>
                                    </div>
                                    <input type="hidden" id="commentDateTime" name="comment_dateTime_u">
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="hidden" value="4" name="type">
                                    <button type="button" class="btn btn-info" id="btn-updateComment">Comment！</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php include '../footer.php';?>