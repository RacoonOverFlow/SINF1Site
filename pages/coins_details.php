<?php
require_once '../DALs/coinsDAL.php';

if (!isset($_GET['id'])) {
    die("Coin ID not provided.");
}

$coinId = intval($_GET['id']);
$dal = new DAL_Coins();
$coin = $dal->getCoinById($coinId);

if (!$coin) {
    die("Coin not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($coin['coin_name']); ?></title>
    <link rel="stylesheet" href="../css/singleItem.css" />
    <link rel="stylesheet" href="../css/test.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" />
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
        <li><a href="../pages/coins.php">Coins</a></li>
        <li class="divider">|</li>
        <li><a href="../pages/miniatures.php">Miniatures</a></li>
        <li class="divider">|</li>
        <li><a href="../pages/stamps.php">Stamps</a></li>
        <li class="divider">|</li>
        <li><a href="../pages/comics.php">Comics</a></li>
    </ul>
</nav>

<section class="box_container_primary">
    <div class="image-col">
        <img src="<?php echo htmlspecialchars($coin['img_path']); ?>" alt="<?php echo htmlspecialchars($coin['coin_name']); ?>" />
    </div>
    <div class="details" id="coin-details" data-coin-id="<?php echo $coinId; ?>">
        <h1><?php echo htmlspecialchars($coin['coin_name']); ?></h1>
        <p>Category: <span id="category-value"><?php echo htmlspecialchars($coin['category']); ?></span></p>
        <p>Country: <span id="country-value"><?php echo htmlspecialchars($coin['country']); ?></span></p>
        <p>Denomination: <span id="denomination-value"><?php echo htmlspecialchars($coin['denomination']); ?></span></p>
        <p>Quantity: <span id="quantity-value"><?php echo htmlspecialchars($coin['quantity']); ?></span></p>
        <p>Description: <span id="description-value"><?php echo htmlspecialchars($coin['description']); ?></span></p>
        <button id="edit-btn">Edit</button>
        <button id="delete-btn" style="background-color: red; color: white;">Delete</button>
    </div>
</section>

<script src="../js/coinEdit.js"></script>
</body>
</html>
