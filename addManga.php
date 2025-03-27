<?php
require_once "pdo.php";

$auteurs = $pdo->query("SELECT id, nom FROM auteurs")->fetchAll(PDO::FETCH_ASSOC);

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = trim($_POST["titre"] ?? "");
    $annee_publication = $_POST["annee_publication"] ?? "";
    $note = $_POST["note"] ?? "";
    $auteur_id = $_POST["auteur_id"] ?? "";

    if ($titre && $annee_publication && $note && $auteur_id) {
        try {
            $stmt = $pdo->prepare("INSERT INTO mangas (titre, annee_publication, note, auteur_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$titre, $annee_publication, $note, $auteur_id]);
            $message = "Manga ajouté avec succès !";
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
    <title>Ajouter un Manga</title>
</head>
<body>
    <h1>Ajouter un Manga</h1>

    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required>

        <label for="annee_publication">Année de Publication :</label>
        <input type="number" id="annee_publication" name="annee_publication" required>

        <label for="note">Note :</label>
        <input type="number" id="note" name="note" step="0.1" min="0" max="10" required>

        <label for="auteur_id">Auteur :</label>
        <select id="auteur_id" name="auteur_id" required>
            <option value="" disabled selected>Choisissez un auteur</option>
            <?php foreach ($auteurs as $auteur): ?>
                <option value="<?= $auteur['id'] ?>"><?= htmlspecialchars($auteur['nom']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Ajouter</button>
    </form>

    <a href="index.php">Retour</a>
</body>
</html>
