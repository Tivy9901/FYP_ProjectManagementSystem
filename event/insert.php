<?php

//insert.php
session_start();
$p_id=$_SESSION['project_id'];

$connect = new PDO('mysql:host=localhost;dbname=project', 'root', '');

if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO events 
 (event_title, start_event, end_event,project_id) 
 VALUES (:title, :start_event, :end_event, '$p_id')
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
}


?>