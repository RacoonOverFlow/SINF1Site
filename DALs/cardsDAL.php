
<?php
class DAL_Cards {

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

    public function createCard($name, $description, $img_path, $edition, $rareness, $condition, $category) {
        $sql = "INSERT INTO cards (name, description, img_path, edition, rareness, card_condition, category) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $description, $img_path, $edition, $rareness, $condition, $category);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function getCardById($id) {
        $sql = "SELECT id, name, description, img_path, edition, rareness, card_condition, category FROM cards WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $id, $name,
                 $description, $img_path, $edition, $rareness, $condition, $category);
                if (mysqli_stmt_fetch($stmt)) {
                    return array(
                        "id" => $id,
                        "name" => $name,
                        "description" => $description,
                        "img_path" => $img_path,
                        "edition" => $edition,
                        "rareness" => $rareness,
                        "condition" => $condition,
                        "category" => $category
                    );
                }
            }
        }
        return null;
    }

    public function getAllCards($category = '') {
        if ($category === '') {
            $sql = "SELECT id, name, description, img_path, edition, rareness, card_condition, category FROM cards";
            $result = mysqli_query($this->link, $sql);
        } else {
            $sql = "SELECT id, name, description, img_path, edition, rareness, card_condition, category FROM cards WHERE category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $category);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }

        $cards = array();
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cards[] = $row;
            }
        }

        return $cards;
    }

    public function updateCard($id, $name, $description, $img_path, $edition, $rareness, $condition, $category) {
        $sql = "UPDATE cards SET name = ?, description = ?, img_path = ?, edition = ?, rareness = ?, card_condition = ?, category = ? WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssssi", $name, $description, $img_path, $edition, $rareness, $condition, $category, $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function deleteCard($id) {
        $sql = "DELETE FROM cards WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function searchCardsByName($searchTerm, $category = '') {
        if ($category === '') {
            $sql = "SELECT id, name, description, img_path, edition, rareness, card_condition, category 
                    FROM cards 
                    WHERE name LIKE ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "s", $likeTerm);
        } else {
            $sql = "SELECT id, name, description, img_path, edition, rareness, card_condition, category 
                    FROM cards 
                    WHERE name LIKE ? AND category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "ss", $likeTerm, $category);
        }

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $cards = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $cards[] = $row;
            }
            return $cards;
        }

        return array();
    }
    public function searchByName($query) {
        $stmt = $this->link->prepare("SELECT * FROM cards WHERE name LIKE CONCAT('%', ?, '%')");
        $stmt->bind_param("s", $query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function getAllCardCategories() {
        $sql = "SELECT DISTINCT category FROM cards WHERE category IS NOT NULL AND category != ''";
        $result = mysqli_query($this->link, $sql);
        $categories = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row['category'];
            }
        }
        return $categories;
    }
    public function addCard($name, $description, $img_path, $edition, $rareness, $condition, $category) {
        $stmt = $this->link->prepare("INSERT INTO cards (name, description, img_path, edition, rareness, card_condition, category) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $description, $img_path, $edition, $rareness, $condition, $category);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }


}
?>