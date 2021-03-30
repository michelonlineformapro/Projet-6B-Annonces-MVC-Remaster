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