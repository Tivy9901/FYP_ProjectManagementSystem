<?php
    include 'db/database.php';
    include 'header.php';
    include 'barIndex.php';
    define('url','http://localhost/firsttry/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Home</title>
    <style>
    .img {
        border-radius: 8px;
        width:200;
        height:200;
        }
    .word{
        word-spacing:30px;
    }
    .logo{
        /* position:center;
        width:100px;
        height:100px;
        text-align:center; */
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100px;
    }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<img src="logo.png" class="logo">
    <div class="container py-3">
        <div class="card">
            <div class="row">
                <div class="col-md-7 px-3">
                    <div class="card-block px-6">
                    <h4 class="card-title">Start a Teams</h4>
                    <p class="card-text">Create a Team before you start a Project</p>
                    <p class="card-text"><p><br>
                    <a href="login&register/login.php" class="mt-auto btn btn-primary">Start Now</a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div id="CarouselTest" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#CarouselTest" data-slide-to="0" class="active"></li>
                            <li data-target="#CarouselTest" data-slide-to="1"></li>
                            <li data-target="#CarouselTest" data-slide-to="2"></li>
                        </ol>
                        <!-- image -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img class="d-block" src="pic/team.png" alt="">
                        </div>
                            <div class="carousel-item">
                            <img class="d-block" src="pic/project.png" alt="">
                        </div>
                            <div class="carousel-item">
                            <img class="d-block" src="pic/todoBig.jpg" alt="">
                        </div>
                        <a class="carousel-control-prev" href="#CarouselTest" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#CarouselTest" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card mb-2">
            <div class="row g-0">
                <div class="col-md-3 ml-4 mt-2 mb-2">
                    <img src="pic/project.png" alt="..." class="img" style="width:300">
                </div>
                <div class="col-md-7 ml-5">
                    <div class="card-body">
                        <h3 class="card-title">Manage Your Project!</h3>
                        <p class="card-text">You can start to manage your project now! You can add manange your files and folders, list tasks which going to do....</p>
                        <a href="login&register/login.php">Read More...</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <div class="row g-0">
                <div class="col-md-8 ml-3">
                    <div class="card-body">
                        <h3 class="card-title">Create your teams forum HERE!</h3>
                        <p class="card-text">You can start to create a post here LIKE A BLOG! Your teammates will reply and comment the post...</p>
                        <a href="login&register/login.php">Read More...</a>
                    </div>
                </div>
                <div class="col-md-2  mt-2 mb-2" >
                    <img src="pic/forum.png" class="img" style="width:300">
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <div class="row g-0">
                <div class="col-md-3 ml-4 mt-2 mb-2">
                    <img src="pic/file.jpg" alt="..." class="img" style="width:300">
                </div>
                <div class="col-md-8 ml-5">
                    <div class="card-body">
                        <h3 class="card-title">Manage Your Files & Folders HERE!</h3>
                        <p class="card-text">You can start to manage your files & folders HERE!You can upload and download the documentation here, create folders....</p>
                        <a href="login&register/login.php">Read More...</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <div class="row g-0">
                <div class="col-md-8 ml-3">
                    <div class="card-body">
                        <h3 class="card-title">Manage Your Task and List!</h3>
                        <p class="card-text">You can start to manage your task & list HERE!You can assign the task to your teammates....</p>
                        <a href="login&register/login.php">Read More...</a>
                    </div>
                </div>
                <div class="col-md-2  mt-2 mb-2" >
                    <img src="pic/todos.jpg" class="img" style="width:300">
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <div class="row g-0">
                <div class="col-md-3 ml-4 mt-2 mb-2">
                    <img src="pic/event.jpg" alt="..." class="img" style="width:300">
                </div>
                <div class="col-md-7 ml-5">
                    <div class="card-body">
                        <h3 class="card-title">Manage Your Event!</h3>
                        <p class="card-text">You can start to manage your event HERE!You can also add on the event times and location....</p>
                        <a href="login&register/login.php">Read More...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php include 'footer.php';?>