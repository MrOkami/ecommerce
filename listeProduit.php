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
    echo "<p style='color:#4285f4'>PDO-SQL connecter !</p>";
}catch (PDOException $exception){
    die("Erreur de connexion PDO-SQL : ".$exception->getMessage());
}

?>

    <h1 class="text-warning text-info">Alibazar.com</h1>
    <h2 class="text-warning text-info">Espace Administrateur</h2>
    <a href="ajouterProduit.php" class="btn btn-primary" id="AjoutProduit">Ajouter un Produit</a>


<?php
//stockage SQL dans une variable
$sql = "SELECT * FROM produits ORDER BY id_produit DESC";
//variable qui stocke la co PDO et l'execute de la requete sql
$res = $db->query($sql);




// crea d'une liste pour chaque elements.
?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Image</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Détails</th>
            <th>Editer</th>
            <th>Supprimer</th>
        </tr>
        </thead>

        <!--Appel des $row + nom de l'objet de la table produits-->
        <tbody>

        <?php
        //Boucle de lecture (connexion = $db + fonction query() PDO + requ?te SQL = $row)
        foreach ($db->query("SELECT * FROM produits") as $row){
            ?>

            <tr>
                <th><?php echo $row['nom_produit'] ?></th>
                <th><img src="<?= $row['image_produit']?>" alt="<?= $row['nom_produit'] ?>" title="<?= $row['nom_produit']?>"</th>
                <th><?= $row['description_produit']?></th>
                <th><?= $row['prix_produit']?> €</th>
                <th><a href="detailProduit.php?id_produit=<?= $row['id_produit'] ?>" class="btn btn-default">Détails</a></th>
                <th><a href="majProduit.php?id_maj=<?= $row['id_produit'] ?>" class="btn btn-info">Editer</a></th>
                <th><a href="deleteProduit.php?id=<?= $row['id_produit'] ?>" class="btn btn-warning">Supprimer</a></th>
            </tr>
            <?php

        }

        ?>
        </tbody>
    </table>


<?php
//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activ?e, alors false sera retourn?.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>