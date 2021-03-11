<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=project', 'root', '');

if(isset($_POST["id"]))
{
 $query = "
 UPDATE events 
 SET event_title=:title, start_event=:start_event, end_event=:end_event 
 WHERE event_id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}

?>