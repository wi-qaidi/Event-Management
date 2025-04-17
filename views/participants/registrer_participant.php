<?php
require_once '../../models/ParticipantModel.php';
require_once '../../models/EventModel.php';
require_once '../../models/InscriptionModel.php';
require_once '../../config/Database.php';

$database = new Database();
$db = $database->getConnection();

$eventModel = new EventModel($db);
$participantModel = new ParticipantModel($db);
$inscriptionModel = new InscriptionModel($db);

$evenements = $eventModel->getAllEvents();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $event_id = $_POST['event_id'];

    if (!empty($nom) && !empty($email) && !empty($event_id)) {
        $participant = $participantModel->getParticipantByEmail($email);

        if (!$participant) {
            $participant_id = $participantModel->createParticipant($nom, $email);
        } else {
            $participant_id = $participant['id'];
        }

        if (!$inscriptionModel->isAlreadyRegistered($participant_id, $event_id)) {
            $inscriptionModel->register($participant_id, $event_id);
            $message = "Inscription réussie !";
        } else {
            $message = "Vous êtes déjà inscrit à cet événement.";
        }
    } else {
        $message = "Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription à un événement</title>
    <link rel="stylesheet" href="../../public/css/styleregister.css">
</head>
<body>
    <div class="container">
        <h2>Inscription à un événement</h2>
        <p style="color: green;"><?= $message ?></p>
        <form method="post">
            <div class="form-group">
                <input type="text" name="nom" placeholder="Votre nom" required><br><br>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Votre email" required><br><br>
            </div>
            <div class="form-group">
                <select name="event_id" required>
                    <option value="">-- Choisissez un événement --</option>
                    <?php foreach ($evenements as $event): ?>
                        <option value="<?= $event['id'] ?>"><?= $event['titre'] ?> (<?= $event['date_evenement'] ?>)</option>
                    <?php endforeach; ?>
                </select><br><br>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>
