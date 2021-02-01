<?php
//$title est lier au titre du head.
$title = "Ecommerce - Detail du Produit";

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



//Requ�tes SQL
$sql = "SELECT * FROM produits WHERE id_produit = ?";
//Stock de la requ�te dans une variable ($requ�te) et appel de la connexion puis de la fonction requ�t�e prepar�e

$req = $db->prepare($sql);

//Objet qui retourne PDO statement


//R�cup�ration de id  <a href=detailsProduit.php?id_produit=<?= $row['id_produit'];
//On stocke le r�sultat de $_GET['id_produit']
$id = $_GET['id_produit'];
//Passage du ? � la valeur de $_GET['id_produit']
$req->bindParam(1, $id);
//Execute la requ�te
$req->execute();
//Utilisation de fetch(rechercher) pour afficher les valeurs de la table produits
$result = $req->fetch();

//Retourne une valeur true, si des r�sultats s'affiche
if($result){
    ?>
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nom du produit</th>
            <th>Description du produit</th>
            <th>Image du produit</th>
            <th>Prix du produit</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= $result['id_produit'] ?></td>
            <td><?= $result['nom_produit'] ?></td>
            <td><?= $result['description_produit'] ?></td>
            <td><img src="<?= $result['image_produit'] ?>" +">  </td>
            <td><?= $result['prix_produit'] ?> €</td>
        </tr>
        </tbody>
    </table>
    <?php
}else{
    echo "<p class='alert-danger p-2'>Erreur : ce Produit n'existe pas !</p>";
}



//$content de template.php d�finis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activ�e, alors false sera retourn�.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>