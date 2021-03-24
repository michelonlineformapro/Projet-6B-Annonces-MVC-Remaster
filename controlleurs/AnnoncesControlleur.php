<?php

require_once "../modeles/Annonces_modele.php";


function afficherLesAnnonces(){
    $annonce = new Annonces_modele();
    $recupAnnonce = $annonce->afficherToutesAnnonces();
    require_once "../vues/accueil.php";

}
