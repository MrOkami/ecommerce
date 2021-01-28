<?php
//$title est lier au titre du head.
$title = "Ecommerce - Ajouter un Produit";

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

    <div class="container" id="aj_produit">
        <h1>Ajouter un produit</h1>
        <!------------ Nom du produit--------------->
        <form action="enregistrerProduit.php" method="post">
            <div class="form-group">
                <label for="nom_produit">Nom du Produit</label>
                <input type="text" class="form-control" id="nom_produit" name="nom_produit" required>
            </div>

            <!------------ description produit--------------->

            <div class="form-group">
                <label for="description_produit">Description du Produit</label>
                <textarea type="textarea" class="form-control" id="description_produit" name="description_produit" required></textarea>
            </div>

            <!------------ image Produit--------------->

            <div class="form-group">
                <label for="image_produit">Image du Produit</label>
                <input type="text" class="form-control" id="image_produit" name="image_produit" required>
            </div>

            <!------------ Prix produit--------------->

            <div class="form-group">
                <label for="prix_produit">Prix du Produit</label>
                <input type="number" min="1" max="999999" class="form-control" id="prix_produit" name="prix_produit" required>
            </div>

            <!--------------- bouton validation --------------->
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-outline-success">Ajouter le produit</button>
            </div>
        </form>
    </div>




<?php
/*recup des input name
$nom_produit = $_POST['nom_produit'];
$description_produit = $_POST['description_produit'];
$image_produit = $_POST['image_produit'];
$prix_produit = $_POST['prix_produit'];*/

//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation.
//Si la temporisation n'est pas activ�e, alors false sera retourn�.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>