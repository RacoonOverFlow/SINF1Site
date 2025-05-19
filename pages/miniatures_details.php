<?php
require_once '../DALs/miniaturesDAL.php';

if (!isset($_GET['id'])) {
    die("Miniature ID not provided.");
}

$miniId = intval($_GET['id']);
$dal = new DAL_Miniatures();
$miniature = $dal->getMiniatureById($miniId);

if (!$miniature) {
    die("Miniature not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($miniature['name']); ?></title>
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
    <div class="nav-search">
        <select class="select-search">
            <option>All</option>
            <option>All Categories</option>
        </select>
        <input type="text" placeholder="Search" class="search-input" />
        <div class="search-icon">
            <span class="material-symbols-outlined">search</span>
        </div>
    </div>
</header>

<nav class="dashboard">
    <ul>
        <li><a class="miniatures active" href="../pages/miniatures.php">Miniatures</a></li>
        <li class="divider">|</li>
        <li><a class="stamps" href="../pages/stamps.php">Stamps</a></li>
        <li class="divider">|</li>
        <li><a class="coins" href="../pages/coins.php">Coins</a></li>
        <li class="divider">|</li>
        <li><a class="comics" href="../pages/comics.php">Comics</a></li>
        <li class="divider">|</li>
        <li><a class="cards" href="../pages/cards.php">Cards</a></li>
        <li class="divider">|</li>
        <li><a class="events" href="../pages/events.php">Events</a></li>
        <li class="divider">|</li>
        <li><a class="collections" href="../pages/MyCollections.php">My Collections</a></li>
    </ul>
</nav>

<div class="more-categories" id="more-categories">
    <ul>
        <li><a href="#">Category 1</a></li>
        <li><a href="#">Category 2</a></li>
        <li><a href="#">Category 3</a></li>
        <li><a href="#">Category 4</a></li>
    </ul>
</div>

<hr class="filters-hr" />

<section class="box_container_primary">
    <div class="image-col">
        <img src="<?php echo htmlspecialchars($miniature['img_path']); ?>" alt="<?php echo htmlspecialchars($miniature['name']); ?>" />
    </div>
    <div class="details" id="miniature-details" data-mini-id="<?php echo $miniId; ?>">
        <h1><?php echo htmlspecialchars($miniature['name']); ?></h1>
        <p>Category: <span id="category-value"><?php echo htmlspecialchars($miniature['category']); ?></span></p>
        <p>Description: <span id="description-value"><?php echo htmlspecialchars($miniature['description']); ?></span></p>
        <button id="edit-btn">Edit</button>
        <button id="delete-btn" style="background-color:red;color:white;">Delete</button>
    </div>
</section>

<script src="../js/mainPage.js"></script>
<script src="../js/miniatureEdit.js"></script>
</body>
</html>
