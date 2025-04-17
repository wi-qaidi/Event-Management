<?php

class ParticipantModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createParticipant($nom, $email) {
        $sql = "INSERT INTO participants (nom, email) VALUES (:nom, :email)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function getParticipantByEmail($email) {
        $sql = "SELECT * FROM participants WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllParticipants() {
        $sql = "SELECT * FROM participants";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>