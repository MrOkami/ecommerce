<?php
//$title est lier au titre du head.
$title = "Ecommerce - Nos Produits";

//Met les en-tete, temporairement en memoire tampon
ob_start();

//Connexion BDD
$user="root";
$pass="";
//teste de co
try{
    //stockage et instance PDO pour connect php et mySQL
    $db = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", $user, $pass);
    //debub static PDO en cas d'erreur. Affiche les tableaux orange, jaune et rouge si il y a une erreur.
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color:#4285F4'>PDO-SQL connecter !</p>";
}catch (PDOException $exception){
    die("Erreur de connexion PDO-SQL : ".$exception->getMessage());
}

?>


<?php
//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>