<?php 
    if(!isset($_SESSION)) { session_start(); }
    include '../db/database.php';
    // $userId = $_SESSION['user_id'];
    // $pId = $_SESSION['project_id']; 

    $errorMSG = "";
    if(count($_POST)>0){ 
        if($_POST['type'] == 10){
            $user_id = $_POST['user_id'];
            $project_id = $_POST['project_id'];
            $msg_title = $_POST['postTitle'];
            $msg_description = $_POST['postDes'];
            $msg_createdTime = date("Y-m-d H:m:s");
            if($msg_title == ''){
                $errorMSG .= "Name is required!";
                echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else{
                $sql = "INSERT INTO msg_board (msg_title,msg_description,msg_createdTime,user_id,project_id)
                        VALUES ('$msg_title','$msg_description','$msg_createdTime','$user_id','$project_id')";
                if (mysqli_query($conn, $sql)) {
                    echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
                } 
                else {
                    echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
                }
                mysqli_close($conn);
            }
        }
    }

    if(count($_POST)>0){ 
        if($_POST['type'] == 1){
            $msg_id = $_POST['id'];
            $sql = "DELETE FROM msg_board WHERE msg_id=$msg_id";
            $res = mysqli_query($conn,$sql);
            if($res==true){
    			echo $msg_id;
            }else{
    			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
    if(count($_POST)>0){
        if($_POST['type']==2){
            $msg_id=$_POST['postId'];
            $msg_title=$_POST['postTitle'];
            $msg_description=$_POST['postDescription'];
            $msg_createdTime = date("Y-m-d H:m:s");
            if($msg_title == ''){
                $errorMSG .= "Name is required!";
			    echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else{
                $sql = "UPDATE msg_board SET msg_title='$msg_title',
                                        msg_description='$msg_description',
                                        msg_createdTime='$msg_createdTime'
                                        WHERE msg_id='$msg_id' ";
                if (mysqli_query($conn, $sql)) {
                    echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
                } 
                else {
                    echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
                }
                mysqli_close($conn);
            }
            
        }
    }
    //comment
    if(count($_POST)>0){ 
        if($_POST['type'] == 3){
            $comment_id = $_POST['id'];
            $sql = "DELETE FROM msg_comment WHERE comment_id=$comment_id";
            $res = mysqli_query($conn,$sql);
            if($res==true){
    			echo $comment_id;
            }else{
    			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }

    if(count($_POST)>0){
        if($_POST['type']==4){
            $comment_id=$_POST['comment_id_u'];
            $comment_description=$_POST['comment_description_u'];
            $comment_dateTime=date("Y-m-d H:m:s");
            $sql = "UPDATE msg_comment SET comment_description='$comment_description',
                                            comment_createdTime = '$comment_dateTime'
                                            WHERE comment_id='$comment_id' ";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }

    if(count($_POST)>0){
        if($_POST['type']==5){
            $user_id = $_POST['user_id'];
            $msgId_url = $_POST['msg_id'];
            $comment_description = $_POST['commentDes'];
            $comment_dateTime = date("Y-m-d H:m:s");
            if($comment_description == ''){
                $errorMSG .= "Comment is required!";
			    echo json_encode(array("statusCode"=>2011,"msg"=>$errorMSG));
            }else{
                $sql = "INSERT INTO msg_comment (comment_description,comment_createdTime,msg_id,user_id)
                            VALUES ('$comment_description','$comment_dateTime','$msgId_url','$user_id')";
                if (mysqli_query($conn, $sql)) {
                    echo json_encode(array("statusCode"=>200,"msg"=>$errorMSG));
                } 
                else {
                    echo json_encode(array("statusCode"=>2012,"msg"=>$errorMSG));
                }
                mysqli_close($conn);
            }
        }  
    }

    

    
?>
