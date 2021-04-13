<div class="jumbotron mt-3">
    <div class="text-center">
        <h1 class="text-warning">RECHERCHER UNE ANNONCE</h1>
        <form method="post">
            <input type="search" name="recherche" class="form-control" placeholder="Rechercher une annonce"/>
            <button type="submit" name="btn-search-name" class="btn btn-outline-success mt-3">Rechercher</button>
        </form>
    </div>
</div>


<div class="jumbotron">
    <div class="text-center">
        <h1 class="text-info">Rechercher une annonce par catégorie et région</h1>

        <div id="search-form" class="d-flex justify-content-center">
            <form class="form-inline text-center mt-2" method="post">
                <div class="form-group mb-2">
                    <select name="categorie_id" id="categorie" class="form-control form-search-item">
                        <?php
                        afficherToutesCategories();
                        ?>
                    </select>
                </div>

                <div class="form-group mb-2 ml-2">
                    <select class="form-control" id="stock" name="region_id">
                        <?php
                        listerRegions()
                        ?>
                    </select>
                </div>
                <div class="form-group mb-2 ml-2">
                    <button type="submit" name="search_valid" class="btn btn-outline-warning">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div>
    <h1 class="text-center text-primary">Résultat de votre recherche</h1>
    <div class="row">
        <?php
        if(!empty($_POST['recherche'])){


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
                        <p><b>Vendeur : </b><?= $data['email_utilisateur'] ?> €</p>
                        <p><b>Catégorie : </b><?= $data['type_categorie'] ?> €</p>
                        <p><b>Région : </b><?= $data['nom_region'] ?> €</p>
                        <?php
                        if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true ){
                            ?>
                            <a href="acheter&id=<?= $data['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
                            <?php
                        }else{
                            ?>
                            <a href="connexion_utilisateur&id=<?= $data['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
                            <?php
                        }
                        ?>


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#numero&id=<?= $data['id_annonce'] ?>">
                            CONTACT
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="numero&id=<?= $data['id_annonce'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">CONTACT VENDEUR</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group active">
                                            <li class="list-group-item">Email : <?= $data['email_utilisateur'] ?></li>
                                            <li class="list-group-item">N° de téléphone : <?= $data['nom_utilisateur'] ?></li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="email_vendeur&id=<?= $data['utilisateur_id'] ?>" class="btn btn-primary mt-3">Message</a>

                        <a target="_blank" href="pdf&id=<?= $data['id_annonce'] ?>" class="btn btn-warning mt-3">Annonce en PDF</a>
                    </div>
                </div>
            </div>
            <?php
            }
        }else{
            echo "<div class='container jumbotron'><p class='alert alert-danger'>Merci de replir le champ de recherche</p></div>";
        }
        ?>
    </div>
</div>




