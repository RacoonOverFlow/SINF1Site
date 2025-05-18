<?php
class DAL_Stamps {

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

    public function createStamp($name, $description, $img_path, $country, $city, $year, $category) {
        $sql = "INSERT INTO stamps (name, description, img_path, country, city, year, category) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $description, $img_path, $country, $city, $year, $category);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function getStampById($id) {
        $sql = "SELECT id, name, description, img_path, country, city, year, category FROM stamps WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $id, $name, $description, $img_path, $country, $city, $year, $category);
                if (mysqli_stmt_fetch($stmt)) {
                    return array(
                        "id" => $id,
                        "name" => $name,
                        "description" => $description,
                        "img_path" => $img_path,
                        "country" => $country,
                        "city" => $city,
                        "year" => $year,
                        "category" => $category
                    );
                }
            }
        }
        return null;
    }

    public function getAllStamps($category = '') {
        if ($category === '') {
            $sql = "SELECT id, name, description, img_path, country, city, year, category FROM stamps";
            $result = mysqli_query($this->link, $sql);
        } else {
            $sql = "SELECT id, name, description, img_path, country, city, year, category FROM stamps WHERE category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $category);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }

        $stamps = array();
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $stamps[] = $row;
            }
        }

        return $stamps;
    }

    public function updateStamp($id, $name, $description, $img_path, $country, $city, $year, $category) {
        $sql = "UPDATE stamps SET name = ?, description = ?, img_path = ?, country = ?, city = ?, year = ?, category = ? WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssssi", $name, $description, $img_path, $country, $city, $year, $category, $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function deleteStamp($id) {
        $sql = "DELETE FROM stamps WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function searchStampsByName($searchTerm, $category = '') {
        if ($category === '') {
            $sql = "SELECT id, name, description, img_path, country, city, year, category 
                    FROM stamps 
                    WHERE name LIKE ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "s", $likeTerm);
        } else {
            $sql = "SELECT id, name, description, img_path, country, city, year, category 
                    FROM stamps 
                    WHERE name LIKE ? AND category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "ss", $likeTerm, $category);
        }

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $stamps = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $stamps[] = $row;
            }
            return $stamps;
        }

        return array();
    }
}
?>
