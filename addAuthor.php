<?php
require_once "pdo.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $date_naissance = $_POST["date_naissance"] ?? "";

    if (!empty($nom) && !empty($date_naissance)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO auteurs (nom, date_naissance) VALUES (?, ?)");
            $stmt->execute([$nom, $date_naissance]);
            $message = "Auteur ajouté avec succès !";
        } catch (PDOException $e) {
            $message = "Erreur lors de l'ajout : " . $e->getMessage();
        }
    } else {
        $message = "Tous les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Auteur</title>
</head>
<body>
    <h1>Ajouter un Auteur</h1>

    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="date_naissance">Date de Naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" required>

        <button type="submit">Ajouter</button>
    </form>

    <a href="index.php">Retour</a>
</body>
</html>
