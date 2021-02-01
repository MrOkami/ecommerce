<?php

//$title est lier au titre du head.
$title = "Ecommerce - MAJ produit";

//Met les en-tete, temporairement en memoire tampon
ob_start();

//Connexion BDD
$user = "root";
$pass = "";
//teste de co
try {
    //stockage et instance PDO pour connect php et mySQL
    $db = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", $user, $pass);
    //debub static PDO en cas d'erreur. Affiche les tableaux orange, jaune et rouge si il y a une erreur.
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color:#4285F4'>PDO-SQL connecter !</p>";
} catch (PDOException $exception) {
    die("Erreur de connexion PDO-SQL : " . $exception->getMessage());
}


if(isset($_POST['nom_produit']) && !empty($_POST['nom_produit'])){
    $nom_produit = htmlspecialchars(strip_tags($_POST['nom_produit']));
}else{
    echo "<p class='alert-danger'>Erreur, merci de remplir le champ nom du produit</p>";
}

if(isset($_POST['description_produit']) && !empty($_POST['description_produit'])){
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

$sql = "UPDATE produits SET nom_produit = ?, description_produit = ?, image_produit = ?, prix_produit = ? WHERE id_produit = ?";
$maj = $db->prepare($sql);

$maj->bindParam(1, $nom_produit);
$maj->bindParam(2, $description_produit);
$maj->bindParam(3, $image_produit);
$maj->bindParam(4, $prix_produit);

$validate_maj = $_GET['id_maj'];
$result_maj = $maj->execute(array($nom_produit, $description_produit, $image_produit, $prix_produit,$validate_maj));

if ($result_maj) {
    $sql = "SELECT * FROM produits WHERE id_produit = ?";
    $req = $db->prepare($sql);

    $maj_id = $_GET['id_maj'];

    $req->bindParam(1, $maj_id);
    $req->execute();

    $result = $req->fetch();
    ?>
<div class="alert-success p-2">
    <h1 class="text-center text-success">Le produit à bien été mis à jour !</h1>
    <ul class="list-group">
        <li class="list-group-item">ID du produit : <?= $result['id_produit'] ?></li>
        <li class="list-group-item">Nom du produit<?= $result['nom_produit'] ?></li>
        <li class="list-group-item">Description du produit<?= $result['description_produit'] ?></li>
        <li class="list-group-item">Image du produit<img src="<?= $result['image_produit'] ?>" alt="<?= $result['nom_produit'] ?>" title="<?= $result['nom_produit'] ?>">  </li>
        <li class="list-group-item">Prix du produit<?= $result['prix_produit'] ?> €</li>
    </ul>
    <a href="listeProduit.php" class="btn btn-success">Retour à la liste des produits</a>
</div>

<?php

}else{
    echo "<p class='alert-danger p-2'>Une erreur c'est produite !</p>";
    echo "<a class='btn btn-danger' href='listeProduit.php'>Retour a la liste des produits</a>";
}

//$content de template.php définis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>