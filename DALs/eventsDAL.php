<?php
class DAL_Events {

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

    public function createEvent($title, $description, $img_path, $place, $date, $user_id, $category) {
        $sql = "INSERT INTO events (title, description, img_path, place, date, user_id, category) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssis", $title, $description, $img_path, $place, $date, $user_id, $category);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function getEventById($id) {
        $sql = "SELECT id, title, description, img_path, place, date, user_id, category FROM events WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $id, $title, $description, $img_path, $place, $date, $user_id, $category);
                if (mysqli_stmt_fetch($stmt)) {
                    return array(
                        "id" => $id,
                        "title" => $title,
                        "description" => $description,
                        "img_path" => $img_path,
                        "place" => $place,
                        "date" => $date,
                        "user_id" => $user_id,
                        "category" => $category
                    );
                }
            }
        }
        return null;
    }

    public function getAllEvents($category = '') {
        if ($category === '') {
            $sql = "SELECT id, title, description, img_path, place, date, user_id, category FROM events";
            $result = mysqli_query($this->link, $sql);
        } else {
            $sql = "SELECT id, title, description, img_path, place, date, user_id, category FROM events WHERE category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $category);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }

        $events = array();
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $events[] = $row;
            }
        }

        return $events;
    }

    public function updateEvent($id, $title, $description, $img_path, $place, $date, $user_id, $category) {
        $sql = "UPDATE events SET title = ?, description = ?, img_path = ?, place = ?, date = ?, user_id = ?, category = ? WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssisi", $title, $description, $img_path, $place, $date, $user_id, $category, $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function deleteEvent($id) {
        $sql = "DELETE FROM events WHERE id = ?";
        if ($stmt = mysqli_prepare($this->link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function searchEventsByTitle($searchTerm, $category = '') {
        if ($category === '') {
            $sql = "SELECT id, title, description, img_path, place, date, user_id, category 
                    FROM events 
                    WHERE title LIKE ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "s", $likeTerm);
        } else {
            $sql = "SELECT id, title, description, img_path, place, date, user_id, category 
                    FROM events 
                    WHERE title LIKE ? AND category = ?";
            $stmt = mysqli_prepare($this->link, $sql);
            $likeTerm = '%' . $searchTerm . '%';
            mysqli_stmt_bind_param($stmt, "ss", $likeTerm, $category);
        }

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $events = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $events[] = $row;
            }
            return $events;
        }

        return array();
    }
}
?>