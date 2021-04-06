<?php
require_once "../modeles/Administration_modele.php";

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
    require_once '../vues/administration/espace_administration.php';
}
