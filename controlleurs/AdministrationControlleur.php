<?php
require_once "../modeles/Administration_modele.php";
require_once '../modeles/Utilisateur_modele.php';

//Connexion de l'administrateur
function connecterAdministrateur(){
    $administrateur = new Administration_modele();
    $connecteAdmin = $administrateur->connexionAdministration();
    return $connecteAdmin;
}

//Afficher la table des admin
function afficherTouteLesTables(){
    $admin = new Administration_modele();
    $tableAdmin = $admin->afficherTableAdmin();
    $tableAnnonce = $admin->afficherTableAnnonce();
    require_once '../vues/administration/espace_administration.php';
}

//Supprimer un admin
function supprimerAdmin(){
    //Instance du model (classe) annonce
    $admin = new Administration_modele();
    $delete = $admin->supprimerUnAdministrateur();
    if($delete){
        header("Location: espace_admin");
    }else{
        echo "rien a supprimer";
    }
}

//Ajouter un admin
function ajouterAdmin($email_admin, $password_admin){
    $admin = new Administration_modele();
    $ajouterAdmin = $admin->ajouterUnAdministrateur($email_admin, $password_admin);
    if($ajouterAdmin){
        header("location: espace_admin");
    }else{
        echo "Erreur";
    }
}

//Afficher annonces par utilisateur
/*
function annonceParUtilisateur(){
    $admin = new Administration_modele();
    $recupUtilisateur = $admin->afficherAnnonceParUtilisateur()
    if($recupUtilisateur){
        require_once "../vues/administration/espace_administration.php";
    }else{
        echo "Aucun résultat pour cet utilisateur";
    }

}
*/

//Lister les utilisateur
function listerUtilisateur(){
    $utilisateur = new Utilisateur_modele();
    $afficher_utilisateur = $utilisateur->utilisateurs();
    ?>
    <option class="text-success" value="">Choix de l'utilisateur :</option>
    <?php
    foreach ($afficher_utilisateur as $user){
        ?>
        <option value="<?= $user['id_utilisateur'] ?>"><?= $user['email_utilisateur'] ?></option>
        <?php

    }
    return $afficher_utilisateur;
}
