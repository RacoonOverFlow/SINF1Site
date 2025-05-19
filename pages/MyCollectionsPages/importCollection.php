<?php
session_start();
require_once '../../DALs/collectionsDAL.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../userPages/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['collection_id'])) {
    $dal = new DAL_Collections();
    $dal->importCollection($_POST['collection_id'], $_SESSION['user_id']);
    $dal->closeConn();

    header("Location: ../MyCollections.php");
    exit;
}
?>
