<?php
require_once '../modeles/EmailInscriptionModele.php';
require_once '../modeles/Utilisateur_modele.php';

//Envoi email lors de inscription
function envoiEmailInscription(){
    //Instance de la classe email
    $email = new EmailInscriptionModele();
    $envoiEmail = $email->validerInscriptionUtilisateurEmail();
    return $envoiEmail;
}

//Connecter un utilisateur

function connexionDeUtilisateur(){
    //Instance du model utilisateur
    $utilisateur = new Utilisateur_modele();
    $connecter_utilisateur = $utilisateur->connecterUnUtilisateur();
    return $connecter_utilisateur;

}

//Lister tous les utilisateurs
function afficherUtilisateurJson(){
    $utilisateur = new Utilisateur_modele();
    $afficherUtilisateur = $utilisateur->utilisateurs();
    require_once "../vues/users.php";
}

function afficherUtilisateurParID($id){
    $utilisateur = new Utilisateur_modele();
    $afficherUtilisateurParId = $utilisateur->utilisateurParId($_GET['id']);
    require_once '../vues/utilisateurs/email_vendeur.php';
    return $afficherUtilisateurParId;
}










