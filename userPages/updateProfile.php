<?php
session_start();
require_once "../DALs/loginDAL.php";

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$dal = new DAL();
$userId = $_SESSION['user_id'];
$update_success = false;
$error = "";

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = trim($_POST["username"]);
    $new_email = trim($_POST["email"]);
    $new_birth_date = trim($_POST["birth_date"]);

    if (!empty($new_username) && !empty($new_email) && !empty($new_birth_date)) {
        $update_success = $dal->updateUser($userId, $new_username, $new_email, $new_birth_date);
        if ($update_success) {
            $_SESSION['username'] = $new_username;
        } else {
            $error = "Update failed. Please try again.";
        }
    } else {
        $error = "All fields are required.";
    }
}

// Fetch updated user data
$user = $dal->getUserById($userId);
$dal->closeConn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .profile-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 25px;
            border-radius: 10px;
            background-color: #f8f9fa;
        }
        .form-group label {
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="container profile-container">
    <h2>Your Profile</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif ($update_success): ?>
        <div class="alert alert-success">Profile updated successfully.</div>
    <?php endif; ?>

    <form method="POST" action="profile.php">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="form-group">
            <label>Birth Date</label>
            <input type="date" name="birth_date" class="form-control" value="<?= htmlspecialchars($user['birth_date']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="../pages/MyCollections.php" class="btn btn-secondary ml-2">Back to Collections</a>
    </form>
</div>
</body>
</html>
