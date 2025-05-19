<?php
require_once '../DALs/stampsDAL.php';

$data = json_decode(file_get_contents("php://input"), true);
$dal = new DAL_Stamps();

// DELETE
if (isset($data['action']) && $data['action'] === 'delete') {
    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Missing ID"]);
        exit;
    }
    $success = $dal->deleteStamp((int)$data['id']);
    echo json_encode(["success" => $success]);
    exit;
}

// UPDATE
if (!isset($data['id'])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Missing ID"]);
    exit;
}

$stamp = $dal->getStampById($data['id']);
if (!$stamp) {
    http_response_code(404);
    echo json_encode(["success" => false, "message" => "Stamp not found"]);
    exit;
}

// Use ternary operator instead of `??` for PHP < 7.0
$name        = isset($data['name']) ? $data['name'] : $stamp['name'];
$description = isset($data['description']) ? $data['description'] : $stamp['description'];
$img_path    = isset($data['img_path']) ? $data['img_path'] : $stamp['img_path'];
$country     = isset($data['country']) ? $data['country'] : $stamp['country'];
$city        = isset($data['city']) ? $data['city'] : $stamp['city'];
$year        = isset($data['year']) ? $data['year'] : $stamp['year'];
$category    = isset($data['category']) ? $data['category'] : $stamp['category'];

$success = $dal->updateStamp(
    $data['id'],
    $name,
    $description,
    $img_path,
    $country,
    $city,
    $year,
    $category
);

echo json_encode(["success" => $success]);
?>
