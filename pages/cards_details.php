<?php
require_once '../DALs/cardsDAL.php';

if (!isset($_GET['id'])) {
    die("Card ID not provided.");
}

$cardId = intval($_GET['id']);
$dal = new DAL_Cards();
$card = $dal->getCardById($cardId);

if (!$card) {
    die("Card not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($card['name']); ?></title>
    <link rel="stylesheet" href="../css/singleItem.css" />
    <link rel="stylesheet" href="../css/test.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<body>
<header>
    <div>
        <a href="../index.php"><img class="logo" src="../Images/Logo.png" alt="logo" /></a>
    </div>
</header>

<nav class="dashboard">
    <ul>
        <li><a href="../pages/cards.php" class="cards active">Cards</a></li>
        <!-- other links -->
    </ul>
</nav>

<hr class="filters-hr" />

<section class="box_container_primary">
    <div class="image-col">
        <img src="<?php echo htmlspecialchars($card['img_path']); ?>" alt="<?php echo htmlspecialchars($card['name']); ?>" />
    </div>
    <div class="details" id="card-details" data-card-id="<?php echo $cardId; ?>">
        <h1><?php echo htmlspecialchars($card['name']); ?></h1>
        <p>Category: <span id="category-value"><?php echo htmlspecialchars($card['category']); ?></span></p>
        <p>Description: <span id="description-value"><?php echo htmlspecialchars($card['description']); ?></span></p>
        <button id="edit-btn">Edit</button>
        <button id="delete-btn" style="background:red;color:white;">Delete</button>
    </div>
</section>

<script src="../js/cardEdit.js"></script>
</body>
</html>
