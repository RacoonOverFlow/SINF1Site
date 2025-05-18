<?php
require_once '../DALs/eventsDAL.php';

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['id'])) {
  http_response_code(400);
  echo json_encode(["error" => "Invalid data"]);
  exit;
}

$dal = new DAL_Events();
$event = $dal->getEventById($data['id']);
if (!$event) {
  http_response_code(404);
  echo json_encode(["error" => "Event not found"]);
  exit;
}

// Use existing values if not provided
$title = isset($data['title']) ? $data['title'] : $event['title'];
$description = isset($data['description']) ? $data['description'] : $event['description'];
$img_path = isset($data['img_path']) ? $data['img_path'] : $event['img_path'];
$place = isset($data['place']) ? $data['place'] : $event['place'];
$date = isset($data['date']) ? $data['date'] : $event['date'];
$user_id = isset($data['user_id']) ? $data['user_id'] : $event['user_id'];
$category = isset($data['category']) ? $data['category'] : $event['category'];

$success = $dal->updateEvent($data['id'], $title, $description, $img_path, $place, $date, $user_id, $category);

echo json_encode(["success" => $success]);