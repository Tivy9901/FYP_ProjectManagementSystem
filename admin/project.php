<?php 
    include '../db/database.php';
    include 'sidebarAdmin.php';
    include 'save.php';
    include '../header.php';
    $sn = 1;
    $sql = "SELECT * from project";
    $res = mysqli_query($conn,$sql);
    $projects = mysqli_fetch_all($res,MYSQLI_ASSOC);
    $sql2 = "SELECT * FROM team";
    $res2 = mysqli_query($conn,$sql2);
    $teams = mysqli_fetch_all($res2,MYSQLI_ASSOC);
    $teamNew = mysqli_fetch_assoc($res2);
    $sql3 = "SELECT * FROM user";
    $res3 = mysqli_query($conn,$sql3);
    $users = mysqli_fetch_all($res3,MYSQLI_ASSOC);
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
            <h1>Project List
            <button class="btn btn-primary" data-toggle="modal" data-target="#addProjectModal"><i class="fa fa-plus"></i> Project</button>
            </h1>
        </div>
        <div class="w3-container">
            <br>
                <table class="table">
                    <tr>
                        <th>No.</th>
                        <th>Project Title</th>
                        <th>Project Description</th>
                        <th>Creator</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($projects as $project){?>
                    <?php if($project['project_disable'] == 0) :?>
                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $project['project_title'];?></td>
                        <td><?php echo $project['project_description'];?></td>
                        <?php 
                            $uid = $project['user_id'];
                            $sql4 = "SELECT * FROM user WHERE user_id = '$uid' ";
                            $res4 = mysqli_query($conn,$sql4);
                            $projectCreator = mysqli_fetch_assoc($res4);
                        ?>
                        <td><?php echo $projectCreator['user_name'];?></td>
                        <td>
                            <button class="btn btn-primary" 
                                    id="updateProjectbtn" 
                                    data-toggle="modal" 
                                    data-tid="<?php echo $project['team_id'];?>" 
                                    data-id="<?php echo $project['project_id'];?>"
                                    data-name="<?php echo $project['project_title'];?>"
                                    data-desc="<?php echo $project['project_description'];?>"
                                    data-uid="<?php echo $project['user_id'];?>"
                                    data-target="#editProjectModal">
                            Update</button>
                            <button class="btn btn-danger " id="disableProject" 
									data-id="<?php echo $project['project_id']; ?>">
									<i class="fas fa-ban"></i>
							Disable</button>
                        </td>
                    </tr>
                    <?php elseif($project['project_disable'] == 1) :?>
                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $project['project_title'];?></td>
                        <td><?php echo $project['project_description'];?></td>
                        <?php 
                            $uid = $project['user_id'];
                            $sql4 = "SELECT * FROM user WHERE user_id = '$uid' ";
                            $res4 = mysqli_query($conn,$sql4);
                            $projectCreator = mysqli_fetch_assoc($res4);
                        ?>
                        <td><?php echo $projectCreator['user_name'];?></td>
                        <td>
                            <button class="btn btn-primary" 
                                    id="updateProjectbtn" 
                                    data-toggle="modal" 
                                    data-tid="<?php echo $project['team_id'];?>" 
                                    data-id="<?php echo $project['project_id'];?>"
                                    data-name="<?php echo $project['project_title'];?>"
                                    data-desc="<?php echo $project['project_description'];?>"
                                    data-uid="<?php echo $project['user_id'];?>"
                                    data-target="#editProjectModal">
                            Update</button>
                            <button class="btn btn-success " id="enableProject" 
									data-id="<?php echo $project['project_id']; ?>">
									<i class="fas fa-toggle-on"></i>
							Enable</button>
                        </td>
                    </tr>
                    <?php endif;?>
                    <?php }?>
                </table>
                <!-- addProjectModal -->
                <div id="addProjectModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="project_form">
                                <div class="modal-header">						
                                    <h4 class="modal-title">Add Project</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">					
                                    <div class="form-group">
                                        <label>Project title</label>
                                        <input type="text" id="title" name="title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Project description</label>
                                        <input type="text" id="description" name="description" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Select Team</label>
                                        <select name="team_id_a" id="team_id" class="custom-select">
                                            <?php foreach($teams as $team){?>
                                            <option value=<?php echo $team['team_id'];?>><?php echo $team['team_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>	
                                    <div class="form-group">
                                        <label>Select Project Creator</label>
                                        <select name="user_id_a" id="user_id" class="custom-select">
                                            <?php foreach($users as $user){?>
                                            <option value=<?php echo $user['user_id'];?>><?php echo $user['user_username'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>	
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="8" name="type">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-success" id="btn-add-project">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php foreach($projects as $project){?>
                <!-- updateProjectModal -->
                <div id="editProjectModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="update_pform">
                                <div class="modal-header">						
                                    <h4 class="modal-title">Edit Project Creator</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="project_id_u" name="id" class="form-control" required>					
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="title_u" name="title" class="form-control"  required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text_area" id="desc_u" name="desc" class="form-control" required>
                                    </div>    
                                    <div class="form-group">
                                        <label>Team</label>
                                        <select name="team_id" id="team_id_u" class="custom-select">
                                                <?php foreach($teams as $team){?>
                                                    <?php if($project['team_id'] == $team['team_id']){?>
                                                        <option value="<?php echo $team['team_id'];?>" selected ><?php echo $team['team_name'];?></option>
                                                    <?php }else{?>
                                                        <option value="<?php echo $team['team_id'];?>"><?php echo $team['team_name'];?></option>
                                                    <?php }?>
                                                <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Creator</label>
                                        <select name="user_id" id="user_id_u" class="custom-select">
                                                <?php foreach($users as $user){?>
                                                    <?php if($project['user_id'] == $user['user_id']){?>
                                                        <option value="<?php echo $user['user_id'];?>" selected ><?php echo $user['user_username'];?></option>
                                                    <?php }else{?>
                                                        <option value="<?php echo $user['user_id'];?>"><?php echo $user['user_username'];?></option>
                                                    <?php }?>
                                                <?php }?>
                                        </select>
                                    </div>					
                                </div>
                                <div class="modal-footer">
                                <input type="hidden" value="9" name="type">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-info" id="updateProject">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</body>
</html>