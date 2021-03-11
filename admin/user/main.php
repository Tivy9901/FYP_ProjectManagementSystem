<?php 
    include '../../db/database.php';
    include 'save.php';
    include '../sidebarAdmin.php';
    include '../../header.php';
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
    <div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
            <h1>Profile</h1>
        </div>
        <div class="w3-container">
            <button class="btn btn-primary btn-sm" 
                data-toggle="modal" data-target="#addFileModal">
                <i class="fa fa-user"></i>Upload</button>
            <form id="userProfileForm">
                <?php foreach($user as $users){?>
                    <div class="form-group">
                        <img src="../../user/images/<?php echo $users['user_profileImage'];?>" class="avatar">
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
                        <input type="text" class="form-control" name="phoneNumber" value="<?php echo $users['user_phoneNumber'];?>">
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