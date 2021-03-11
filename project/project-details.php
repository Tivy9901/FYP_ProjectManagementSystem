<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details Page</title>
    <?php   include '../db/database.php';
            include '../bar.php';
            include '../sidebar.php';
			if(!isset($_SESSION)) { session_start(); }
            if(isset($_GET['p_id'])){
                $p_id = mysqli_real_escape_string($conn, $_GET['p_id']);
                $_SESSION['project_id']=$p_id;
                $sql = "SELECT * FROM project WHERE project_id = $p_id";
                $result = mysqli_query($conn, $sql);
                $project = mysqli_fetch_assoc($result);
                $projectNew = mysqli_fetch_all($result,MYSQLI_ASSOC);
                mysqli_free_result($result);
                mysqli_close($conn);
                
            }
            if($project['project_disable'] == 1){
                $_SESSION['disable'] = "Project Disabled!";
            }
    ?>
</head>
<link rel="stylesheet" href="../sidebar.css">
<body class="d-flex flex-column min-vh-100">    
    <div class="jumbotron container-fluid" style="text-align:center">
		<h3 class="display-4">Start to Manage Project!</h3>
		<p class="lead">You can manage your project HERE!.</p>
		<hr>
		<p>You can proceed to any function you wish</p>
    </div>
    <div class="container">
    <?php if(isset($_SESSION['disable'])){?>
        <div class="alert alert-danger" role="alert">
            <p style="text-align:center"><?php echo $_SESSION['disable'] ?></p>
        </div>
        <div class="error">
        </div>
    <?php unset($_SESSION['disable']);}; ?>
        <div class="header" style="text-align:center">
            <h2><?php echo $project['project_title']?></h2>
            <h3><?php echo htmlspecialchars($project['project_description'])?></h3>
            <hr style="left:25px">
        </div>
    </div>
    <!-- forum -->
    <div class="container" style="float:left;">
        <div class="row">
        <div class="card mr-3 mb-3" style="width: 16rem;left:35px">
        <img class="card-img-top" src="pic/forum.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Forum</h5>
                <p>You can discuss any thing you like or ask any questions here! Your team member will reply your post and give comment.
                You can update and delete your own post and comment.</p>
                <?php if($project['project_disable'] == 1):?>
                    <a href="#" class="card-link stretched-link" disabled = "disabled">Go to Forum</a>
                <?php unset($_SESSION['disable']);?>
                <?php else:?>
                <a href="../forum/main.php?p_id=<?php echo $project['project_id'];?>" class="card-link stretched-link">Go to Forum</a>
                <?php endif;?>
            </div>
        </div>
        <div class="card mr-3 mb-3" style="width: 16rem;left:35px">
            <img class="card-img-top" src="pic/to-dos.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">To-dos</h5>
                <p>You can create any task that you need to done at here! You also can assigned task to other team members. Mark as done 
                or undone also consider as one of the functions.</p>
                <?php if($project['project_disable'] == 1):?>
                    <a href="#" class="card-link stretched-link" disabled = "disabled">Go to To-dos</a>
                <?php unset($_SESSION['disable']);?>
                <?php else:?>
                <a href="../todo/index.php?p_id=<?php echo $project['project_id'];?>" class="card-link stretched-link">Go to To-dos</a>
                <?php endif;?>
            </div>
        </div>
        <div class="card mr-3 mb-3" style="width: 16rem;left:35px">
            <img class="card-img-top" src="pic/files.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">File & Folders</h5>
                <p>You can upload all your documentations here to share with your members. Create folder functions also provided.
                All uploaded documentations are able to downloads by any members. </p>
                <?php if($project['project_disable'] == 1):?>
                    <a href="#" class="card-link stretched-link" disabled = "disabled">Go to Files</a>
                <?php unset($_SESSION['disable']);?>
                <?php else:?>
                <a href="../file/index.php?p_id=<?php echo $project['project_id'];?>" class="card-link stretched-link">Go to Files</a>
                <?php endif;?>
            </div>
        </div>
        <div class="card mr-3 mb-3" style="width: 16rem;left:35px">
            <img class="card-img-top" src="pic/event.webp" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Event</h5>
                <p>You can arrange and plan your event here! If your event is overdue, system will displayed it with a alert colour.
                Other members can view event details included creator.</p>
                <?php if($project['project_disable'] == 1):?>
                    <a href="#" class="card-link stretched-link" disabled = "disabled">Go to Event</a>
                <?php unset($_SESSION['disable']);?>
                <?php else:?>
                    <!-- <a href="../event_js/index.php?p_id=<?php echo $project['project_id'];?>" class="card-link stretched-link">Card link</a> -->
                <a href="../event/index.php" class="card-link stretched-link">Go to Event</a>
                <?php endif;?>
            </div>
        </div>
        </div>
    </div>
</div>
</body>
<?php include '../footer.php';?>
</html>

