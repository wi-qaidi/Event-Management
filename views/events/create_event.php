<?php
session_start(); 

require_once('../../models/EventModel.php');
$message = "";
if (isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    unset($_SESSION['success']); 
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $date_evenement = $_POST['date_evenement'];
    $description = $_POST['description'];

    $eventModel = new EventModel();
    $eventModel->createEvent($titre, $date_evenement, $description);
    $_SESSION['success'] = " Événement ajouté avec succès !";
    header("Location: create_event.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement</title>
    <link rel="stylesheet" href="../../public/css/styleCreatevent.css">
</head>
<body>

<div class="form-container">
    <h1>Créer un événement</h1>

    <!-- Message de succès -->
    <?php if (!empty($message)): ?>
        <div style="color:blue;text-align: center; margin-bottom: 10px;">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" class="inp" name="titre" placeholder="Titre de l'événement" required><br><br>

        <input type="date" class="inp" name="date_evenement" required><br><br>

        <textarea class="inp" name="description" placeholder="Description de l'événement" required></textarea><br><br>

        <button type="submit">Ajouter</button>
        <br>
    </form>
    <div class="link-container">
    <a href="list_event.php">Modifier un événement?</a>
</div>

</div>

</body>
</html>
