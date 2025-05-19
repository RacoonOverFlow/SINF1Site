<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../DALs/loginDAL.php";

// Check if the user is not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Get user data
$dal = new DAL();
$userData = $dal->getUserByUsername($_SESSION["username"]);
$dal->closeConn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link rel="stylesheet" type="text/css" href="../css/login.css" />
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

    <div class="wrapper">
        <div class="login-box">
            <h2 class="loginTitle">Your Profile</h2>
            <p class="lead">Welcome back, <strong><?php echo htmlspecialchars($userData['username']); ?></strong>!</p>

            <ul class="list-group mb-4">
                <li class="list-group-item"><strong>Username:</strong> <?php echo htmlspecialchars($userData['username']); ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></li>
                <li class="list-group-item"><strong>Birth Date:</strong> <?php echo htmlspecialchars($userData['birth_date']); ?></li>
    
                <!-- Add more fields as needed -->
            </ul>

            
            <a href="updateProfile.php" class="updateButton">Update your profile</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
     
        </div>
    </div>
</body>
</html>
