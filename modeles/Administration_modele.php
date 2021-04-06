<?php

require_once "Database_modele.php";

class Administration_modele extends Database_modele
{
    private $id_admin;
    private $email_admin;
    private $password_admin;

    //Utilisateur
    private $id_utilisateur;

    //Coonexion de l'adminsitarteur
    public function connexionAdministration(){
        //Connexiona PDO
        $db = $this->getPDO();

        $this->email_admin = $_POST['email_admin'];
        $this->password_admin = $_POST['password_admin'];

        $sql = "SELECT * FROM administration WHERE email_admin = ? AND password_admin = ?";

        $admin = $db->prepare($sql);

        $admin->bindParam(1, $_POST['email_admin']);
        $admin->bindParam(2, $_POST['password_admin']);

        if($admin->rowCount() >= 0){

            $row = $admin->fetch(PDO::FETCH_BOTH);
            $this->id_admin = $row['id_admin'];
            $this->email_admin = $row['email_admin'];
            $this->password_admin = $row['password_admin'];

            if($this->email_admin == $row['email_admin'] && $this->password_admin == $row['password_admin']){
                session_start();
                $_SESSION['connecter_admin'] = true;
                $_SESSION['email_admin'] = $_POST['email_admin'];
                header("location: espace_admin");
            }else{
                echo "<p class='alert alert-danger'>L'email et le mot passe ne sont pas valide !</p>";
            }
        }else{
            var_dump($admin->rowCount());
            echo "<p class='alert alert-danger'>Aucun administrateur ne possède cet email et ce mot de passe !</p>";
            var_dump($_POST['email_admin']);
            var_dump($_POST['password_admin']);
        }

    }

    //Afficher tous les valeurs de la table administration
    public function  afficherTableAdmin(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM administration";
        $datas = $db->query($sql);
        return $datas;
    }

    //Supprimer un uAdmin
    public function supprimerUnAdministrateur(){
        $db = $this->getPDO();
        $sql = "DELETE FROM administration WHERE id_admin = ?";
        $stmt = $db->prepare($sql);
        $this->id_admin = $_GET['id_suppr'];
        //Lié les paramètre (ici id de annonce a $_GET id url)
        $stmt->bindParam(1, $this->id_admin);
        //Execution de la requète
        $deleteAdmin = $stmt->execute();
        //Retourne l'objet avec son id
        return $deleteAdmin;
    }

    //AJOUTER UN ADMIN
    public function ajouterUnAdministrateur($email_admin, $password_admin){
        $db = $this->getPDO();
        $sql = "INSERT INTO administration (email_admin, password_admin) VALUES (?,?)";

        $this->email_admin = $email_admin;
        $this->password_admin = $password_admin;

        $stmt = $db->prepare($sql);

        $stmt->bindParam(1, $email_admin);
        $stmt->bindParam(2, $password_admin);

        $stmt->execute(array($email_admin, $password_admin));
        return $stmt;

    }


    /**********************TABLE ANNONCES***********************/
    public function afficherTableAnnonce(){
        $db = $this->getPDO();
        //Requète SQL + jointure
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions ORDER BY utilisateur_id ASC";
        $request = $db->query($sql);
        return $request;
    }

}

