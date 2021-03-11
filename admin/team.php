<?php 
    include '../db/database.php';
    include 'sidebarAdmin.php';
    include '../header.php';
    include 'save.php';
    if(!isset($_SESSION)) { session_start(); }
    $sql = "SELECT * FROM team ORDER BY team_name asc";
    $res = mysqli_query($conn,$sql);
    $team = mysqli_fetch_all($res,MYSQLI_ASSOC);
    $sn = 1;
    $sql1 = "SELECT * FROM user ORDER BY user_username asc";
    $res1 = mysqli_query($conn,$sql1);
    $users = mysqli_fetch_all($res1,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Teams Page</title>
</head>
<body>
    <div style="margin-left:8%">
        <div class="w3-container w3-light-grey">
            <h1>Team List
            <button class="btn btn-primary" data-target="#addTeamModal" data-toggle="modal">Add New</button>
			</h1>
        </div>
        <div class="w3-container">
            <br>
                <table class="table">
                    <tr>
                        <th>No.</th>
                        <th>Team Name</th>
                        <th>Team Description</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($team as $teams){ ?>    
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td>
                            <a href="team-details.php?t_id=<?php echo $teams['team_id'];?>">
                            <?php echo $teams['team_name']; ?></a>
                        </td>
                        <td><?php echo $teams['team_description']; ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" 
                                    id="updateTeam" 
                                    data-id="<?php echo $teams['team_id']; ?>"
                                    data-name="<?php echo $teams['team_name']; ?>"
                                    data-dec="<?php echo $teams['team_description'];?>" 
                                    data-creator="<?php echo $teams['team_creator_id']; ?>"
                                    data-toggle="modal" 
                                    data-target="#editTeamModal">
                            Update</button>
                            <button class="btn btn-danger btn-sm" 
                                    id="deleteTeam" 
                                    data-id="<?php echo $teams['team_id'];?>"
                                    data-toggle="modal" 
                                    data-target="#deleteTeamModal">
                            Delete</button>
                            <button class="btn btn-success btn-sm" 
                                    id="notice" 
                                    data-id="<?php echo $teams['team_id'];?>"
                                    data-toggle="modal" 
                                    data-target="#noticeModal">
                            Notice</button>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <div id="addTeamModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="team_form">
                                <div class="modal-header">						
                                    <h4 class="modal-title">New Team</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">					
                                    <div class="form-group">
                                        <label>Team Name</label>
                                        <input type="text" id="name" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Team description</label>
                                        <input type="text" id="description" name="description" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Select Team Creator</label>
                                        <select name="user_id" class="custom-select">
                                            <?php foreach($users as $user){?>
                                            <option value="<?php echo $user['user_id'];?>"><?php echo $user['user_username'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>	
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="11" name="type">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-success" id="btn-add-team">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php foreach($team as $teams){?>
                <div id="deleteTeamModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">						
                                    <h4 class="modal-title">Delete Team</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="team_id_d" name="id" value="<?php echo $teams['team_id']?>" class="form-control">					
                                    <p>Are you sure you want to delete this team?</p>
                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-danger" id="btn-deleteteam">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="editTeamModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="update_tform">
                                <div class="modal-header">						
                                    <h4 class="modal-title">Edit Team Details</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="id_u" name="team_id" class="form-control" value="<?php echo $teams['team_id']?>" required>					
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="title_u" name="team_name" class="form-control" value="<?php echo $teams['team_name']?>" required>
                                        <label>Desc</label>
                                        <input type="text_area" id="desc_u" name="team_desc" class="form-control" value="<?php echo $teams['team_description']?>" required>
                                    </div>					
                                </div>
                                <div class="modal-footer">
                                <input type="hidden" value="2" name="type">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-info" id="btn-updateteam">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="noticeModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="notice_form">
                                <div class="modal-header">						
                                    <h4 class="modal-title">New Notice</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">					
                                    <div class="form-group">
                                        <label>Notice</label>
                                        <input type="text" id="notice" name="notice_i" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="<?php echo $teams['team_id']?>" name="team_id_i">
                                    <input type="hidden" value="100" name="type">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-success" id="btn-notice">Add</button>
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