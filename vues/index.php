<?php
session_start();
ob_start();
//Appel des controlleurs
require_once "../controlleurs/AnnoncesControlleur.php";
require_once "../controlleurs/UtilisateursControlleur.php";

//Verification de l'existance de la super globale $_GET[''] dans url
//index.php?url=accueil (toutes vos routes)

if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url = "accueil";
}

//Si la cles $url n'a pas de valeur
if($url === ""){
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
    require_once "utilisateurs/inscription_utilisateur.php";
    $form = false;
    if(isset($_POST['nom_utilisateur']) && isset($_POST['password_utilisateur'])){
        if($_POST['password_utilisateur'] === $_POST['password_repeter']){
            $form = true;
            if($form){
                envoiEmailInscription();
                echo "<p class='alert alert-success'>Merci pour votre inscription, um email de validation vous à été envoyé, merci de validé votre inscription pour acceder a votre tableau de bord </p>";
            }else{
                echo "<p class='alert alert-danger'>Erreur</p>";
            }
        }else{
            echo "<p class='alert alert-danger'>Le mot de passe repeter n'est pas identique au mot de passe entrer</p>";
        }

    }
    //FORMULAIRE DE CONNEXION DE UTILISATEUR

}elseif ($url == "connexion_utilisateur"){
    $title = "Annonces -Connexion-";
    require_once "../vues/utilisateurs/connexion_utilisateur.php";

//SI UTILISATEUR EST CONNECTÉ IL ACCEDE A SON CRUD

}elseif ($url == "gestion_annonces" && isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true){
    $title = "Annonces -Gestion des annonces-";
    require_once "../vues/utilisateurs/gestion_utilisateur.php";
}



//Appel du template
$content = ob_get_clean();
require_once "template.php";

