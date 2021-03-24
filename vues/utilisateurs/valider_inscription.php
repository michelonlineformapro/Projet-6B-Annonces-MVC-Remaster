<?php
echo "c bon t inscrit";
?>
<h1 class="text-center text-success">Confirmation d'inscription au site Annonces.com</h1>
<h2 class="text-warning">Reprise de vos informations :</h2>
<ul class="list-group">
    <li class="list-group-item">Nom : <?= $recupUtilisateur['nom_utilisateur']  ?></li>
    <li class="list-group-item">Email : <?= $recupUtilisateur['email_utilisateur']  ?></li>
    <li class="list-group-item">Mot de passe : <?= $recupUtilisateur['password_utilisateur']  ?></li>
    <li class="list-group-item"><a class="btn btn-outline-primary" href="connexion_utilisateur">Se connecter</a></li>
</ul>

