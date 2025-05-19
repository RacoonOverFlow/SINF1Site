<?php
require_once '../DALs/cardsDAL.php';

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid data"]);
    exit;
}

$dal = new DAL_Cards();
$card = $dal->getCardById($data['id']);
if (!$card) {
    http_response_code(404);
    echo json_encode(["error" => "Card not found"]);
    exit;
}

if (isset($data['delete']) && $data['delete'] === true) {
    $deleted = $dal->deleteCard($data['id']);
    echo json_encode(["deleted" => $deleted]);
    exit;
}

// Use isset fallback instead of ?? (for PHP < 7.0)
$name = isset($data['name']) ? $data['name'] : $card['name'];
$description = isset($data['description']) ? $data['description'] : $card['description'];
$img_path = isset($data['img_path']) ? $data['img_path'] : $card['img_path'];
$edition = isset($data['edition']) ? $data['edition'] : $card['edition'];
$rareness = isset($data['rareness']) ? $data['rareness'] : $card['rareness'];
$card_condition = isset($data['card_condition']) ? $data['card_condition'] : $card['card_condition'];
$category = isset($data['category']) ? $data['category'] : $card['category'];

$success = $dal->updateCard(
    $data['id'],
    $name,
    $description,
    $img_path,
    $edition,
    $rareness,
    $card_condition,
    $category
);

echo json_encode(["success" => $success]);
?>
