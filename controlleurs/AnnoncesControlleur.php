<?php

require_once "../modeles/Annonces_modele.php";

//POUR LES VISITEURS//////
function afficherLesAnnonces(){
    //Instance de la classe Annonce
    $annonce = new Annonces_modele();
    //stock dansune variable l'appel de la methode conernée
    $recupAnnonce = $annonce->afficherToutesAnnonces();
    if($recupAnnonce){
        require_once "../vues/accueil.php";
    }else{
        die();
    }
}

//POUR LES UTILISATEURS////////

//Afficher le annonces par utilisateur
function afficherLesAnnoncesParUtilisateur(){
    //Insatnce du de la classe Annonce
    $annonce = new Annonces_modele();
    $annonceParUtilisateur = $annonce->afficherAnnoneParUtilisateur();
    require_once "../vues/utilisateurs/gestion_utilisateur.php";
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
