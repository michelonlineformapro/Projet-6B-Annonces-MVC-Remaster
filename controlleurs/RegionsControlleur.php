<?php
require_once "../modeles/Regions_modele.php";

function listerRegions(){
    $region = new Regions_modele();
    $afficher_region = $region->afficherToutesRegions();
    ?>
    <option class="text-success" value="">Choix de la région :</option>
    <?php
    foreach ($afficher_region as $reg){
        ?>
        <option value="<?= $reg['id_regions'] ?>"><?= $reg['nom_region'] ?></option>
        <?php
    }
    return $afficher_region;
}

function annonceParRegion($id){
    $region = new Regions_modele();
    $annonceParRegion = $region->afficherAnnonceParRegion($_GET['id']);
    if($annonceParRegion){
        require_once '../vues/annonces/resultat_recherche_region.php';
    }else{
        echo "<p class='alert-warning text-center p-2 mt-2'><b>Pas d'annonce pour cette region</b></p>";
    }
}