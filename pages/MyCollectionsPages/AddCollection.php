<?php
session_start();
require_once '../../DALs/collectionsDAL.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../userPages/login.php");
    exit;
}

$dal = new DAL_Collections();
$importableCollections = $dal->getOtherCollections($_SESSION['user_id']);
$dal->closeConn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Collection</title>
    <link rel="stylesheet" href="../../css/test.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<body>
<h1 class="page-title">Add New Collection</h1>

<form action="saveCollection.php" method="POST" style="margin: 0 auto; max-width: 600px;">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <input type="submit" value="Save Collection">
</form>

<h2 style="text-align:center; margin-top:50px;">Import from Existing Collections</h2>

<form action="importCollection.php" method="POST" style="margin: 0 auto; max-width: 600px;">
    <label>Select a collection to import:</label><br>
    <select name="collection_id" required>
        <?php foreach ($importableCollections as $col): ?>
            <option value="<?= $col['id'] ?>"><?= htmlspecialchars($col['name']) ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <input type="submit" value="Import">
</form>
</body>
</html>
