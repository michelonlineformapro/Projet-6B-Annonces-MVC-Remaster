<?php
require_once "../modeles/Administration_modele.php";

function connecterAdministrateur(){
    $administrateur = new Administration_modele();
    $connecteAdmin = $administrateur->connexionAdministration();
    return $connecteAdmin;
}
