<?php
class DAL_Miniatures {

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

    public function createMiniature($name, $description, $img_path, $category) {
        $sql = "INSERT INTO miniatures (name, description, img_path, category) VALUES (?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $name, $description, $img_path, $category);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function getMiniatureById($id) {
        $sql = "SELECT id, name, description, img_path, category FROM miniatures WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $id, $name, $description, $img_path, $category);
                if (mysqli_stmt_fetch($stmt)) {
                    return array(
                        "id" => $id,
                        "name" => $name,
                        "description" => $description,
                        "img_path" => $img_path,
                        "category" => $category
                    );
                }
            }
        }
        return null;
    }

    public function getAllMiniatures($category = '') {
        if ($category === '') {
            $sql = "SELECT id, name, description, img_path, category FROM miniatures";
            $result = mysqli_query($this->link, $sql);
        } else {
            $sql = "SELECT id, name, description, img_path, category FROM miniatures WHERE category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $category);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }

        $miniatures = array();
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $miniatures[] = $row;
            }
        }

        return $miniatures;
    }

    public function updateMiniature($id, $name, $description, $img_path, $category) {
        $sql = "UPDATE miniatures SET name = ?, description = ?, img_path = ?, category = ? WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssi", $name, $description, $img_path, $category, $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function deleteMiniature($id) {
        $sql = "DELETE FROM miniatures WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function searchMiniaturesByName($searchTerm, $category = '') {
        if ($category === '') {
            $sql = "SELECT id, name, description, img_path, category 
                    FROM miniatures 
                    WHERE name LIKE ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "s", $likeTerm);
        } else {
            $sql = "SELECT id, name, description, img_path, category 
                    FROM miniatures 
                    WHERE name LIKE ? AND category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "ss", $likeTerm, $category);
        }

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $miniatures = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $miniatures[] = $row;
            }
            return $miniatures;
        }

        return array();
    }
}
?>