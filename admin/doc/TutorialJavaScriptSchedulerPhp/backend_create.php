<?php
require_once '_db.php';

$insert = "INSERT INTO events (name, start, end, resource) VALUES (:name, :start, :end, :resource)";

$stmt = $db->prepare($insert);

$stmt->bindParam(':start', $start);
$stmt->bindParam(':end', $end);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':resource', $resource);

$received = json_decode(file_get_contents('php://input'));

$start = $received->start;
$end = $received->end;
$resource = $received->resource;
$name = $received->text;
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$db->lastInsertId();

echo json_encode($response);

?>
