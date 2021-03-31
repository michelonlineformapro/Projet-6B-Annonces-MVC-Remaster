<?php
session_start();
require "../vendor/autoload.php";
ob_start();
//Appel des controlleurs
require_once "../controlleurs/AnnoncesControlleur.php";
require_once "../controlleurs/UtilisateursControlleur.php";
require_once "../controlleurs/CategoriesControlleur.php";
require_once "../controlleurs/RegionsControlleur.php";

//Verification de l'existance de la super globale $_GET[''] dans url
//index.php?url=accueil (toutes vos routes)


//PAGE ACCUEIL
if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url = "accueil";
}

//Si la cles $url n'a pas de valeur par default on redirige vers la page d'accueil
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

    //APPEL DU FORMUALIRE D'INSCRIPTION UTILISATEUR

    require_once "utilisateurs/inscription_utilisateur.php";
    //Par default la validation du formulaire retourne FALSE
    $form = false;

    //Vérification de l'existance des champs du formulaires d'inscription

    if(isset($_POST['nom_utilisateur']) && isset($_POST['password_utilisateur'])){

        //Le mot de passe doit etre identique au mot de passe répété

        if($_POST['password_utilisateur'] === $_POST['password_repeter']){
            //Si les champs + mot de passe répété valide = Formulaire retourne TRUE
            $form = true;
            if($form){

                //Appel de la fonction du controlleur Utilisateur

                envoiEmailInscription();

                //SI ca marche

                echo "<p class='alert alert-success'>Merci pour votre inscription, um email de validation vous à été envoyé, merci de validé votre inscription pour acceder à votre tableau de bord.</p>";
            }else{

                //SINON AFFICHE UNE ERREUR :

                echo "<p class='alert alert-danger'>Erreur ! Merci de remplir tous les champs.</p>";
            }
        }else{
            //Erreur si les 2 mot de passe ne sont pas identiques
            echo "<p class='alert alert-danger'>Le mot de passe répeter n'est pas identique au mot de passe.</p>";
        }

    }
    //FORMULAIRE DE CONNEXION DE UTILISATEUR

}elseif ($url == "connexion_utilisateur"){
    $title = "Annonces -Connexion-";
    //Appel du formulaire de connexion
    require_once "../vues/utilisateurs/connexion_utilisateur.php";

//SI UTILISATEUR EST CONNECTÉ IL ACCEDE A SON CRUD
//Check la connexion de l'utilisateur
}elseif ($url === "gestion_annonces" && isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true){

    $title = "Annonces -Gestion des annonces-";
    //Appel de la page du tableau de bord utilisateur
    afficherLesAnnoncesParUtilisateur();
    //Rediriger le formulaire de connxion non connecter

}elseif ($url === "details_annonce" && isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true && isset($_GET['id_details']) && $_GET['id_details'] > 0){
    $title = "Annonce.com -DETAILS ANNONCES-";
    afficherDetails();
}


elseif (isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true && $url === "ajouter_annonce"){

    $title = "Annonces -Ajouter des annonces-";
    require_once "../vues/annonces/ajouter_annonce.php";
    $addForm = false;
    /*
    var_dump($_POST['nom_annonce']);
    var_dump($_POST['description_annonce']);
    var_dump($_POST['prix_annonce']);
    var_dump($_POST['date_depot']);
    var_dump($_FILES['photo_annonce']);
    var_dump($_POST['categorie_id']);
    var_dump($_SESSION['id_utilisateur']);
    var_dump($_POST['regions_id']);
    */
    if(isset($_POST['nom_annonce']) && isset($_POST['description_annonce']) && isset($_POST['prix_annonce']) && isset($_POST['photo_annonce']) && isset($_POST['date_depot'])  && isset($_POST['categorie_id']) && $_SESSION['id_utilisateur'] && isset($_POST['regions_id'])){
        $addForm = true;
        if($addForm){
            ajouterAnnonceParUtilisateur($_POST['nom_annonce'], $_POST['description_annonce'], $_POST['prix_annonce'],$_POST['photo_annonce'], $_POST['date_depot'], $_POST['categorie_id'], $_SESSION['id_utilisateur'], $_POST['regions_id']);
        }else{
            echo "le formulaire est mal rempli";
        }


    }else{
        echo "<p class='alert alert-danger'>Une erreur est survenue, merci de vérifié tous les champs du formulaire !</p>";
    }

}elseif (isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true && $url === "supprimer_annonce" && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0){
    $title = "Annonces.com -SUPPRIMER ANNONCES-";
    //$id = $_GET['id_suppr'];
    supprimerUneAnnonce1Utilisateur();


} elseif (isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true && $url === "editer_annonce" && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0){
    $title = "Annonces.com -EDITER ANNONCES-";
    if(isset($_POST['nom_annonce']) && isset($_POST['description_annonce']) && isset($_POST['prix_annonce']) && isset($_POST['photo_annonce']) && isset($_POST['date_depot']) && isset($_POST['categorie_id']) && isset($_POST['utilisateur_id']) && isset($_POST['region_id']) && isset($_POST['id_utilisateur'])){

        editerAnnonceParUrilisateur($_POST['nom_annonce'], $_POST['description_annonce'], $_POST['prix_annonce'], $_POST['photo_annonce'], $_POST['date_depot'], $_POST['categorie_id'], $_POST['utilisateur_id'], $_POST['region_id'], $_POST['id_utilisateur']);
        echo $_POST['nom_annonce'];
    }

}


elseif ($url === "deconnexion"){
    require_once "../vues/deconnexion.php";
}



//Appel du template
$content = ob_get_clean();
require_once "template.php";

