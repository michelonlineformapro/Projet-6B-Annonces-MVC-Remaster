<?php

require_once "../modeles/Database_modele.php";

class Regions_modele extends Database_modele
{
    private $id_regions;
    private $nom_region;

    public function afficherToutesRegions(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM regions";

        $stmt = $db->query($sql);
        return $stmt;
    }

}