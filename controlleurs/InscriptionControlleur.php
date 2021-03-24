<?php
require_once '../modeles/EmailInscriptionModele.php';
require_once '../modeles/Utilisateur_modele.php';

function envoiEmailInscription(){
    //Instance de la classe email
    $email = new EmailInscriptionModele();
    $envoiEmail = $email->validerInscriptionUtilisateurEmail();
    return $envoiEmail;
}

function recupUtilisateurParId($id){
    $utilisateur = new Utilisateur_modele();
    $recupUtilisateur = $utilisateur->utilisateurParId($_GET['id']);
    require_once "../vues/utilisateurs/valider_inscription.php";


}



