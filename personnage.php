<?php
require_once "pdo.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID du personnage invalide.");
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("
    SELECT nom, description 
    FROM personnages 
    WHERE id = ?
");
$stmt->execute([$id]);
$personnage = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$personnage) {
    die("Personnage introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($personnage['nom']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($personnage['nom']) ?></h1>
    <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($personnage['description'])) ?></p>

    <a href="index.php">Retour à la page d’accueil</a>
</body>
</html>
