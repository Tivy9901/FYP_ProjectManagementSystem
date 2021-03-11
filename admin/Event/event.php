<?php 
    include '../../db/database.php';
    include '../sidebarAdmin.php';
    include '../../header.php';
    $sn = 1;
    $project_id = $_GET['p_id'];
    $sql = "SELECT * FROM events WHERE project_id = '$project_id' ";
    $res = mysqli_query($conn,$sql);
    $event = mysqli_fetch_all($res,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
</head>
<body>
    <div style="margin-left:8%">    
        <div class="w3-container w3-light-grey">
            <h1>Event List</h1>
        </div>
        <div class="w3-container">
            <br>
                <table class="table">
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Project</th>
                    </tr>
                    <?php foreach($event as $events){?>
                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $events['event_title'];?></td>
                        <?php 
                            $formatted_datetime = date("F j, Y, g:i a", strtotime($events['start_event']));
                        ?>
                        <td><?php echo $formatted_datetime;?></td>
                        <?php 
                            $formatted_datetime = date("F j, Y, g:i a", strtotime($events['end_event']));
                        ?>
                        <td><?php echo $formatted_datetime;?></td>
                        <?php 
                            $p_id = $events['project_id'];
                            $sql3 = "SELECT * FROM project WHERE project_id = '$p_id' ";  
                            $res3 = mysqli_query($conn,$sql3);
                            $eventProject = mysqli_fetch_assoc($res3);
                        ?>
                        <td><?php echo $eventProject['project_title'];?></td>
                    </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>