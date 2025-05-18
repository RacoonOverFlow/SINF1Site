<?php
// Initialize the session
if (!isset($_SESSION)) {
  session_start();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//include dal file
require_once "../DALs/loginDAL.php";

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: welcome.php");
  exit;
}

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter username.";
  } else {
    $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if (empty(trim($_POST["password_hash"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password_hash"]);
  }

  // Validate credentials
  if (empty($username_err) && empty($password_err)) {
    // Prepare a select statement
    $dal = new DAL();
    if ($dal->checkUser($username, $password)) {
      // Password is correct, so start a new session
      if (!isset($_SESSION)) {
        session_start();
      }

      // Store data in session variables
      $_SESSION["loggedin"] = true;
      //$_SESSION["id"] = $id;
      $_SESSION["username"] = $username;

      // Redirect user to welcome page
      header("location: profil.php");
    } else {
      // Username doesn't exist, display a generic error message

      $login_err = "Invalid username or password.";
    }
    $dal->closeConn();
  } else {
    // Username doesn't exist, display a generic error message

    $login_err = "Invalid username or password.";
  }
}
?>

<!DOCTYPE php>

<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
      <h2 class="loginTitle">Quag-in</h2>
      <p>Please fill in your credentials to login.</p>

      <?php
      if (!empty($login_err)) {
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
      }
      ?>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username"
            class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
            value="<?php echo $username; ?>">
          <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password_hash"
            class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Login">
        </div>

        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
      </form>
    </div>
  </div>


</body>
</php>