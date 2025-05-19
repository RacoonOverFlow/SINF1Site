<?php
require_once '../DALs/miniaturesDAL.php';

$data = json_decode(file_get_contents("php://input"), true);
$dal = new DAL_Miniatures();

// Handle DELETE
if (isset($data['action']) && $data['action'] === 'delete') {
    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Missing ID"]);
        exit;
    }
    $success = $dal->deleteMiniature((int)$data['id']);
    echo json_encode(["success" => $success]);
    exit;
}

// Handle UPDATE
if (!isset($data['id'])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Missing ID"]);
    exit;
}

$miniature = $dal->getMiniatureById($data['id']);
if (!$miniature) {
    http_response_code(404);
    echo json_encode(["success" => false, "message" => "Miniature not found"]);
    exit;
}

$name = isset($data['name']) ? $data['name'] : $miniature['name'];
$description = isset($data['description']) ? $data['description'] : $miniature['description'];
$img_path = isset($data['img_path']) ? $data['img_path'] : $miniature['img_path'];
$category = isset($data['category']) ? $data['category'] : $miniature['category'];

$success = $dal->updateMiniature($data['id'], $name, $description, $img_path, $category);
echo json_encode(["success" => $success]);
