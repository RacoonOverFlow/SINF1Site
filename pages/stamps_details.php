<?php
require_once '../DALs/stampsDAL.php';

if (!isset($_GET['id'])) {
    die("Stamp ID not provided.");
}

$stampId = intval($_GET['id']);
$dal = new DAL_Stamps();
$stamp = $dal->getStampById($stampId);

if (!$stamp) {
    die("Stamp not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($stamp['name']); ?></title>
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
        <li><a class="stamps active" href="../pages/stamps.php">Stamps</a></li>
        <!-- other categories omitted for brevity -->
    </ul>
</nav>

<hr class="filters-hr" />

<section class="box_container_primary">
    <div class="image-col">
        <img src="<?php echo htmlspecialchars($stamp['img_path']); ?>" alt="<?php echo htmlspecialchars($stamp['name']); ?>" />
    </div>
    <div class="details" id="stamp-details" data-stamp-id="<?php echo $stampId; ?>">
        <h1><?php echo htmlspecialchars($stamp['name']); ?></h1>
        <p>Category: <span id="category-value"><?php echo htmlspecialchars($stamp['category']); ?></span></p>
        <p>Description: <span id="description-value"><?php echo htmlspecialchars($stamp['description']); ?></span></p>
        <button id="edit-btn">Edit</button>
        <button id="delete-btn" style="background-color:red;color:white;">Delete</button>
    </div>
</section>

<script src="../js/stampEdit.js"></script>
</body>
</html>
