<?php 
    include 'save.php'; 
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
    <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    </style>
</head>
<body>
    <div class="header">
        <h2>Register</h2>
        <?php include 'errors.php';?>
    </div>
    <form action="register.php" method="post" id="regForm" required>
        <div class="input-group">
            <label>User Name</label>
            <input type="text" name="username" id="username_r" required>
        </div>
        <div class="input-group">
            <label>Name</label>
            <input type="text" name="name" id="name_r" required>
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" id="email_r" required>
        </div>
        <div class="input-group">
            <label>Phone Number</label>
            <input type="number" name="phoneNumber" id="phoneNumber_r" required>
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" id="password_r" required>
        </div>
        <div class="input-group">
            <input type="hidden" value="1" name="type">
            <button type="submit" class="btn" name="btn-reg" id="btn-reg">Register</button>
        </div> 
        <p>
            Already a member?
            <a href="login.php">Sign In</a>
        </p> 
    </form>
</body>
</html>