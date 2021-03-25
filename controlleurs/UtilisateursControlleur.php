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
    if($connecter_utilisateur){
        var_dump("OK");
    }else{
        echo "<p class='alert alert-danger'>Erreur ! Merci de vérifié votre email et mot de passe depuis le controlleur</p>";
    }
}





