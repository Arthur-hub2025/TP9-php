<?php
require_once "pdo.php";

$mangas = $pdo->query("SELECT id, titre FROM mangas")->fetchAll(PDO::FETCH_ASSOC);

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $manga_id = $_POST["manga_id"] ?? "";

    if ($nom && $description && $manga_id) {
        try {
            $stmt = $pdo->prepare("INSERT INTO personnages (nom, description, manga_id) VALUES (?, ?, ?)");
            $stmt->execute([$nom, $description, $manga_id]);
            $message = "Personnage ajouté avec succès !";
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
    <title>Ajouter un Personnage</title>
</head>
<body>
    <h1>Ajouter un Personnage</h1>

    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea>

        <label for="manga_id">Manga :</label>
        <select id="manga_id" name="manga_id" required>
            <option value="" disabled selected>Choisissez un manga</option>
            <?php foreach ($mangas as $manga): ?>
                <option value="<?= $manga['id'] ?>"><?= htmlspecialchars($manga['titre']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Ajouter</button>
    </form>

    <a href="index.php">Retour</a>
</body>
</html>
