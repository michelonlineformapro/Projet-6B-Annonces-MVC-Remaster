<?php

require_once "Database_modele.php";

class Administration_modele extends Database_modele
{
    private $id_admin;
    private $email_admin;
    private $password_admin;

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

}