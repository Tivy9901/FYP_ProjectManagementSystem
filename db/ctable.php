<?php
include('database.php');


$sql = "CREATE TABLE IF NOT EXISTS task_assign (
         taskassign_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
         task_id INT,
         FOREIGN KEY (task_id) REFERENCES task(task_id),
         user_id INT,
         FOREIGN KEY (user_id) REFERENCES user(user_id)
     )";


if($conn->query($sql) === true){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $conn->error;
}

// $sql = "CREATE TABLE IF NOT EXISTS project (
//     project_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     project_title VARCHAR(100) NOT NULL,
//     project_description VARCHAR(255),
//     team_id INT,
//     FOREIGN KEY (team_id) REFERENCES team(team_id)
// )";
?>