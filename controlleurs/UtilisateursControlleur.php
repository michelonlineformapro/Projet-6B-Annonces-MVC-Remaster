<?php
require_once '../modeles/EmailInscriptionModele.php';
require_once '../modeles/Utilisateur_modele.php';

function envoiEmailInscription(){
    //Instance de la classe email
    $email = new EmailInscriptionModele();
    $envoiEmail = $email->validerInscriptionUtilisateurEmail();
    return $envoiEmail;
}

//Coonecter un utilisateur

function connexionDeUtilisateur(){
    //Instance du model utilisateur
    $utilisateur = new Utilisateur_modele();
    $connecter_utilisateur = $utilisateur->connecterUnUtilisateur();

}





