<?php
class DAL_Collections {
    private $link;

    public function __construct() {
        $this->link = new mysqli("localhost", "root", "", "website");
        if (mysqli_connect_errno()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    public function getUserCollections($userId) {
        $stmt = $this->link->prepare("SELECT * FROM collections WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function insertCollection($userId, $name, $description) {
        $stmt = $this->link->prepare("INSERT INTO collections (user_id, name, description) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userId, $name, $description);
        return $stmt->execute();
    }

    public function getOtherCollections($userId) {
        $stmt = $this->link->prepare("SELECT id, name FROM collections WHERE user_id != ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function importCollection($collectionId, $userId) {
        $stmt = $this->link->prepare("SELECT name, description FROM collections WHERE id = ?");
        $stmt->bind_param("i", $collectionId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result) {
            return $this->insertCollection($userId, $result['name'], $result['description']);
        }

        return false;
    }

    public function closeConn() {
        $this->link->close();
    }
}
