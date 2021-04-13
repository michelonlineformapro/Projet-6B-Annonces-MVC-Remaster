<?php

require_once "../modeles/Annonces_modele.php";

//POUR LES VISITEURS//////
function afficherLesAnnonces(){
    //Instance de la classe Annonce
    $annonce = new Annonces_modele();
    //stock dansune variable l'appel de la methode concernée
    $recupAnnonce = $annonce->afficherToutesAnnonces();
    require_once "../vues/accueil.php";
}

function afficherAnnoncesJson(){
    //Instance de la classe Annonce
    $annonce = new Annonces_modele();
    $recupAnnonce = $annonce->annoncesJson();
    require_once "../vues/accueil.php";

}

//POUR LES UTILISATEURS////////

//Afficher le annonces par utilisateur
function afficherLesAnnoncesParUtilisateur(){
    //Insatnce du de la classe Annonce
    $annonce = new Annonces_modele();
    $nombreDePages = $annonce->afficherAnnoneParUtilisateur();
    require_once "../vues/utilisateurs/gestion_utilisateur.php";
}

//Affiche les details d'une annone d'un utilisateur
function afficherDetails(){
    //Instance de la classe Annonce
    $annonce = new Annonces_modele();
    $details = $annonce->afficherDetailsUneAnnonce();
    require_once "../vues/annonces/details_annonce.php";
}


//Ajouter une annonce pour 1 utlisateur
function ajouterAnnonceParUtilisateur($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id){
    $annonce = new Annonces_modele();
    $ajouterAnnonce = $annonce->ajouterUneAnnonce($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id);
    if($ajouterAnnonce){
        header("Location: gestion_annonces");
    }else{
        echo "<p class='alert alert-danger'>Une erreur est survenue durant l'ajout de votre annonce merci de réessayé !</p>";
    }
}

//Supprimer une annone d'un utilisateur
function supprimerUneAnnonce1Utilisateur(){
    //Instance du model (classe) annonce
    $annonce = new Annonces_modele();
    $delete = $annonce->suprimerAnnonce();
    if($delete){
        header("Location: gestion_annonces");
    }else{
        echo "rien a supprimer";
    }

}

//Editer une annonce pour un utilisateur
function editerAnnonceParUrilisateur($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id, $id){

    $annonce = new Annonces_modele();
    $_GET['id'] = $id;
    $update = $annonce->editerUneAnnonce($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id, $_GET['id_edit']);
    if($update){
        header("Location: gestion_annonces");
    }else{
        echo "<p class='alert alert-danger'>Une erreur est survenue durant l'ajout de votre annonce merci de réessayé !</p>";
    }
}

function rechercheGlobaleMotCle(){
    $annonce = new Annonces_modele();
    $results = $annonce->rechercheAnnonceMotCle();
    if($results){
        require "../vues/annonces/resultat_recherche_globale.php";
    }else{
        echo "<p class='alert-warning text-center p-2 mt-2'><b>Pas d'annonce pour cette region et cette catégorie</b></p>";
    }

}

function getAnnonceByCategorieAndRegion(){
    $annonce = new Annonces_modele();
    $resultsCR = $annonce->getAnnonceByRegionAndCategorie();
    if($resultsCR){
        require_once "../vues/annonces/resultat_recherche_CR.php";
    }else{
        echo "<p class='alert-warning text-center p-2 mt-2'><b>Pas d'annonce pour cette region et cette catégorie</b></p>";
    }
}



function annoncePDF($id){
    $annonce = new Annonces_modele();
    $id = $_GET['id'];
    $afficherPDF = $annonce->pdfExportParId($_GET['id']);
    return $afficherPDF;
}







