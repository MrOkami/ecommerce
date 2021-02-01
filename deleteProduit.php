<?php
$title = "Ecommerce - Delete";
ob_start();

//Rappel de la connexion PDO
//COONEXION A LE BASE de DONN�ES
//Stock des valeur nom utilistateur phpmyadmin et mot de passe
$user = "root";
$pass = "";
//Essaie de te connecter
try{
    //Stockage et instance de la classe PDO pour connecter php et mysql
    $db = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", $user, $pass);
    //Fonction static de la classe PDO pour debug la connexion en cas d'erreur
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color:#4285f4'>PDO-SQL connecter !</p>";
}catch(PDOException $exception){
    die("Erreur de connexion a PDO MySQL :" .$exception->getMessage());
}

?>


    <div class="alert-danger p-2">
        <h1 class="text-center text-danger"><strong>ATTENTION</strong></h1>
        <h2 class="text-center text-dark">LE PRODUIT CONCERNER VA ETRE SUPPRIME</h2>
        <?php
        //Requ�tes SQL
        $sql = "SELECT * FROM produits WHERE id_produit = ?";
        $delete = $db->prepare($sql);
        $id = $_GET['id'];


        $delete->bindParam(1, $id);
        //Execute la requ�te
        $delete->execute();
        //Utilisation de fetch(rechercher) pour afficher les valeurs de la table produits
        $result = $delete->fetch();
        ?>
        <ul class="list-group">
            <li class="list-group-item">ID : <?= $result['id_produit'] ?></li>
            <li class="list-group-item">Nom : <?= $result['nom_produit'] ?></li>
            <li class="list-group-item">Description: <?= $result['description_produit'] ?></li>
            <li class="list-group-item">image : <img src="<?= $result['image_produit'] ?>" alt="<?= $result['nom_produit'] ?>" title="<?= $result['nom_produit'] ?>"></li>
            <li class="list-group-item">Prix : <?= $result['prix_produit'] ?> €</li>
        </ul>

        <a href="confirmDelete.php?id=<?=$result['id_produit'] ?>" class="btn btn-danger mt-2">CONFIRMER LA SUPPRESSION DU PRODUIT = <?= $result['nom_produit'] ?></a>


    </div>

    <a href="listeProduit.php" class="btn btn-dark mt-2">ANNULER</a>


<?php

//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activ�e, alors false sera retourn�.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>