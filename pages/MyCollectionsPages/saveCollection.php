<?php
session_start();
require_once '../../DALs/collectionsDAL.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../userPages/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dal = new DAL_Collections();
    $dal->insertCollection($_SESSION['user_id'], $_POST['name'], $_POST['description']);
    $dal->closeConn();

    header("Location: ../MyCollections.php");
    exit;
}
?>
