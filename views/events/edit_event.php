<?php
require_once '../../models/EventModel.php';
require_once '../../config/Database.php';

$database = new Database();
$db = $database->getConnection();
$eventModel = new EventModel($db);

$message = "";
$event = null;

// Si formulaire soumis pour mise à jour
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_evenement = $_POST['date_evenement'];

    if ($eventModel->updateEvent($id, $titre, $description, $date_evenement)) {
        $message = "Événement modifié avec succès.";
    } else {
        $message = "Erreur lors de la modification.";
    }
}

// Si un événement est sélectionné via GET
if (isset($_GET['id'])) {
    $event = $eventModel->getEventById($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un événement</title>
    <link rel="stylesheet" href="../../public/css/styleCreatevent.css">
</head>
<body>
    <div class="form-container">
        <h2>Modifier l'événement</h2>
        <p style="color: green"><?= $message ?></p>

        <?php if ($event): ?>
            <form method="post">
                <input type="hidden" name="id" value="<?= $event['id'] ?>">

                <label>Titre :</label><br>
                <input type="text" name="titre" value="<?= htmlspecialchars($event['titre']) ?>" required><br><br>

                <label>Description :</label><br>
                <textarea name="description" required><?= htmlspecialchars($event['description']) ?></textarea><br><br>

                <label>Date de l'événement :</label><br>
                <input type="date" name="date_evenement" value="<?= $event['date_evenement'] ?>" required><br><br>

                <button type="submit" name="update">Enregistrer les modifications</button>
            </form>
        <?php else: ?>
            <p style="color:red;">Événement introuvable.</p>
        <?php endif; ?>
    </div>
</body>
</html>
