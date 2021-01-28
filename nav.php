<?php

ob_start();

if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    $url = "index";
}

if ($url == 'index') {
    require "index.php";
} elseif ($url == 'listeProduit') {
    require "listeProduit.php";
} elseif ($url == 'ajouterProduit') {
    require "ajouterProduit.php";
} elseif ($url == 'enregistrerProduit') {
    require "enregistrerProduit.php";
}

$content = ob_get_clean();

require "template.php";