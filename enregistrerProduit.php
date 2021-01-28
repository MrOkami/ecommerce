<?php


//$title est lier au titre du head.
$title = "Ecommerce - Enregistrer un Produit";

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



if(isset($_POST['nom_produit']) && !empty($_POST['nom_produit'])){
    $nom_produit = htmlspecialchars(strip_tags($_POST['nom_produit']));
    //on stock $_POPST[''] dans une variable et on supprime les balise html avec htmlspecialchar et striptags
    //Le premier supprime compl�tement les balises html et php, l'autre convertit les caract�res sp�ciaux en entit� HTML
    // ("<" devient "&lt;" par exemple) mais ton lien le montre bien.
}else{
    //Sinon on affiche une erreur
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ nom du produit</p>";
}


if (isset($_POST['description_produit']) && !empty($_POST['description_produit'])){
    $description_produit = htmlspecialchars(strip_tags($_POST['description_produit']));
}else{
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ nom du produit</p>";
}


if (isset($_POST['image_produit']) && !empty($_POST['image_produit'])){
    $image_produit = htmlspecialchars(strip_tags($_POST['image_produit']));
}else{
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ nom du produit</p>";
}

if (isset($_POST['prix_produit']) && !empty($_POST['prix_produit'])){
    $prix_produit = htmlspecialchars(strip_tags($_POST['prix_produit']));
}else{
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ nom du produit</p>";
}

//requete SQL pour insertion d'elements
$sql = "INSERT INTO produits (nom_produit, description_produit, image_produit, prix_produit) VALUES (?,?,?,?)";
//crea requete "prepare" PDO qui execute le SQL
$insert = $db->prepare($sql);
//Liaison des VALUES ????


$insert->bindParam(1, $nom_produit);
$insert->bindParam(2, $description_produit);
$insert->bindParam(3, $image_produit);
$insert->bindParam(4, $prix_produit);

//si l'insertion fonctionne
if($insert->execute(array($nom_produit, $description_produit, $image_produit, $prix_produit))){
    //Message de r�usite + bouton de retour � la liste
    echo "<p class='alert-success'>Votre produit � bien �t� ajout� !</p>";
    echo "<a href='listeProduit.php' class='btn btn-outline-success'>Retour � la liste des produit</a>";
}else{
    echo "<p class='alert-danger'>Erreur: Merci de remplir tous les champs</p>";
}



/*

$nom_produit = $_POST['nom_produit'];
$description_produit = $_POST['description_produit'];
$image_produit = $_POST['image_produit'];
$prix_produit = $_POST['prix_produit'];
*/
//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activ�e, alors false sera retourn�.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>