<div class="jumbotron">
    <div class="text-center">
        <h1 class="text-warning">RECHERCHER UNE ANNONCE</h1>
        <form method="post">
            <input type="search" name="recherche" class="form-control" placeholder="Rechercher une annonce"/>
            <button type="submit" name="btn-search-name" class="btn btn-outline-success">Rechercher</button>
        </form>
    </div>
</div>

<h1 class="text-warning">Resultat de la recherche</h1>
<div class="row">
    <?php

    foreach ($results as $data){
        ?>
        <div class="col-sm-12 col-lg-4 mt-2">
            <div id="annonce-card" class="card">
                <img class="card-img-top img-fluid" src="~/<?= $data['photo_annonce'] ?>" alt="<?= $data['nom_annonce'] ?>" title="<?= $data['nom_annonce'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $data['nom_annonce'] ?></h5>
                    <p class="card-text"><b>Description :</b></p>
                    <p><?= $data['description_annonce'] ?></p>
                    <p><b>Prix : </b><?= $data['prix_annonce'] ?> €</p>
                    <p>Catégories : <?= $data['type_categorie'] ?></p>
                    <p>Nom du vendeur : <?= $data['email_utilisateur'] ?></p>
                    <p>Regions : <?= $data['nom_region'] ?></p>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>