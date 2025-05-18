<?php
require_once '../DALs/cardsDAL.php';
require_once '../DALs/coinsDAL.php';
require_once '../DALs/comicsDAL.php';
require_once '../DALs/eventsDAL.php';
require_once '../DALs/miniaturesDAL.php';
require_once '../DALs/stampsDAL.php';

$cards = new DAL_Cards();
$coins = new DAL_Coins();
$comics = new DAL_Comics();
$events = new DAL_Events();
$miniature = new DAL_Miniatures();
$stamps = new DAL_Stamps();
// // Create a new coin

$cards->createCard("Pokemon Card", "Desc", "https://www.lavanguardia.com/peliculas-series/images/profile/1975/4/w1280/9VYK7oxcqhjd5LAH6ZFJ3XzOlID.jpg", "1", "10", '1.0', "pokemon");
$cards->createCard("Yu Gui Oh Card", "Desc", "https://www.lavanguardia.com/peliculas-series/images/profile/1975/4/w1280/9VYK7oxcqhjd5LAH6ZFJ3XzOlID.jpg", "1", "10", '1.0', "yu gui oh");


$coins->createCoin(" CON Coin", "Mexico", "COIN", "Commemorative coin", "https://elceo.com/wp-content/uploads/2024/01/peso-1-1.jpg", 2, "conmemorative");
$coins->createCoin("CUR Coin", "Mexico", "COIN", "Commemorative coin", "https://elceo.com/wp-content/uploads/2024/01/peso-1-1.jpg", 2, "currency");

$comics->createComic("SCIFI Comic", "Desc", "https://www.lavanguardia.com/peliculas-series/images/profile/1975/4/w1280/9VYK7oxcqhjd5LAH6ZFJ3XzOlID.jpg", "Brand", "Editorial", "1995", "scifi");
$comics->createComic("HORROR Comic", "Desc", "https://www.lavanguardia.com/peliculas-series/images/profile/1975/4/w1280/9VYK7oxcqhjd5LAH6ZFJ3XzOlID.jpg", "Brand", "Editorial", "1995", "horror");

$events->createEvent(" TRNMT Event", "Desc", "https://www.lavanguardia.com/peliculas-series/images/profile/1975/4/w1280/9VYK7oxcqhjd5LAH6ZFJ3XzOlID.jpg", "Here", "23/01/2020", 1 ,"tournament");
$events->createEvent(" MTNG Event", "Desc", "https://www.lavanguardia.com/peliculas-series/images/profile/1975/4/w1280/9VYK7oxcqhjd5LAH6ZFJ3XzOlID.jpg", "Here", "23/01/2020", 1 ,"meeting");

$miniature->createMiniature("RPLCA Miniature", "Desc", "https://www.lavanguardia.com/peliculas-series/images/profile/1975/4/w1280/9VYK7oxcqhjd5LAH6ZFJ3XzOlID.jpg", "replica");
$miniature->createMiniature("CRTON Miniature", "Desc", "https://www.lavanguardia.com/peliculas-series/images/profile/1975/4/w1280/9VYK7oxcqhjd5LAH6ZFJ3XzOlID.jpg", "cartoon");

$stamps->createStamp("PRT Stamp", "Desc", "https://www.lavanguardia.com/peliculas-series/images/profile/1975/4/w1280/9VYK7oxcqhjd5LAH6ZFJ3XzOlID.jpg", "Country", "City", "2013", "portrait");
$stamps->createStamp("LNDSC Stamp", "Desc", "https://www.lavanguardia.com/peliculas-series/images/profile/1975/4/w1280/9VYK7oxcqhjd5LAH6ZFJ3XzOlID.jpg", "Country", "City", "2013", "landscape");


?>
