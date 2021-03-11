<?php
	if(!isset($_SESSION)) { session_start(); }
    include '../db/database.php';
    $errorMSG = ""; 
    //add user   
    if(count($_POST)>0){ 
        if($_POST['type'] == 10){
            $username =  $_POST['username_i'];
            $name =  $_POST['name_i'];
            $password = $_POST['password_i'];
            $type = $_POST['type_i'];
            $email = $_POST['email_i'];
            $phoneNumber= $_POST['phoneNumber_i'];
            if($username == ''){
                $errorMSG .= "Username is required!";
			    echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else if($password == ''){
                $errorMSG .= "Password is required!";
    			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else{
                $sql_u = "SELECT * FROM user WHERE user_username = '$username' ";
                $res_u = mysqli_query($conn,$sql_u);
                if(mysqli_num_rows($res_u) > 0){
                    $errorMSG .= "Username is repeated!";
                    echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
                }else{
                    $password = md5($password);
                    $sql1 = "INSERT INTO user (user_username,user_name,user_password,user_type,user_email,user_phoneNumber)
                            VALUES('$username','$name','$password','$type','$email','$phoneNumber')";
                    if (mysqli_query($conn, $sql1)) {
                        echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
                    }else{
                        echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
                        }
                    mysqli_close($conn);
                }
            }
        }
    }
    //delete user
    if(count($_POST)>0){ 
        if($_POST['type'] == 4){
            $user_id = $_POST['id'];
            $sql = "DELETE FROM user WHERE user_id=$user_id";
            $res = mysqli_query($conn,$sql);
            if($res==true){
    			echo $user_id;
            }else{
    			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
    //update user
    if(count($_POST)>0){
        if($_POST['type']==3){
            $user_id=$_POST['id_u'];
            $user_name=$_POST['name_u'];
            $user_username=$_POST['username_u'];
            $user_password=$_POST['password_u'];
            $user_type=$_POST['user_type_u'];
            $user_email =$_POST['email_u'];
            $user_phoneNumber = $_POST['phoneNumber_u'];
            if($user_username == ''){
                $errorMSG .= "Username is required!";
			    echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else if($user_password == ''){
                $errorMSG .= "Password is required!";
    			echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else{
                $user_password = md5($user_password);
                $sql_u = "SELECT * FROM user WHERE user_username = '$user_username' ";
                $res_u = mysqli_query($conn,$sql_u);
                $sql = "UPDATE user SET user_name='$user_name',
                                        user_username='$user_username',
                                        user_password='$user_password',
                                        user_email='$user_email',
                                        user_phoneNumber='$user_phoneNumber',
                                        user_type='$user_type' WHERE user_id='$user_id' ";
                if (mysqli_query($conn, $sql)) {
                    echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
                }else{
                    echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
                }
                mysqli_close($conn);
            }
        }
    }
    
    
    //enable user
    if(count($_POST)>0){
        if($_POST['type']==99){
            $id=$_POST['id'];
            $ac=0;
            $sql = "UPDATE `user` SET `user_disable`='$ac' WHERE user_id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
    //disabled user
    if(count($_POST)>0){
        if($_POST['type']==98){
            $id=$_POST['id'];
            $ac=1;
            $sql = "UPDATE `user` SET `user_disable`='$ac' WHERE user_id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }

    //project
    //add project
    if(count($_POST)>0){
        if($_POST['type']==8){
            $title=$_POST['title'];
            $description=$_POST['description'];
            $team_id=$_POST['team_id_a'];
            $user_id=$_POST['user_id_a'];
            if($title==''){
                $errorMSG .= "Project Name is required!";
			    echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else{
                $sql1 = "SELECT * FROM user WHERE user_id = '$user_id' ";
                $res1 = mysqli_query($conn,$sql1);
                $userType = mysqli_fetch_assoc($res1);
                if($userType['user_type'] == 2){
                    $errorMSG .= "Admin cannot be added as Project Creator!";
                    echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
                }else{
                    $sql = "INSERT INTO `project`( `project_title`, `project_description`,`team_id`,`user_id`) 
                        VALUES ('$title','$description','$team_id','$user_id')";
                    if (mysqli_query($conn, $sql)) {
                        echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
                    }else{
                        echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
                    }
                    mysqli_close($conn);
                }
            }
        }
    }
    //update project
    if(count($_POST)>0){
        if($_POST['type']==9){
            $errorMSG = "";
            $id=$_POST['id'];
            $title=$_POST['title'];
            $desc=$_POST['desc'];
            $team_id=$_POST['team_id'];
            $user_id=$_POST['user_id'];
            if($title==''){
                $errorMSG .= "Project Name is required!";
			    echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else if($team_id==''){
                $errorMSG .= "Team is required!";
			    echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else if($user_id==''){
                $errorMSG .= "Team is required!";
			    echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else{
                $sql1 = "SELECT * FROM user WHERE user_id = '$user_id' ";
                $res1 = mysqli_query($conn,$sql1);
                $userType = mysqli_fetch_assoc($res1);
                if($userType['user_type'] == 2){
                    $errorMSG .= "Admin cannot be added as Project Creator!";
                    echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
                }else{
                    $sql = "UPDATE `project` SET `project_title`='$title',`project_description`='$desc',
                                            `team_id`= '$team_id',`user_id`='$user_id' WHERE project_id='$id'";
                    if (mysqli_query($conn, $sql)) {
                        echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
                    }else{
                        $errorMSG .= mysqli_error($conn);
                        echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
                    }
                    mysqli_close($conn);
                }
                
            }
        }
    }
    //enable user
    if(count($_POST)>0){
        if($_POST['type']==96){
            $id=$_POST['id'];
            $ac=0;
            $sql = "UPDATE `project` SET `project_disable`='$ac' WHERE project_id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
    //disabled user
    if(count($_POST)>0){
        if($_POST['type']==97){
            $id=$_POST['id'];
            $ac=1;
            $sql = "UPDATE `project` SET `project_disable`='$ac' WHERE project_id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
    // team
//delete team
if(count($_POST)>0){
    if($_POST['type']==1){
        $id=$_POST['id'];
        $sql = "DELETE FROM `team_list` WHERE team_id = $id ";
        if (mysqli_query($conn, $sql)) {
            $sql2 = "DELETE FROM `team` WHERE team_id = $id ";
            $res = mysqli_query($conn,$sql2);
            
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
//add team
if(count($_POST)>0){
    if($_POST['type']==11){
        $name=$_POST['name'];
        $description=$_POST['description'];
        $user_id =$_POST['user_id'];
        if($name == ''){
            $errorMSG .= "Team Name is required!";
            echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
        }else{
            $sql = "SELECT * FROM user WHERE user_id = '$user_id' ";
            $res = mysqli_query($conn,$sql);
            $userType = mysqli_fetch_assoc($res);
            if($userType['user_type'] == 2){
                $errorMSG .= "Admin cannot be added as Team Creator!";
                echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else{
                $sql1 = "INSERT INTO `team`( `team_name`, `team_description`,`user_id`) 
                VALUES ('$name','$description','$user_id')";
                if (mysqli_query($conn, $sql1)) {
                    $sql2 = "INSERT INTO `team_list` (`team_id`,`user_id`)
                        VALUES(LAST_INSERT_ID(),'$user_id')";
                    $res2 = mysqli_query($conn,$sql2);
                    echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
                }else{
                    echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
                    }
                mysqli_close($conn);
            }
        }
    }
}
//add notice
if(count($_POST)>0){
    if($_POST['type']==100){
        $notice=$_POST['notice_i'];
        $team_id =$_POST['team_id_i'];
        if($notice == ''){
            $errorMSG .= "Notice is required!";
            echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
        }else{
            $sql1 = "UPDATE `team`SET `team_notice`='$notice' WHERE `team_id` = '$team_id'";
            if (mysqli_query($conn, $sql1)) {
                echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
            }else{
                echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
            }
            mysqli_close($conn);
        }
    }
}
//update team
if(count($_POST)>0){
    if($_POST['type']==2){
        $id=$_POST['team_id'];
        $name=$_POST['team_name'];
        $desc=$_POST['team_desc'];
        if($name == ''){
            $errorMSG .= "Team Name is required!";
            echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
        }else{
            $sql = "UPDATE `team` SET `team_name`='$name',`team_description`='$desc' WHERE team_id=$id";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
            }else{
                echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
            }
            mysqli_close($conn);
        }
    }
}
//update team creator
if(count($_POST)>0){
    if($_POST['type']==5){
        $id=$_POST['user_id'];
        $team_id=$_POST['team_id'];
        $sql = "SELECT * FROM user WHERE user_id = '$id' ";
        $res = mysqli_query($conn,$sql);
        $userType = mysqli_fetch_assoc($res);
        if($userType['user_type'] == 2){
            $errorMSG .= "Admin cannot be added as Team Creator!";
            echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
        }else{
            $sql1 = "UPDATE `team` SET `user_id` = '$id' WHERE team_id = '$team_id' ";
            if (mysqli_query($conn, $sql1)) {
                echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
            } 
            else {
                echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
            }
            mysqli_close($conn);
        }
        
    }
}
//add user in team
if(count($_POST)>0){
    if($_POST['type']==6){
        $user_id=$_POST['user_id'];
        $team_id =$_POST['team_id'];
        $sql = "SELECT * FROM user WHERE user_id='$user_id'";
        $res = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($res);
        if (mysqli_num_rows($res)>0) /*found same name*/{
            $uId = $user['user_id'];
            $sql1 = "SELECT * FROM team_list WHERE user_id= '$uId' AND team_id = '$team_id'";
            $res1 = mysqli_query($conn,$sql1);
            if(mysqli_num_rows($res1)>0){
                $errorMSG .= "User already exist!";
                echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }elseif($user['user_type'] == 2){
                $errorMSG .= "Admin cannot be added as a team member!";
                echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else{
                $sql2 = "INSERT INTO `team_list` (`team_id`,`user_id`)VALUES('$team_id','$user_id')";
                if (mysqli_query($conn, $sql2)) {
                    echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
                } 
                else {
                    echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
                }
            }
            mysqli_close($conn);
        }
    }
}
//remove user in team
if(count($_POST)>0){
    if($_POST['type']==7){
        $team_id=$_POST['team_id'];
        $user_id=$_POST['user_id'];
        $sql = "DELETE FROM `team_list` WHERE team_id = $team_id AND user_id =$user_id";
        if (mysqli_query($conn, $sql)) {
            
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>