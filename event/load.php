<?php

//load.php
session_start();
$p_id=$_SESSION['project_id'];
$connect = new PDO('mysql:host=localhost;dbname=project', 'root', '');

$data = array();

$query = "SELECT * FROM events WHERE project_id='$p_id' ORDER BY event_id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["event_id"],
  'title'   => $row["event_title"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>

