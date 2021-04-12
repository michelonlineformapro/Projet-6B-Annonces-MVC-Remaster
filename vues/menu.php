<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="accueil?page=1">
        <img id="logo" src="public/img/logo-mini.png" alt="Annonce.com" title="Annonces.com">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link h3" href="accueil?page=1">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link h3" href="rechercher">Rechercher</a>
            </li>
            <li class="nav-item">
                <a class="nav-link h3" href="inscription_utilisateur">Inscription</a>
            </li>
            <li class="nav-item">
                <?php
                if(isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true){
                    ?>
                    <a class="nav-link h3" href="deconnexion">Deconnexion</a>
                    <li class="nav-item">
                        <a class="nav-link text-warning h3" href="gestion_annonces">Bonjour : <?= $_SESSION['email_utilisateur']  ?></a>
                    </li>
                    <?php
                }else{
                    ?>
                    <a class="nav-link h3" href="connexion_utilisateur">Connexion</a>
                <?php
                }
                ?>

            </li>

        </ul>
    </div>
</nav>