<?php
require_once '../DALs/coinsDAL.php';

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid data"]);
    exit;
}

$dal = new DAL_Coins();
$coin = $dal->getCoinById($data['id']);
if (!$coin) {
    http_response_code(404);
    echo json_encode(["error" => "Coin not found"]);
    exit;
}

if (isset($data['delete']) && $data['delete'] === true) {
    $deleted = $dal->deleteCoin($data['id']);
    echo json_encode(["deleted" => $deleted]);
    exit;
}

$name = isset($data['coin_name']) ? $data['coin_name'] : $coin['coin_name'];
$description = isset($data['description']) ? $data['description'] : $coin['description'];
$img_path = isset($data['img_path']) ? $data['img_path'] : $coin['img_path'];
$country = isset($data['country']) ? $data['country'] : $coin['country'];
$denomination = isset($data['denomination']) ? $data['denomination'] : $coin['denomination'];
$quantity = isset($data['quantity']) ? (int)$data['quantity'] : (int)$coin['quantity'];
$category = isset($data['category']) ? $data['category'] : $coin['category'];

$success = $dal->updateCoin($data['id'], $name, $description, $img_path, $country, $denomination, $quantity, $category);

echo json_encode(["success" => $success]);
?>
