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
    public function afficherToutesAnnonces(){
        $db = $this->getPDO();

        //Appel de la clé $_GET['page'] referencée dans le routeur
        //index.php?url=quelque_chose?page=1

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = "page=1";
        }
        //Nombre d'annonce affichée par page
        $limite = 3;
        //Valeur de depart page courante - 1 * nombre d'annonce a afficher
        $debut = ($page - 1) * $limite;

        //Requète SQL + limite
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions ORDER BY Rand() ASC LIMIT {$limite} OFFSET {$debut}";
        $stmt = $db->query($sql);

        //Requète qui compte le nombre d'entrée
        $resultFoundRows = $db->query('SELECT COUNT(id_annonce) FROM annonces');
        /* On doit extraire le nombre du jeu de résultat */
        $nombredElementsTotal = $resultFoundRows->fetchColumn();
        /* Si on est sur la première page, on n'a pas besoin d'afficher de lien
        * vers la précédente. On va donc ne l'afficher que si on est sur une autre
        * page que la première */
        $nombreDePages = ceil($nombredElementsTotal / $limite);


        ?>
        <div class="text-center">
            <img width="10%" src="public/img/logo.png" alt="Annonces.com" title="Annonce.com">
        </div>
        <div class="d-flex flex-row justify-content-center mt-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    if ($page > 1):
                        ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Page précédente</a></li><?php
                    endif;

                    /* On va effectuer une boucle autant de fois que l'on a de pages */
                    for ($i = 1; $i <= $nombreDePages; $i++):
                        ?><li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
                    endfor;

                    /* Avec le nombre total de pages, on peut aussi masquer le lien
                     * vers la page suivante quand on est sur la dernière */
                    if ($page < $nombreDePages):
                        ?><li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Page suivante</a></li><?php
                    endif;
                    ?>

                </ul>
            </nav>
        </div>

        <?php

        return $stmt;
    }

    ///////////////////////////////AFFICHER TOUTES LES ANNONCES AU FORMAT JSON/////////////////
    public function annoncesJson(){
        $db = $this->getPDO();
        //Requète SQL + limite
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions";
        $json = $db->query($sql);
        return $json;
    }

    /////////////////////////////////////POUR LES UTILISATEURS INSCRITS//////////////////////////////////

    //AFFICHE TOUTES LES ANNONCES PAR UTILISATEUR////
    public function afficherAnnoneParUtilisateur(){
        //Connexion a PDO
        $db = $this->getPDO();

        //Requète SQL + jointure
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions WHERE utilisateur_id = ?";
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

    //AFFICHE LES DETAILS 1 ANNONCES PAR UTILISATEUR///
    public function afficherDetailsUneAnnonce(){
        //Coonexion PDO
        $db = $this->getPDO();
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions WHERE id_annonce = ?";
        //Recup de id utilisateur
        $this->id_annonce = $_GET['id_details'];
        //Requète préparée
        $request = $db->prepare($sql);
        //Lié les paramètres
        $request->bindParam(1, $this->id_annonce);

        //Execution de la requète
        $request->execute();
        //Retourne un objet de resultats
        $details = $request->fetch(PDO::FETCH_ASSOC);
        return $details;
    }

    //COMPTE LE NOMBRE D'ANNONCE///

    public function compterLesAnnonces(){
        $db = $this->getPDO();
        $limite = 2;
        //Requète qui compte le nombre d'entrée
        $resultFoundRows = $db->query('SELECT COUNT(id_annonce) FROM annonces');
        /* On doit extraire le nombre du jeu de résultat */
        $nombredElementsTotal = $resultFoundRows->fetchColumn();
        /* Si on est sur la première page, on n'a pas besoin d'afficher de lien
     * vers la précédente. On va donc ne l'afficher que si on est sur une autre
     * page que la première */
        $nombreDePages = ceil($nombredElementsTotal / $limite);
        return $nombreDePages;
    }


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
    public function editerUneAnnonce($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id, $id){
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
        $this->id_annonce = $id;

        $nom_annonce = $_POST['nom_annonce'];

        //La requète sql
        $sql = "UPDATE `annonces` SET `nom_annonce`= ?,`description_annonce`= ?,`prix_annonce`= ?,`photo_annonce`= ?,`date_depot`= ?,`categorie_id`= ?,`utilisateur_id`= ?,`regions_id`= ? WHERE id_annonce = ?";
        //La requète préparée
        $req = $db->prepare($sql);
        //Execution de la requète
        $req->execute(array($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id, $id));
        return $req;
    }

public function rechercheAnnonceMotCle(){
        $db = $this->getPDO();
        //Recup de input recherche
        if(isset($_POST['recherche'])){
            $recherche = $_POST['recherche'];
        }else{
            $recherche = "";
            if(empty($recherche)){

            }
        }
        if(!empty($recherche)){

        }
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions WHERE nom_annonce LIKE '%$recherche%' OR description_annonce LIKE '%$recherche%' OR prix_annonce LIKE '%$recherche%' OR type_categorie LIKE '%$recherche%' OR nom_region LIKE '%$recherche%'";
        return $db->query($sql);

}

    //Afficher les détails de l'annonce par regions et categories
    public function getAnnonceByRegionAndCategorie(){
        $db = $this->getPDO();

        //Recup de input recherche
        if(isset($_POST['categorie_id']) && isset($_POST['region_id'])){
            $cat = $_POST['categorie_id'];
            $reg = $_POST['region_id'];
        }else{
            $cat = 1;
            $reg = 1;
            if(empty($cat) || empty($reg)){
                echo "<p class='alert-danger mt-2 p-2'>Merci de remplir les champs Catégorie et Région</p>";
            }
        }


        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions WHERE regions_id = ? AND categorie_id = ? ";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(1, $_POST['region_id']);
        $stmt->bindParam(2, $_POST['categorie_id']);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pdfExportParId($annonceID){
        ob_get_clean();
        //Instance de la classe
        require "../public/FPDF/fpdf.php";
        $db = $this->getPDO();
        $query = "SELECT *  FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions WHERE id_annonce = ?";
        $req = $db->prepare($query);
        $req->execute(array($annonceID));
        $details_annonces = $req->fetch();

        $this->nom_annonce = $details_annonces['nom_annonce'];
        $this->description_annonce = $details_annonces['description_annonce'];
        $this->prix_annonce = $details_annonces['prix_annonce'];
        $this->photo_annonce = $details_annonces['photo_annonce'];
        $this->categorie_id = $details_annonces['type_categorie'];
        $this->utilisateur_id = $details_annonces['nom_utilisateur'];
        $this->region_id = $details_annonces['nom_region'];

        $pdf = new FPDF('P','mm','A4');
        //Sortie
        $pdf->AddPage();
        //Header
        $pdf->Image('../public/img/logo-mini.png');

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Votre annonces : ');
        $pdf->Ln(10);
        $pdf->Cell(190,10, iconv('UTF-8', 'ISO-8859-2', 'Nom du annonce : '.$this->nom_annonce));

        $pdf->Ln(10);
        $pdf->Image(''.$details_annonces['photo_annonce'], 100, 120, 100,100);


        $pdf->Ln(10);
        $pdf->SetFont('Arial','',12);
        $pdf->MultiCell(190,10,'Description de l\'annonce : '.utf8_decode($this->description_annonce), 1, 'J');
        $pdf->Ln(10);
        $pdf->Cell(190,10,'Prix du produit : '.$this->prix_annonce. ' EUROS');
        $pdf->Ln(10);
        $pdf->Cell(190,10,iconv('UTF-8', 'ISO-8859-2', 'Catégorie : '.$this->categorie_id));
        $pdf->Ln(10);
        $pdf->Cell(190,10,'Nom du vendeur : '.$this->utilisateur_id);
        $pdf->Ln(10);
        $pdf->Cell(190,10,iconv('UTF-8', 'ISO-8859-2', 'Région : '.$this->region_id));
        $pdf->Ln(10);
        //$pdf->AddLink("http://localhost/bon_coin_mic/region&id=3");


        $pdf->Output('','annonces.pdf',true);
    }

}