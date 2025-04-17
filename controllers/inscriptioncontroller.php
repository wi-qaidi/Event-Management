<?php
require_once 'models/InscriptionModel.php';

class InscriptionController {
    private $inscriptionModel;

    public function __construct() {
        $this->inscriptionModel = new InscriptionModel();
    }

    public function registerParticipant($event_id, $participant_id) {
        return $this->inscriptionModel->createInscription($event_id, $participant_id);
    }
}
?>
