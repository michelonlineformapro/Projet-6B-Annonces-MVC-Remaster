<?php
session_start();
ob_start();
//Appel des controlleurs
require_once "../controlleurs/AnnoncesControlleur.php";
require_once "../controlleurs/InscriptionControlleur.php";

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
//PAGES ACCUEIL
if($url == "accueil"){
    $title = "Annonces -Accueil-";
    afficherLesAnnonces();
    //LES UTILISATEURS -> INSCRIPTION

}elseif ($url == "inscription_utilisateur"){

    $title = "Annonces -Inscription-";
    require "utilisateurs/inscription_utilisateur.php";
    $form = false;
    if(isset($_POST['nom_utilisateur']) && isset($_POST['password_utilisateur'])){
        $form = true;
        if($form){
            envoiEmailInscription();
            echo "<p class='alert alert-success'>Vous êtes desormais inscrit, </p>";
        }else{
            echo "<p class='alert alert-danger'>Erreur</p>";
        }
    }
}elseif ($url == "valider_inscription"){
    recupUtilisateurParId($_GET['id']);
}
$content = ob_get_clean();
require_once "template.php";

