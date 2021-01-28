<?php
$title = "Ecommerce - Acceuil";
ob_start();

?>
    <h1 class="text-center">Alibazar.com</h1>
    <div class="text-center">
        <a href="listeProduit.php" class="btn">CONNEXION</a>
    </div>

<?php
$content = ob_get_clean();
require 'template.php';
?>