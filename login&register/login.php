<?php include 'save.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="header">
        <h2>Login</h2>
        <?php include 'errors.php';?>
    </div>
    <form method="post" id="loginForm">
        <div class="input-group">
            <input type="hidden" name="user_id" id="user_id">
            <label>User Name</label>
            <input type="text" name="username" id="username_l">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" id="password_l">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" id="btn-login" name="btn-login">Login</button>
        </div>
        <p>
            Not yet a member? <a href="register.php">Sign up</a>
        </p>    
    </form>
</body>
</html>