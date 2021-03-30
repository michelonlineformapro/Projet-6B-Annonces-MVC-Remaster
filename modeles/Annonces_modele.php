<?php

require_once "Database_modele.php";
class Annonces_modele extends Database_modele
{
    //Intitulé des colones de la tables annonces php myd Admin
    private $id_annonce;
    private $nom_annonce;
    private $description_annonce;
    private $prix_annonce;
    private $date_depot;
    private $photo_annonce;
    private $categorie_id;
    private $utilisateur_id;
    private $region_id;

    /////////////////////////////////////POUR LES VISITEURS//////////////////////////////////

    /**
     * @return false|PDOStatement
     */
    public function afficherToutesAnnonces(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM annonces";
        $stmt = $db->query($sql);
        return $stmt;
    }

    public function afficherAnnoneParUtilisateur(){
        //Connexion a PDO
        $db = $this->getPDO();

        //Recup de la page courante
        if(isset($_GET['page']) && !empty($_GET['page'])){
            $currentPage = (int) strip_tags($_GET['page']);
        }else{
            $currentPage = 1;
        }

        //Nombre total d'annonce
        $countAnnonce = "SELECT COUNT(*) AS id_annonce FROM annonces";
        //Requète préparée

        $query = $db->prepare($countAnnonce);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $nbrAnnonce = (int) $result['id_annonce'];
        //Nombre d'annonce par page
        $parPage = 10;
        $pages = ceil($nbrAnnonce / $parPage);
        //Calcul de la 1er annonce de la page
        $premier = ($currentPage * $parPage) - $parPage;

        //Requète SQL + jointure
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions WHERE utilisateur_id = ? DESC LIMIT :premier, :parPage";
        //Recup de id utilisateur
        $this->id_annonce = $_SESSION['id_utilisateur'];
        //Requète préparée
        $request = $db->prepare($sql);
        //Lié les paramètres
        $request->bindParam(1, $this->id_annonce);
        //Execution de la requète
        $request->execute();
        //Retourne un objet de resultats
        return $request->fetchAll(PDO::FETCH_ASSOC);

    }

    ////////////////////////////////////POUR LES UTILISATEURS INSCRITS/////////////////////////

    //Passage de paramètres dans la methode et assignation au variables du formulaire
    public function ajouterUneAnnonce($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id){
        $db = $this->getPDO();
        //Les propriétés privée
        $this->nom_annonce = $nom_annonce;
        $this->description_annonce = $description_annonce;
        $this->prix_annonce = $prix_annonce;
        $this->date_depot = $date_depot;
        $this->photo_annonce = $photo_annonce;
        $this->categorie_id = $categorie_id;
        $this->utilisateur_id = $utilisateur_id;
        $this->region_id = $region_id;

        //Requète SQL :
        $sql = "INSERT INTO `annonces`(`nom_annonce`, `description_annonce`, `prix_annonce`, `photo_annonce`, `date_depot`, `categorie_id`, `utilisateur_id`, `regions_id`) VALUES (?,?,?,?,?,?,?,?)";

        //Requète préparée
        $insert = $db->prepare($sql);

        //Liés les paramètre du formulaire a la table phpmyadmin
        $insert->bindParam(1, $nom_annonce);
        $insert->bindParam(2, $description_annonce);
        $insert->bindParam(3, $prix_annonce);
        $insert->bindParam(4, $date_depot);
        $insert->bindParam(5, $photo_annonce);
        $insert->bindParam(6, $categorie_id);
        $insert->bindParam(7, $utilisateur_id);
        $insert->bindParam(8, $region_id);

        $insert->execute(array(
            $nom_annonce,
            $description_annonce,
            $prix_annonce,
            $date_depot,
            $photo_annonce,
            $categorie_id,
            $utilisateur_id,
            $region_id
        ));
        return $insert;
    }

    //Supprimer une annonce par utilisateur
    public function suprimerAnnonce(){
        //Appel de  la classe mere et de la methode PDO
        $db = $this->getPDO();
        //Requète sql
        $sql = 'DELETE FROM `annonces` WHERE `id_annonce` = ?';
        //Creation de la requète péparée
        $stmt = $db->prepare($sql);
        $this->id_annonce = $_GET['id_suppr'];
        //Lié les paramètre (ici id de annonce a $_GET id url)
        $stmt->bindParam(1, $this->id_annonce);
        //Execution de la requète
        $delete = $stmt->execute();
        //Retourne l'objet avec son id
        return $delete;
    }

    //Editer une annonce par utilisateur
    public function editerUneAnnonce($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id, $id_annonce){
        $db = $this->getPDO();
        //Les propriétés privée
        $this->nom_annonce = $nom_annonce;
        $this->description_annonce = $description_annonce;
        $this->prix_annonce = $prix_annonce;
        $this->date_depot = $date_depot;
        $this->photo_annonce = $photo_annonce;
        $this->categorie_id = $categorie_id;
        $this->utilisateur_id = $utilisateur_id;
        $this->region_id = $region_id;
        $this->id_annonce = $id_annonce;

        $nom_annonce = $_POST['nom_annonce'];

        //La requète sql
        $sql = "UPDATE `annonces` SET `nom_annonce`= ?,`description_annonce`= ?,`prix_annonce`= ?,`photo_annonce`= ?,`date_depot`= ?,`categorie_id`= ?,`utilisateur_id`= ?,`regions_id`= ? WHERE id_annonce = ?";
        //La requète préparée
        $update = $db->prepare($sql);
        //Execution de la requète
        $update->execute($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id, $id_annonce);
        return $update;
    }

}