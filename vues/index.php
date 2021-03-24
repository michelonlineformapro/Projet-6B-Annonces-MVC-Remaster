<?php
session_start();
ob_start();
//Appel des controlleurs
require_once "../controlleurs/AnnoncesControlleur.php";


//Verification de l'existance de la super globale $_GET[''] dans url
//index.php?url=accueil (toutes vos routes)

if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url = "accueil";
}


/**
 * LES ROUTES
 */

if($url == "accueil"){
    $title = "Annonces -Accueil-";
    afficherLesAnnonces();
}elseif ($url == "inscription_utilisateur"){
    $title = "Annonces -Inscription-";
    require "utilisateurs/inscription_utilisateur.php";
}
$content = ob_get_clean();
require_once "template.php";

