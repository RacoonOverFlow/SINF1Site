<?php
require_once '../DALs/cardsDAL.php';
$dal = new DAL_Cards();

$category = isset($_GET['category']) ? $_GET['category'] : '';
$query = isset($_GET['query']) ? $_GET['query'] : '';
$categories = $dal->getAllCardCategories();

if ($query) {
    $cards = $dal->searchByName($query);
} else {
    $cards = $dal->getAllCards($category);
}
$dal->closeConn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cards</title>
    <link rel="stylesheet" href="../css/card.css" />
    <link rel="stylesheet" href="../css/test.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category-select');
            if (categorySelect) {
                categorySelect.addEventListener('change', function () {
                    const selectedCategory = this.value;
                    const query = new URLSearchParams(window.location.search).get('query');
                    let url = window.location.pathname + '?category=' + encodeURIComponent(selectedCategory);
                    if (query) url += '&query=' + encodeURIComponent(query);
                    window.location.href = url;
                });
            }
        });
    </script>
</head>

<body>
<header>
    <div class="header-container">
        <div>
            <a href="../index.php"><img class="logo" src="../Images/Logo.png" alt="logo" /></a>
        </div>

        <form action="../search.php" method="GET" class="nav-search">
            <select name="category" class="select-search" required>
                <option value="" disabled selected>Select Category</option>
                <option value="stamps">Stamps</option>
                <option value="coins">Coins</option>
                <option value="comics">Comics</option>
                <option value="cards">Cards</option>
                <option value="miniatures">Miniatures</option>
                <option value="events">Events</option>
            </select>
            <input type="text" name="query" placeholder="Search" class="search-input" required />
            <button type="submit" class="search-icon">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>

        <div class="users">
            <div class="user-icon">
                <a href="../userPages/login.php"><span class="material-symbols-outlined">person</span></a>
            </div>
            <div class="user-name">
                <p>Username</p>
            </div>
            <div class="logout">
                <button type="button" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-log-out"></span> Log out
                </button>
            </div>
        </div>
    </div>
</header>

<nav class="dashboard">
    <ul>
        <li><a class="miniatures" href="miniatures.php">Miniatures</a></li>
        <li class="divider">|</li>
        <li><a class="stamps" href="stamps.php">Stamps</a></li>
        <li class="divider">|</li>
        <li><a class="coins" href="coins.php">Coins</a></li>
        <li class="divider">|</li>
        <li><a class="comics" href="comics.php">Comics</a></li>
        <li class="divider">|</li>
        <li><a class="cards active" href="cards.php">Cards</a></li>
        <li class="divider">|</li>
        <li><a class="events" href="events.php">Events</a></li>
        <li class="divider">|</li>
        <li><a class="collections" href="MyCollections.php">My Collections</a></li>
    </ul>
</nav>

<section class="filters">
    <div>
        <select id="category-select" class="category-dropdown">
            <option value="" disabled selected>Category</option>
            <option value="">All</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= htmlspecialchars($cat) ?>" <?= $cat === $category ? 'selected' : '' ?>>
                    <?= htmlspecialchars(ucfirst($cat)) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</section>

<hr class="filters-hr" />

<main>
    <h1 class="page-title">
    <div class="card-grid">
        <?php if (empty($cards)): ?>
            <p>No cards found.</p>
        <?php else: ?>
            <?php foreach ($cards as $card): ?>
                <div class="collection_box_primary">
                    <div class="collection_image">
                        <img src="<?= htmlspecialchars($card["img_path"]) ?>" alt="Image not found" style="max-width: 100%; max-height: 100%" />
                    </div>
                    <div class="collection_text">
                        <a href="card_details.php?id=<?= htmlspecialchars($card["id"]) ?>">
                            <h1><?= htmlspecialchars($card["name"]) ?></h1>
                            <p><?= htmlspecialchars($card["edition"]) ?> - <?= htmlspecialchars($card["rareness"]) ?></p>
                        </a>
                    </div>
                    <div class="icon-container">
                        <a href="#"><img src="../Images/icons/favorite.png" alt="Favorite" /></a>
                        <a href="#"><img src="../Images/icons/search.png" alt="Search" /></a>
                        <a href="#"><img src="../Images/icons/photos.png" alt="Photos" /></a>
                        <a href="#"><img src="../Images/icons/more.png" alt="More" /></a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<script src="../js/mainPage.js"></script>
</body>
</html>
