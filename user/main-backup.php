<?php 
    include '../db/database.php';
    include '../bar.php';
    include 'save.php';
    if(!isset($_SESSION)) { session_start(); }
    $uid = $_SESSION['user_id'];
    $sql = "SELECT * FROM user where user_id = $uid";
    $res = mysqli_query($conn,$sql);
    $user = mysqli_fetch_all($res,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Profile</title>
    <style>
        .avatar {
            vertical-align: middle;
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3>User Profile</h3>
        </div>
        <div>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addFileModal"><i class="fa fa-user"></i>Upload <br></button>                            </button>
            <form id="userProfileForm">
                <?php foreach($user as $users){?>
                    <div class="form-group">
                        <img src="images/<?php echo $users['user_profileImage'];?>" class="avatar">
                    </div>

                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $users['user_username'];?>">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name_i" value="<?php echo $users['user_name'];?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $users['user_email'];?>">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" class="form-control" name="phoneNumber" value="<?php echo $users['user_phoneNumber'];?>">
                    </div>
                    <input type="hidden" name="type" value="1">
                    <button type="button" class="btn btn-success" id="btn-profile">Update</button>
                <?php }?>
            </form>
        </div>
    </div>
    <div id="addFileModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="file_form" enctype="multipart/form-data">
                    <div class="modal-body">					
                        <div class="form-group">
                            <label>Select File</label>
                            <input type='file' name='image' id='file' class='form-control'>
                        </div>	
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="0" name="type">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="button" class="btn btn-success" id="btn-add-file">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
</html>