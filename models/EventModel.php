<?php
require_once(__DIR__ . '/../config/Database.php');


class EventModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllEvents() {
        $query = "SELECT * FROM events ORDER BY date_evenement DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createEvent($titre, $date_evenement, $description) {
        $query = "INSERT INTO events (titre, date_evenement, description) VALUES (:titre, :date_evenement, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':date_evenement', $date_evenement);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function deleteEvent($id) {
        $query = "DELETE FROM events WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getEventById($id) {
        $query = "SELECT * FROM events WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEvent($id, $titre, $date_evenement, $description) {
        $query = "UPDATE events SET titre = :titre, date_evenement = :date_evenement, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':date_evenement', $date_evenement);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
