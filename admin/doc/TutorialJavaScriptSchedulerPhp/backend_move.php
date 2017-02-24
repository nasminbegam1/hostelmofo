<?php
require_once '_db.php';

$insert = "UPDATE events SET start = :start, end = :end, resource = :resource WHERE id = :id";

$stmt = $db->prepare($insert);

$stmt->bindParam(':start', $start);
$stmt->bindParam(':end', $end);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':resource', $resource);


$received = json_decode(file_get_contents('php://input'));
//echo $received;

$id = $received->e->id;
$start = $received->newStart;
$end = $received->newEnd;
$resource = $received->newResource;
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Update successful';

echo json_encode($response);

?>
