<?php
$servername = "localhost"; 
$username = "root";  
$password = "root";  
$dbname = "bibliothequemangas"; 
// je n'arrive pas a connecter mon github a mon vscode je vais faire sans ... 
// j'ai crée ma base de donnée sur phpmyadmin et j'ai crée une table mangas avec les colonnes id, titre, auteur, annee_publication, genre, resume
// directement grace au requete sql directement dans phpmyadmin
// j'ai ensuite inséré des données dans ma table mangas encore une fois grace a des requetes sql directement dans phpmyadmin
try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

