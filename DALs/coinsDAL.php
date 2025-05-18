<?php
class DAL_Coins {

    private $DB_NAME = 'website';
    private $DB_HOST = 'localhost';
    private $DB_USER = 'root';
    private $DB_PASS = '';

    private $link = null;

    public function __construct() {
        $this->link = new mysqli($this->DB_HOST, $this->DB_USER, '', $this->DB_NAME);
        if (mysqli_connect_errno()) return NULL;
    }

    public function closeConn() {
        mysqli_close($this->link);
    }

    public function createCoin($coin_name, $country, $denomination, $description, $img_path, $quantity, $category) {
        $sql = "INSERT INTO coins (coin_name, country, denomination, description, img_path, quantity, category) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssis", $coin_name, $country, $denomination, $description, $img_path, $quantity, $category);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function getCoinById($id) {
        $sql = "SELECT id, coin_name, country, denomination, description, img_path, quantity, category FROM coins WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $id, $coin_name, $country, $denomination, $description, $img_path, $quantity, $category);
                if (mysqli_stmt_fetch($stmt)) {
                    return array(
                        "id" => $id,
                        "coin_name" => $coin_name,
                        "country" => $country,
                        "denomination" => $denomination,
                        "description" => $description,
                        "img_path" => $img_path,
                        "quantity" => $quantity,
                        "category" => $category
                    );
                }
            }
        }
        return null;
    }

    public function getAllCoins($category = '') {
        if ($category === '') {
            $sql = "SELECT id, coin_name, country, denomination, description, img_path, quantity, category FROM coins";
            $result = mysqli_query($this->link, $sql);
        } else {
            $sql = "SELECT id, coin_name, country, denomination, description, img_path, quantity, category FROM coins WHERE category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $category);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }

        $coins = array();
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $coins[] = $row;
            }
        }

        return $coins;
    }

    public function updateCoin($id, $coin_name, $country, $denomination, $description, $img_path, $quantity, $category) {
        $sql = "UPDATE coins SET coin_name = ?, country = ?, denomination = ?, description = ?, img_path = ?, quantity = ?, category = ? WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssisi", $coin_name, $country, $denomination, $description, $img_path, $quantity, $category, $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function deleteCoin($id) {
        $sql = "DELETE FROM coins WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function searchCoinsByName($searchTerm, $category = '') {
        if ($category === '') {
            $sql = "SELECT id, coin_name, country, denomination, description, img_path, quantity, category 
                    FROM coins 
                    WHERE coin_name LIKE ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "s", $likeTerm);
        } else {
            $sql = "SELECT id, coin_name, country, denomination, description, img_path, quantity, category 
                    FROM coins 
                    WHERE coin_name LIKE ? AND category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "ss", $likeTerm, $category);
        }

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $coins = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $coins[] = $row;
            }
            return $coins;
        }

        return array();
    }
}
?>
