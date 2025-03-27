<?php
require_once "pdo.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID du manga invalide.");
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("
    SELECT mangas.titre, mangas.annee_publication, mangas.description, auteurs.nom AS auteur 
    FROM mangas
    JOIN auteurs ON mangas.auteur_id = auteurs.id
    WHERE mangas.id = ?
");
$stmt->execute([$id]);
$manga = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$manga) {
    die("Manga introuvable.");
}

$stmt = $pdo->prepare("
    SELECT id, nom 
    FROM personnages
    WHERE manga_id = ?
");
$stmt->execute([$id]);
$personnages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($manga['titre']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($manga['titre']) ?></h1>
    <p><strong>Auteur :</strong> <?= htmlspecialchars($manga['auteur']) ?></p>
    <p><strong>Année de publication :</strong> <?= htmlspecialchars($manga['annee_publication']) ?></p>
    <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($manga['description'])) ?></p>

    <h2>Personnages :</h2>
    <?php if (!empty($personnages)): ?>
        <ul>
            <?php foreach ($personnages as $perso): ?>
                <li><a href="personnage.php?id=<?= $perso['id'] ?>"><?= htmlspecialchars($perso['nom']) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun personnage trouvé pour ce manga.</p>
    <?php endif; ?>

    <a href="index.php">Retour à la liste</a>
</body>
</html>
