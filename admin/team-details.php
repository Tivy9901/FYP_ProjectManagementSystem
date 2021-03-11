<?php 
    include '../db/database.php';
    include 'sidebarAdmin.php';
    include '../header.php';
    include 'save.php';
    if(!isset($_GET['t_id'])){
        header('location: team.php');
    }
    $team_id = $_GET['t_id'];
    $sql = "SELECT * FROM team WHERE team_id = '$team_id' ";
    $res = mysqli_query($conn,$sql);
    $team = mysqli_fetch_assoc($res);
    $sql1 = "SELECT user.* FROM user JOIN team ON team.user_id = user.user_id WHERE team.team_id = '$team_id' ";
    $res1 = mysqli_query($conn,$sql1);
    $teamCreator = mysqli_fetch_all($res1,MYSQLI_ASSOC);
    // print_r($teamCreator);
    $sql2 = "SELECT user.* FROM user JOIN team_list ON team_list.user_id= user.user_id WHERE team_list.team_id='$team_id' ";
    $res2 = mysqli_query($conn,$sql2);
    $users = mysqli_fetch_all($res2,MYSQLI_ASSOC);
    $sql3 = "SELECT project.* FROM project JOIN team ON project.team_id = team.team_id WHERE team.team_id = '$team_id' ";
    $res3 = mysqli_query($conn,$sql3);
    $projects = mysqli_fetch_all($res3,MYSQLI_ASSOC); 
    $sql4 = "SELECT * FROM user";
    $res4 = mysqli_query($conn,$sql4);
    $userAll = mysqli_fetch_all($res4,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Team Details</title>
    <style>
        .avatar{
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
            <div class="row">
                <h1><?php echo $team['team_name'];?> - <?php echo $team['team_description'];?></h1>
            </div>
        </div>
        <div class="w3-container">
            <br>
                <?php foreach ($teamCreator as $teamCreators){?>
                <div class="input-group mb-3">
                    <input type="text" name="teamCreat_name" class="form-control" id="teamCreator_id" placeholder="<?php echo $teamCreators['user_username'];?>" disabled>
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="edit" data-toggle="modal" data-target="#editCreatorModal">Edit Creator</button>
                    </div>
                </div>
                <div class="w3-container">
                    <h2>User List</h2>
                    <ul class="w3-ul w3-hoverable">
                    <?php foreach($users as $user){?>
                        <li>
                            <img src="../user/images/<?php echo $user['user_profileImage'];?>" class="avatar">
                            <?php echo $user['user_username'];?>
                        </li>
                    <?php }?>
                    <button class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#addTeamUserModal">
                    <i class="fa fa-plus"></i> Add User</button>
                    <button class="btn btn-danger" style="float:right;" data-toggle="modal" data-target="#removeUserModal"> 
                    <i class="fa fa-minus"></i> Remove User</button>
                    </ul>
                </div>
                <?php }?>

                <div class="w3-container">
                    <h2>Project List</h2>
                    <ul class="w3-ul w3-hoverable">
                    <?php foreach($projects as $project){?>
                        <li>
                            <?php echo $project['project_title'];?></a>
                            - <?php echo $project['project_description'];?>
                        </li>
                    <?php }?>
                    </ul>
                </div>


                <?php foreach($teamCreator as $teamCreators){?>
                <div id="editCreatorModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="update_tform">
                                <div class="modal-header">						
                                    <h4 class="modal-title">Edit Creator</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                <input type="hidden" value="<?php echo $team['team_id'];?>" id="team_id_e" name="team_id">
                                <select class="form-control"  name="user_id" id="user_id_e">
                                    <?php foreach($users as $user){
                                        if($user['user_id'] == $team['user_id']){
                                    ?>
                                        <option value=<?php echo $user['user_id']?> disabled><?php echo $user['user_name'];?></option>
                                    <?php }else{?>
                                        <option value=<?php echo $user['user_id']?>><?php echo $user['user_name'];?></option>
                                    <?php }}?>
                                </select>				
                                </div>
                                <div class="modal-footer">
                                <input type="hidden" value="5" name="type">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-info" id="editCreator">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php }?>
                
                <div id="addTeamUserModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="add_user_team_form">
                                <div class="modal-header">						
                                    <h4 class="modal-title">Add user</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="form-group">
                                    <label>Add Team Member</label>
                                    <select name="user_id" id="u_id" class="custom-select">
                                        <?php foreach($userAll as $userAlls){?>
                                        <option value="<?php echo $userAlls['user_id'];?>"><?php echo $userAlls['user_username'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="6" name="type">
                                    <input type="hidden" value="<?php echo $team['team_id'] ;?>" name="team_id">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-success" id="btn-add-user-team">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>  
                
                <div id="removeUserModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">						
                                    <h4 class="modal-title">Remove</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="team_id_remove" name="id" value="<?php echo $team['team_id']?>" class="form-control">
                                    <select class="form-control" name="user_id" id="user_id_remove">
                                        <?php foreach($users as $user){
                                            if($user['user_id'] == $team['user_id']){
                                        ?>
                                            <option value=<?php echo $user['user_id']?> disabled><?php echo $user['user_name'];?></option>
                                        <?php }else{?>
                                            <option value=<?php echo $user['user_id']?>><?php echo $user['user_name'];?></option>
                                        <?php }}?>
                                    </select>
                                    <p>Are you sure you want to remove this user?</p>
                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-danger" id="removeuser">Remove</button>
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