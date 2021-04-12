<?php
session_start();
require "../vendor/autoload.php";
ob_start();
//Appel des controlleurs
require_once "../controlleurs/AnnoncesControlleur.php";
require_once "../controlleurs/UtilisateursControlleur.php";
require_once "../controlleurs/CategoriesControlleur.php";
require_once "../controlleurs/RegionsControlleur.php";
require_once "../controlleurs/AdministrationControlleur.php";

//Verification de l'existance de la super globale $_GET[''] dans url
//index.php?url=accueil (toutes vos routes)


//Creation de la cle url = url
if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url = "accueil";
}
//Creation de la cle url = page
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = "";
}

//Si la cles $url n'a pas de valeur par default on redirige vers la page d'accueil?page=1 pour la pagination de toutes les annonces
if($url === ""){
    $url = "accueil?page=1";
    $page = "";
}

/**
 ************************************ LES ROUTES *******************************/

    //PAGES ACCUEIL

if($url == "accueil"){
    $title = "Annonces -Accueil-";
    afficherLesAnnonces();



}elseif ($url == "utilisateurs"){
    afficherUtilisateurJson();
}

elseif ($url === "rechercher"){
    $title = "Annonces -RECHERCHER-";
    rechercheGlobaleMotCle();
    getAnnonceByCategorieAndRegion();

}
//LES UTILISATEURS -> INSCRIPTION
elseif ($url == "inscription_utilisateur"){
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

}elseif ($url === "details_annonce" && isset($_GET['id_details']) && $_GET['id_details'] > 0){
    $title = "Annonce.com -DETAILS ANNONCES-";
    afficherDetails();
}

//AJOUTER UNE ANNONCE POUR UTILISATEUR CONNECTER
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
//SUPPRIMER UNE ANNONCE
}elseif (isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true && $url === "supprimer_annonce" && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0){
    $title = "Annonces.com -SUPPRIMER ANNONCES-";
    //$id = $_GET['id_suppr'];
    supprimerUneAnnonce1Utilisateur();

//EDITER UNE ANNONCE
} elseif (isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true && $url === "editer_annonce" && isset($_GET['id_edit']) && $_GET['id_edit'] > 0){
    $title = "Annonces.com -EDITER ANNONCES-";
    require_once "../vues/annonces/editer_annonce.php";
    var_dump($_GET['id_edit']);
    if(isset($_POST['nom_annonce']) && isset($_POST['description_annonce']) && isset($_POST['prix_annonce']) && isset($_POST['photo_annonce']) && isset($_POST['date_depot']) && isset($_POST['categorie_id']) && $_SESSION['id_utilisateur'] && isset($_POST['regions_id'])){
        var_dump($_POST['nom_annonce']);
        editerAnnonceParUrilisateur($_POST['nom_annonce'], $_POST['description_annonce'], $_POST['prix_annonce'], $_POST['photo_annonce'], $_POST['date_depot'], $_POST['categorie_id'], $_SESSION['id_utilisateur'], $_POST['regions_id'], $_GET['id_edit']);
    }
//PAGE DE CONNEXION A ADMINISTRATION
}elseif ($url == "R3s6n9sFC"){
    $title = "Annonce.com -CONNEXION ADMINISTRATION-";
    require_once "../vues/administration/connexion_administration.php";

    //ESPACES ADMINISTRATION
}elseif (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] == true && $url == "espace_admin"){
    $title = "Annonce.com -ESPACE ADMINISTRATION-";
    afficherTouteLesTables();
//SUPPRIMER ADMIN
}elseif (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true && $url === "supprimer_admin" && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0) {
    $title = "Annonces.com -SUPPRIMER ADMIN-";
    //$id = $_GET['id_suppr'];
    supprimerAdmin();
//AJOUTER UN ADMIN

}elseif (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true && $url === "ajouter_admin"){
    $title = "Annonces -Ajouter un administrateur-";
    require_once "../vues/administration/ajouter_admin.php";
    if(isset($_POST['email_admin']) && isset($_POST['password_admin'])){
        ajouterAdmin($_POST['email_admin'], $_POST['password_admin']);
    }


}elseif (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true && $url === "ajouter_categorie"){
    $title = "Annonces -Ajouter une catégorie-";
    require_once "../vues/administration/ajouter_categorie.php";
    if(isset($_POST['type_categorie'])){
        ajouterCatAdmin($_POST['type_categorie']);
    }
}


elseif (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true && $url === "supprimer_annonce_admin" && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0){
    supprimerAnnonceAdmin();
}elseif (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true && $url === "supprimer_admin_autilisateur" && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0){
    supprimerAdminUtilisateur();
}elseif(isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true && $url === "supprimer_categorie_admin" && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0){
    supprimerAdminCategorie();
}

elseif ($url === "deconnexion"){
    require_once "../vues/deconnexion.php";

}elseif ($url == "pdf" & isset($_GET['id']) && $_GET['id'] > 0){
    $id = $_GET['id'];
    annoncePDF($_GET['id']);
}



//Appel du template
$content = ob_get_clean();
require_once "template.php";

