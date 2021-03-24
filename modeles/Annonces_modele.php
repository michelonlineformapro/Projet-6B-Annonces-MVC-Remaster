<?php

require_once "Database_modele.php";
class Annonces_modele extends Database_modele
{
    private $id_annonce;
    private $nom_annonce;
    private $description_annonce;
    private $prix_annonce;

    private $photo_annonce;
    private $categorie_id;
    private $utilisateur_id;
    private $region_id;

    public function afficherToutesAnnonces(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM annonces";
        $stmt = $db->query($sql);
        return $stmt;
    }



}