<?php
$servername = "localhost"; 
$username = "root";  
$password = "root";  
$dbname = "bibliothequemangas"; 

try {
    $dbPDO = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password); 
    
     $dbPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
     echo "Connexion réussie à la base de données"; 

} catch(PDOException $e) {
 
    echo "La connexion a échoué : " . $e->getMessage();
}
?>
