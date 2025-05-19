    <?php
    class DAL {

        //database name
        private $DB_NAME = 'website';
        //host tipically is the localhost
        private $DB_HOST = 'localhost';
        //database username
        private $DB_USER = 'root';
        //password for the username metioned 
        private $DB_PASS = '';
        
        private $link = null;

        public function __construct() {
            //open connection
        $this->link = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
            if (mysqli_connect_errno())
                return NULL;
        }

        public function closeConn() {
            // Close connection
            mysqli_close($this->link);
        }

    public function existUser($username) {
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                return mysqli_stmt_num_rows($stmt) === 1;
            }
        }
        return false;
    }


    public function checkUser($username, $password) {
        $sql = "SELECT id, username, password_hash FROM users WHERE username = ?";
        
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $id, $db_username, $hashed_password);

                if (mysqli_stmt_fetch($stmt)) {
                    return password_verify($password, $hashed_password);
                }
            }
        }
        return false;
    }


public function registerUser($username, $password, $email, $birth_date) {
    $sql = "INSERT INTO users (username, password_hash, email, birth_date) VALUES (?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($this->link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_email, $param_birth_date);

        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_email = $email;
        $param_birth_date = $birth_date;

        if (mysqli_stmt_execute($stmt)) {
            header("location: login.php");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
}

public function getUserByUsername($username) {
    $sql = "SELECT id, username, email, birth_date FROM users WHERE username = ?";
    
    if ($stmt = mysqli_prepare($this->link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $id, $username, $email, $birth_date);
            
            if (mysqli_stmt_fetch($stmt)) {
                return [
                    'id' => $id,
                    'username' => $username,
                    'email' => $email,
                    'birth_date' => $birth_date
                ];
            }
        }
    }
    return null;
}

public function getUserById($id) {
    $sql = "SELECT username, email, birth_date FROM users WHERE id = ?";
    if ($stmt = mysqli_prepare($this->link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $username, $email, $birth_date);
            if (mysqli_stmt_fetch($stmt)) {
                return [
                    'username' => $username,
                    'email' => $email,
                    'birth_date' => $birth_date
                ];
            }
        }
    }
    return null;
}

public function updateUser($id, $username, $email, $birth_date) {
    $sql = "UPDATE users SET username = ?, email = ?, birth_date = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($this->link, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $birth_date, $id);
        return mysqli_stmt_execute($stmt);
    }
    return false;
}


        public function resetPassword($username, $password) {
            $sql = "UPDATE users SET password_hash = ? WHERE username = ?";
            if ($stmt = mysqli_prepare($this->link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_password, $username);

                // Set parameters
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt))
                    return True;
                return False;
            }
        }

    }
