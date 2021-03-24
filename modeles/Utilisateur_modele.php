<?php

require_once "Database_modele.php";



class Utilisateur_modele extends Database_modele
{
    private $id_utilisateur;
    private $nom_utilisateur;
    private $email_utilisateur;
    private $password_utilisateur;

    public function utilisateurParId($id){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM utilisateurs WHERE id_utilisateur = ?";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute(array($id));
        $user_id = $stmt->fetch();
        return $user_id;
    }
}