<?php
// Set response type to JSON
header("Content-Type: application/json");

// Include your DAL_Coins class (adjust the path as needed)
require_once '../../../DALs/coinsDAL.php';


// Helper function to read JSON input
function getJsonInput() {
    $json = file_get_contents('php://input');
    return json_decode($json, true);
}

// Accept both application/json and x-www-form-urlencoded
$input = $_SERVER['CONTENT_TYPE'] === 'application/json'
    ? getJsonInput()
    : $_POST;

// Validate required fields
$required = ['coin_name', 'country', 'denomination', 'description', 'img_path', 'quantity', 'category'];
foreach ($required as $field) {
    if (empty($input[$field])) {
        http_response_code(400);
        echo json_encode(['error' => "Missing or empty field: $field"]);
        exit;
    }
}

// Extract input values
$coin_name   = $input['coin_name'];
$country     = $input['country'];
$denomination = $input['denomination'];
$description = $input['description'];
$img_path    = $input['img_path'];
$quantity    = (int)$input['quantity'];
$category    = $input['category'];

// Call the DAL function
$dal = new DAL_Coins();
$success = $dal->createCoin($coin_name, $country, $denomination, $description, $img_path, $quantity, $category);

if ($success) {
    echo json_encode(['success' => true, 'message' => 'Coin created successfully.']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to create coin.']);
}
