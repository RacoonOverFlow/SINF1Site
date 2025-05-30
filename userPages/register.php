<?php
// Include dal file
require_once "../DALs/loginDAL.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Initialize the session

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$email = "";
$email_err = "";
$brith_date = "";
$brith_date_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        $dal = new DAL();
        $username = trim($_POST["username"]);
        if ($dal->existUser($username)) {
            $username_err = "This username is already taken.";
        }
        // Close statement
        $dal->closeConn();
    }

    // Validate password
    if (empty(trim($_POST["password_hash"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password_hash"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password_hash"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        $email = trim($_POST["email"]);
    }

    $birth_date = "";
    if (!empty($_POST['birth_date'])) {
        $birth_date = date('Y-m-d', strtotime($_POST['birth_date']));
    } else {
        // Handle error, birth_date is required
        $birth_date_err = "Please enter your birth date.";
    }


    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($birth_date_err)) {
        $dal = new DAL();
        $dal->registerUser($username, $password, $email, $birth_date);
        $dal->closeConn();
    }


}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
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

<body>
    <div class="wrapper">
        <div class="login-box">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username"
                        class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email"
                        class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $email; ?>">
                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Birth Date</label>
                    <input type="date" name="birth_date"
                        class="form-control <?php echo (!empty($birth_date_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo htmlspecialchars($birth_date ?? ''); ?>">
                    <span class="invalid-feedback"><?php echo $birth_date_err; ?></span>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password_hash"
                        class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password"
                        class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $confirm_password; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>
    </div>
</body>

</html>