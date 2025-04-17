<?php

class InscriptionModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function isAlreadyRegistered($participant_id, $event_id) {
        $sql = "SELECT * FROM inscriptions WHERE participant_id = :participant_id AND event_id = :event_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':participant_id', $participant_id);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function register($participant_id, $event_id) {
        $sql = "INSERT INTO inscriptions (participant_id, event_id) VALUES (:participant_id, :event_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':participant_id', $participant_id);
        $stmt->bindParam(':event_id', $event_id);
        return $stmt->execute();
    }
}
