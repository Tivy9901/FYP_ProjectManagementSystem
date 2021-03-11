<?php 
    include '../db/database.php';
    include '../bar.php';
    include '../sidebar.php';
    include 'save.php';
    define('forumURL',"http://localhost/firsttry/forum/");
    if(!$_GET['p_id']){
        header('location: ../project/index.php');
    }    
    $pId = $_GET['p_id'];
    $team_id = $_SESSION['team_id'];
    $sql = "SELECT * FROM msg_board WHERE project_id = $pId";
    $res = mysqli_query($conn,$sql);
    $msg = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $userId = $_SESSION['user_id'];
    $sql2 = "SELECT * FROM team WHERE team_id ='$team_id'";
    $result2 = mysqli_query($conn, $sql2);
    $team = mysqli_fetch_assoc($result2);
    
?>
<!DOCTYPE html>
<head>
    <title>Forum Panel</title>
    <link rel="stylesheet" href="../sidebar.css">
    <style>
        .jumbotron{
        /* background-image: url("forum.png"); */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: linear-gradient(to bottom, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.9) 100%),
        url("forum1.jpg");
        height:400;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="jumbotron bg-cover" style="text-align:center">
        <h1 class="display-4">Forum</h1>
        <p class="lead">You can post anything here and comment with others
        <hr class="my-4" style="border:1px solid black;width:90%;text-align:center;margin-left:8.6%">
        <button class="btn btn-primary" id="new_post" data-target="#addPostModal" data-toggle="modal">
        <i class="fa fa-plus"></i> Add New Post</button></p>
        </p>
    </div>
    <?php foreach($msg as $msgs){?>    
    <div class="container">
        <div class="card">
            <div class="card-header"> 
                <a href="<?php echo forumURL;?>postComment.php?msgId=<?php echo $msgs['msg_id'];?>">
                <?php echo $msgs['msg_title'];?> - </a>
                <?php
                    $sqlUser = "SELECT u.* FROM user u JOIN msg_board m ON u.user_id = m.user_id where u.user_id = '".$msgs['user_id']."' ";
                    $resUser = mysqli_query($conn,$sqlUser);
                    $user =  mysqli_fetch_assoc($resUser);
                ?>
                <?php echo $user['user_username'];?>
            </div>
            <div class="card-body">
                <?php echo $msgs['msg_description'];?><br>
                <?php $_SESSION['p_id'] = $msgs['project_id'];?>
                <?php 
                    $formatted_datetime = date("F j, Y, g:i a", strtotime($msgs['msg_createdTime']));
                    // echo $formatted_datetime;
                ?>
                <p class="text-right"><?php echo $formatted_datetime;?></p>
                <?php if($userId == $msgs['user_id'] || $userId == $team['user_id']) :?>
                <button class="btn btn-danger btn-sm" 
                        id="updatePostbtn" 
                        data-id="<?php echo $msgs['msg_id']; ?>"
						data-title="<?php echo $msgs['msg_title']; ?>"
                        data-des="<?php echo $msgs['msg_description']; ?>"
                        data-date="<?php echo $msgs['msg_createdTime'];?>"
                        data-toggle="modal" 
                        data-target="#updatePostModal">
                Update</button>
                <button class="btn btn-danger btn-sm" 
                        id="deletePostbtn" 
                        data-id="<?php echo $msgs['msg_id'];?>"
                        data-toggle="modal" 
                        data-target="#deletePostModal">
                Delete</button>
                <?php endif;?>
            </div>
        </div>
        <br>
    </div>
    <?php }?>
                <div id="addPostModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="makePostForm">
                                <div class="modal-header">			
                                    <input type="hidden" id="id" name="project_id" value="<?php echo $pId;?>">	
                                    <input type="hidden" id="uid" name="user_id" value="<?php echo $userId;?>">		
                                    <h4 class="modal-title">Make a Post</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="title" name="postTitle" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" id="Description" name="postDes" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="10" name="type">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-success" id="btn-makePost">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- delete post -->
                <div id="deletePostModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">						
                                    <h4 class="modal-title">Delete Post</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="postId" name="id" class="form-control">					
                                    <p>Are you sure you want to delete this post?</p>
                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="hidden" value="1" name="type">
                                    <button type="button" class="btn btn-danger" id="btn-deletePost">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- edit post -->
                <div id="updatePostModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="updatePostForm">
                                <div class="modal-header">						
                                    <h4 class="modal-title">Edit Post</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="post_id" name="postId" class="form-control" required>					
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="post_title" name="postTitle" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" id="post_description" name="postDescription" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="hidden" value="2" name="type">
                                    <button type="button" class="btn btn-info" id="btn-updatePost">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            
</body>
</html>
<?php include '../footer.php'; ?>