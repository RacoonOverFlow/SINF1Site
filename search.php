<?php
$category = isset($_GET['category']) ? $_GET['category'] : '';
$query = isset($_GET['query']) ? $_GET['query'] : '';

require_once 'DALs/stampsDAL.php';
require_once 'DALs/coinsDAL.php';
require_once 'DALs/comicsDAL.php';
require_once 'DALs/cardsDAL.php';
require_once 'DALs/miniaturesDAL.php';
require_once 'DALs/eventsDAL.php';

$dalMap = [
    'stamps' => new DAL_Stamps(),
    'coins' => new DAL_Coins(),
    'comics' => new DAL_Comics(),
    'cards' => new DAL_Cards(),
    'miniatures' => new DAL_Miniatures(),
    'events' => new DAL_Events()
];

if ($category && $query && isset($dalMap[$category])) {
    if (method_exists($dalMap[$category], 'closeConn')) {
        $dalMap[$category]->closeConn();
    }

    header("Location: pages/{$category}.php?query=" . urlencode($query));
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="css/test.css">
</head>
<body>
<h1>Search Results</h1>
<p>No results found or invalid search input.</p>
<a href="index.php">&larr; Back to Home</a>
</body>
</html>
