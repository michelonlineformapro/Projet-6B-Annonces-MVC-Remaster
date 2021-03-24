<?php
session_start();
ob_start();
//Appel des controlleurs
require_once "../controlleurs/AnnoncesControlleur.php";


//Verification de l'existance de la super globale $_GET[''] dans url

//index.php?url=accueil

if(isset($_GET['url'])){
    $url = $_POST['url'];
}else{
    $url = "accueil";
}

/**
 *
 */
//LES ROUTES
if($url === "accueil"){
    afficherLesAnnonces();
}

$content = ob_get_clean();
require_once "template.php";

