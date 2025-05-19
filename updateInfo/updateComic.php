<?php
require_once '../DALs/comicsDAL.php';

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid data"]);
    exit;
}

$dal = new DAL_Comics();
$comic = $dal->getComicById($data['id']);
if (!$comic) {
    http_response_code(404);
    echo json_encode(["error" => "Comic not found"]);
    exit;
}

if (isset($data['delete']) && $data['delete'] === true) {
    $deleted = $dal->deleteComic($data['id']);
    echo json_encode(["deleted" => $deleted]);
    exit;
}

$name = isset($data['name']) ? $data['name'] : $comic['name'];
$description = isset($data['description']) ? $data['description'] : $comic['description'];
$img_path = isset($data['img_path']) ? $data['img_path'] : $comic['img_path'];
$category = isset($data['category']) ? $data['category'] : $comic['category'];
$brand = isset($data['brand']) ? $data['brand'] : $comic['brand'];
$editorial = isset($data['editorial']) ? $data['editorial'] : $comic['editorial'];
$year = isset($data['year']) ? $data['year'] : $comic['year'];

$success = $dal->updateComic($data['id'], $name, $description, $img_path, $brand, $editorial, $year, $category);

echo json_encode(["success" => $success]);
?>
