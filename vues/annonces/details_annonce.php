
    <h1 class="text-success">Annonce numéro : <?= $details['id_annonce'] ?></h1>
    <div id="annonce-card" class="card">
        <img width="30%"  class="" src="~/<?= $details['photo_annonce'] ?>"
             alt="<?= $details['nom_annonce'] ?>" title="<?= $details['nom_annonce'] ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $details['nom_annonce'] ?></h5>
            <p class="card-text"><b>Description :</b></p>
            <p><?= $details['description_annonce'] ?></p>
            <p><b>Prix : </b><?= $details['prix_annonce'] ?> €</p>
            <p><b>Catégorie : </b><?= $details['type_categorie'] ?></p>
            <p><b>Nom du vendeur : </b><?= $details['nom_utilisateur'] ?></p>
            <p><b>Région : </b><?= $details['nom_region'] ?></p>
            <?php
            $date_depot = new DateTime($details['date_depot']);
            ?>
            <p><em>Date de dépot : <?= $date_depot->format('d-m-Y') ?></em></p>

            <?php
            if(isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true){
                ?>
                <a href="gestion_annonces" type="button" class="btn btn-outline-warning mt-3">Retour</a>
                <?php
            }else{
                ?>
                <a href="accueil?page=1" type="button" class="btn btn-outline-warning mt-3">Retour</a>
                <?php
            }


            if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true ){?>
            <a href="acheter&id=<?= $details['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
            <?php
            }else{
            ?>
            <a href="connexion_utilisateur&id=<?= $details['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
            <?php
            }
            ?>


            <a onclick="changeText()"  class="btn btn-success mt-3 num_vendeur">Voir me numéro du vendeur</a>

            <a href="messageVendeur&id=<?= $details['utilisateur_id'] ?>" class="btn btn-primary mt-3">Message</a>

            <a target="_blank" href="pdf&id=<?= $details['id_annonce'] ?>" class="btn btn-warning mt-3">Annonce en PDF</a>

        </div>
    </div>
