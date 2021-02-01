<?php
//$title est lier au titre du head.
$title = "Ecommerce - MAJ produit";

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

    $sql = "SELECT * FROM produits WHERE id_produit = ?";
    $maj_req = $db->prepare($sql);
    $maj_id = $_GET['id_maj'];

    $maj_req->bindParam(1, $maj_id);
    $maj_req->execute();

    $result = $maj_req->fetch();

    if($result){
    ?>

    <h1 class="text-center">Mise à jour d'un produit</h1>
    <form action="validateMaj.php?id_maj=<?= $result['id_produit'] ?>" method="post">
        <!---------------------Nom produit-------------------------------->
        <div class="form-group">
            <label for="nom_produit">Nom du produit</label>
            <input type="text" value="<?= $result['nom_produit'] ?>"  class="form-control" id="nom_produit" name="nom_produit" >
        </div>

        <!---------------------------Description produit------------------------------->
        <div class="form-group">
            <label for="description_produit">Description du produit</label>
            <textarea  rows="5" class="form-control" id="description_produit" name="description_produit" required><?= $result['description_produit'] ?></textarea>
        </div>

        <!------------------------------image produit------------------------------>
        <div class="form-group">
            <label for="image_produit">Image du produit</label>
            <input type="text" value="<?= $result['image_produit'] ?>" class="form-control" id="image_produit" name="image_produit">
        </div>

        <!------------------------------------prix produit----------------------------->
        <div class="form-group">
            <label for="prix_produit">Prix du Produit</label>
            <input type="number" value="<?= $result['prix_produit'] ?>" min="1" max="999999" step="0.01" class="form-control" id="prix_produit" name="prix_produit" >
        </div>
    <!-------------------------bouton--------------------------------->
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-outline-success">Mettre à jour le produit</button>
        </div>

    </form>
<?php
}
//$content de template.php définis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>