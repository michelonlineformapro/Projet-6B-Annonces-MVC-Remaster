

<div>
    <h1 class="text-warning">Resultat de la recherche</h1>
    <div class="row">
        <?php

        foreach ($resultsCR as $row){
            ?>
            <div class="col-sm-12 col-lg-4 mt-2">
                <div id="annonce-card" class="card">
                    <img class="card-img-top img-fluid" src="~/<?= $row['photo_annonce'] ?>" alt="<?= $row['nom_annonce'] ?>" title="<?= $row['nom_annonce'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['nom_annonce'] ?></h5>
                        <p class="card-text"><b>Description :</b></p>
                        <p><?= $row['description_annonce'] ?></p>
                        <p><b>Prix : </b><?= $row['prix_annonce'] ?> €</p>
                        <p>Catégories : <?= $row['type_categorie'] ?></p>
                        <p>Nom du vendeur : <?= $row['email_utilisateur'] ?></p>
                        <p>Regions : <?= $row['nom_region'] ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
