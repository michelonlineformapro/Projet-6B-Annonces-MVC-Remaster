<?php

require_once "../modeles/Annonces_modele.php";


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
