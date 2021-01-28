<?php
//$title est lier au titre du head.
$title = "Ecommerce - Confirmation Delete";

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



//SUPPRIMER UNE LIGNE DE LA TABLE produits

$sql = "DELETE FROM produits WHERE id_produits = ?";

$id = $_GET['id'];


//Creation d'une requ�te pr�pare pour lier l'�l�ment ? = $id
$delete = $db->prepare($sql);
//Bind de $id � ?
$delete->bindParam(1, $id);
//Execution de la requ�te
$delete->execute();

//Verification conditionnelle
if($delete){
    echo "<p class='alert-success p-5'>Le produit à bien été supprimé !</p>";
    echo "<a class='btn btn-success' href='listeProduit.php'>Retour a la liste des produits</a>";
}else{
    echo "<p class='alert-danger p-5'>Erreur lors de la suppression du produit</p>";
    echo "<a class='btn btn-danger' href='listeProduit.php'>Retour a la liste des produits</a>";
}


//$content de template.php d�finis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activ�e, alors false sera retourn�.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";

?>
