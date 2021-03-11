<?php
    //user table
    $sql = "CREATE TABLE IF NOT EXISTS `user`(
        user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        user_name varchar(255) NOT NULL,
        user_username varchar(255) NOT NULL,
        user_password varchar(255) NOT NULL,
        user_email varchar(255) NOT NULL,
        user_phoneNumber int(15) NOT NULL,
        user_profileImage varchar(255) NOT NULL,
        user_type int(2) NOT NULL
    )";
    //task_lists
    $sql = "CREATE TABLE IF NOT EXISTS `task_lists`(
        list_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        list_name varchar(255) NOT NULL,
        list_description varchar(255) NOT NULL
    )";
    //task
    $sql ="CREATE TABLE IF NOT EXISTS `task`(
        task_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        task_name varchar(255) NOT NULL,
        task_description varchar(255) NOT NULL,
        priority varchar(255) NOT NULL,
        deadline timestamp(6) NOT NULL,
        list_id INT,
        FOREIGN KEY (list_id) REFERENCES task_lists(list_id)
    )";
    //forum - msg_board
    $sql = "CREATE TABLE IF NOT EXISTS `msg_board`(
        msg_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        msg_title varchar(255) NOT NULL,
        msg_description varchar(255) NOT NULL,
        msg_createdTime timestamp(6) NOT NULL,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES user(user_id),
        project_id INT,
        FOREIGN KEY (project_id) REFERENCES project(project_id)
    )";
    //forum -msg_comment
    $sql = "CREATE TABLE IF NOT EXISTS `msg_comment`(
        comment_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        comment_description varchar(255) NOT NULL,
        comment_createdTime timestamp(6) NOT NULL,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES user(user_id),
        msg_id INT, 
        FOREIGN KEY (msg_id) REFERENCES msg_board(msg_id),
        project_id INT,
        FOREIGN KEY (project_id) REFERENCES project(project_id)
    )";
    $sql = "CREATE TABLE IF NOT EXISTS `event`(
        event_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        event_title varchar(255) NOT NULL,
        event_description varchar(255) NOT NULL,
        event_startDate date(255) NOT NULL,
        event_endDate date(255) NOT NULL,
        event_location varchar(255) NOT NULL,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES user(user_id),
        project_id INT,
        FOREIGN KEY (project_id) REFERENCES project(project_id)
    )";
?>