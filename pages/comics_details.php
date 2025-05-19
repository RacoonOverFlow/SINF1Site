<?php
require_once '../DALs/comicsDAL.php';

if (!isset($_GET['id'])) {
    die("Comic ID not provided.");
}

$comicId = intval($_GET['id']);
$dal = new DAL_Comics();
$comic = $dal->getComicById($comicId);

if (!$comic) {
    die("Comic not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($comic['name']); ?></title>
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
        <li><a class="comics active" href="../pages/comics.php">Comics</a></li>
        <!-- other links -->
    </ul>
</nav>

<hr class="filters-hr" />

<section class="box_container_primary">
    <div class="image-col">
        <img src="<?php echo htmlspecialchars($comic['img_path']); ?>" alt="<?php echo htmlspecialchars($comic['name']); ?>" />
    </div>
    <div class="details" id="comic-details" data-comic-id="<?php echo $comicId; ?>">
        <h1><?php echo htmlspecialchars($comic['name']); ?></h1>
        <p>Category: <span id="category-value"><?php echo htmlspecialchars($comic['category']); ?></span></p>
        <p>Brand: <span id="brand-value"><?php echo htmlspecialchars($comic['brand']); ?></span></p>
        <p>Editorial: <span id="editorial-value"><?php echo htmlspecialchars($comic['editorial']); ?></span></p>
        <p>Year: <span id="year-value"><?php echo htmlspecialchars($comic['year']); ?></span></p>
        <p>Description: <span id="description-value"><?php echo htmlspecialchars($comic['description']); ?></span></p>
        <button id="edit-btn">Edit</button>
        <button id="delete-btn" style="background-color:red;color:white;">Delete</button>
    </div>
</section>

<script src="../js/comicEdit.js"></script>
</body>
</html>
