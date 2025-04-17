<?php
require_once('../../models/EventModel.php');
$eventModel = new EventModel();
$evenements = $eventModel->getAllEvents();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un événement</title>
    <link rel="stylesheet" href="../../public/css/styleCreatevent.css">
</head>
<body>
    <style>
       li {
    font-size: 19px;
    margin-bottom: 10px;
    color: black;
}

li a {
    font-size: 16px;
    text-decoration: underline;
    color: #0044cc;
}
        </style>
<div class="form-container">
    <h1>liste des événement</h1>
    <?php if (count($evenements) === 0): ?>
        <p>Aucun événement trouvé.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($evenements as $event): ?>
                <li>
                    <?= htmlspecialchars($event['titre']) ?> - <?= htmlspecialchars($event['date_evenement']) ?>
                    <a href="update_event.php?id=<?= $event['id'] ?>" style="margin-left:10px; color:blue;">Modifier</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>

</body>
</html>
