

    <div class="row mt-3">
        <?php
        foreach ($recupAnnonce as $data) {
            ?>
            <div class="col-sm-12 col-lg-4 mt-2">
                <div id="annonce-card" class="card">
                    <h3 class="text-success p-4"><?= $data['nom_annonce'] ?> N° : <?= $data['id_annonce'] ?></h3>
                    <img class="card-img-top img-fluid" src="~/<?= $data['photo_annonce'] ?>"
                         alt="<?= $data['nom_annonce'] ?>" title="<?= $data['nom_annonce'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['nom_annonce'] ?></h5>
                        <p class="card-text"><b>Description :</b></p>
                        <p><?= $data['description_annonce'] ?></p>
                        <p><b>Prix : </b><?= $data['prix_annonce'] ?> €</p>
                        <p><b>Catégorie : </b><?= $data['type_categorie'] ?></p>
                        <p><b>Nom du vendeur : </b><?= $data['nom_utilisateur'] ?></p>
                        <p><b>Région : </b><?= $data['nom_region'] ?></p>
                        <?php
                        $date_depot = new DateTime($data['date_depot']);
                        ?>
                        <p><em>Date de dépot : <?= $date_depot->format('d-m-Y') ?></em></p>

                        <a href="details_annonce&id_details=<?= $data['id_annonce'] ?>" class="btn btn-outline-success mt-2">Détails de l' annonce</a>

                    </div>
                </div>
            </div>
        <?php
            }
        ?>
    </div>







