<?php

require_once "Database_modele.php";

class Categories_modele extends Database_modele
{
    private $id_categorie;
    private $type_categorie;

    //Permet de lister les categories dans un SELECT options
    public function afficherCategorie(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM categories";
        $categories = $db->query($sql);
        return $categories;
    }

}