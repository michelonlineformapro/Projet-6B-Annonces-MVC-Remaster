<?php
require_once "../modeles/Categories_modele.php";

//Fonction a appeler depuis la vue ajouter_annonces.php

function afficherToutesCatégories(){
    $categorie = new Categories_modele();
    $listeCategorie = $categorie->afficherCategorie();
    ?>
        <option value="">Choix de la catégories</option>
    <?php
    foreach ($listeCategorie as $cat){
        ?>
        <option value="<?= $cat['id_categories'] ?>"><?= $cat['type_categorie'] ?></option>
        <?php
    }
    return $listeCategorie;
}

