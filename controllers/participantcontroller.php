<?php
require_once 'models/EventModel.php';

class EventController {
    private $eventModel;

    public function __construct() {
        $this->eventModel = new EventModel();
    }

    public function listEvents() {
        return $this->eventModel->getAllEvents();
    }

    public function addEvent($titre, $date_evenement, $description) {
        return $this->eventModel->createEvent($titre, $date_evenement, $description);
    }

    public function deleteEvent($id) {
        return $this->eventModel->deleteEvent($id);
    }

    public function getEvent($id) {
        return $this->eventModel->getEventById($id);
    }

    public function updateEvent($id, $titre, $date_evenement, $description) {
        return $this->eventModel->updateEvent($id, $titre, $date_evenement, $description);
    }
}
?>
