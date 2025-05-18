<?php
class DAL_Comics {

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

    public function createComic($name, $description, $img_path, $brand, $editorial, $year, $category) {
        $sql = "INSERT INTO comics (name, description, img_path, brand, editorial, year, category) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $description, $img_path, $brand, $editorial, $year, $category);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function getComicById($id) {
        $sql = "SELECT id, name, description, img_path, brand, editorial, year, category FROM comics WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $id, $name, $description, $img_path, $brand, $editorial, $year, $category);
                if (mysqli_stmt_fetch($stmt)) {
                    return array(
                        "id" => $id,
                        "name" => $name,
                        "description" => $description,
                        "img_path" => $img_path,
                        "brand" => $brand,
                        "editorial" => $editorial,
                        "year" => $year,
                        "category" => $category
                    );
                }
            }
        }
        return null;
    }

    public function getAllComics($category = '') {
        if ($category === '') {
            $sql = "SELECT id, name, description, img_path, brand, editorial, year, category FROM comics";
            $result = mysqli_query($this->link, $sql);
        } else {
            $sql = "SELECT id, name, description, img_path, brand, editorial, year, category FROM comics WHERE category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $category);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }

        $comics = array();
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $comics[] = $row;
            }
        }

        return $comics;
    }

    public function updateComic($id, $name, $description, $img_path, $brand, $editorial, $year, $category) {
        $sql = "UPDATE comics SET name = ?, description = ?, img_path = ?, brand = ?, editorial = ?, year = ?, category = ? WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssssi", $name, $description, $img_path, $brand, $editorial, $year, $category, $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function deleteComic($id) {
        $sql = "DELETE FROM comics WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function searchComicsByName($searchTerm, $category = '') {
        if ($category === '') {
            $sql = "SELECT id, name, description, img_path, brand, editorial, year, category 
                    FROM comics 
                    WHERE name LIKE ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "s", $likeTerm);
        } else {
            $sql = "SELECT id, name, description, img_path, brand, editorial, year, category 
                    FROM comics 
                    WHERE name LIKE ? AND category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "ss", $likeTerm, $category);
        }

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $comics = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $comics[] = $row;
            }
            return $comics;
        }

        return array();
    }
}
?>