<?php
require_once '_db.php';
    
$result = $db->query('SELECT * FROM events');

class Event {}
$events = array();

foreach($result as $row) {
  $e = new Event();
  $e->id = $row['id'];
  $e->text = $row['name'];
  $e->start = $row['start'];
  $e->end = $row['end'];
  $e->resource = $row['resource'];
  $events[] = $e;
}

echo json_encode($events);

?>
