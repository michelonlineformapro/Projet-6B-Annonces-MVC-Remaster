<?php
if(isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] == true){
    ?>
        <h1 class="text-success">ESPACE ADMINISTRATION</h1>
        <h2 class="text-secondary">BIENVENUE <?=  $_SESSION['email_admin'] ?></h2>

    <?php
}else{
    header("location: accueil?page=1");
}