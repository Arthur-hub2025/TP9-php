<?php
require_once "pdo.php";

try {
    $stmt = $pdo->query("SELECT id, titre, annee_publication FROM mangas ORDER BY annee_publication ASC");
    $mangas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des mangas : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque de Mangas</title>
</head>
<body>

    <h1>Bibliothèque de Mangas</h1>
    <h2>Top Mangas</h2>
    
    <?php if (!empty($mangas)): ?>
        <ul>
            <?php foreach ($mangas as $manga): ?>
                <li>
                    <a href="manga.php?id=<?= htmlspecialchars($manga['id']) ?>">
                        <?= htmlspecialchars($manga['titre']) ?>
                    </a> 
                    (<?= htmlspecialchars($manga['annee_publication']) ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun manga disponible pour le moment.</p>
    <?php endif; ?>

    <section>
        <h2>Ajouter un Auteur</h2>
        <a href="addAuthor.php">
            <button>Ajouter un Auteur</button>
        </a>
    </section>

    <section>
        <h2>Ajouter un Manga</h2>
        <a href="addManga.php">
            <button>Ajouter un Manga</button>
        </a>
    </section>

    <section>
        <h2>Ajouter un Personnage</h2>
        <a href="addCharacter.php">
            <button>Ajouter un Personnage</button>
        </a>
    </section>

</body>
</html>
