<?php


if (isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true){

?>

<h1 class="alert alert-info text-center text-warning mt-3">GESTION DE VOS ANNONCES</h1>
<div id="user-dashboard">
    <a href="ajouter_annonce" class="btn btn-success">Ajouter une annonce</a>
    <div class="row mt-3">
        <?php

        foreach ($annonceParUtilisateur as $data) {

            ?>
            <div class="col-sm-12 col-lg-4 mt-2">
                <div id="annonce-card" class="card">
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

                        <!--MODAL SUPPRIMER-->
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                data-target="#supprimer_annonce&id_suppr=<?= $data['id_annonce'] ?>">
                            Supprimer cette annonce
                        </button>
                        <!--MODAL SUPPRIMER-->
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#editer_annonce&id_suppr=<?= $data['id_annonce'] ?>">
                            Editer cette annonce
                        </button>

                        <!--MODAL EDITER UNE ANNONCE-->
                        <div class="modal fade" id="editer_annonce&id_suppr=<?= $data['id_annonce'] ?>" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="text-center text-success">EDITER UNE ANNONCE</h1>
                                        <h2 class="text-secondary text-center">Merci remplir tous les champs du
                                            formulaire</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!--FROMULAIRE DE MISE A JOUR DE ANNONCE-->
                                        <div id="user-dashboard">
                                            <form method="post" enctype="multipart/form-data">
                                                <h2>Editer l' annonces: <?= $data['nom_annonce'] ?></h2>

                                                <div class="form-group">
                                                    <label for="nom_annonce">Nom de l'annonce :</label>
                                                    <input type="text" name="nom_annonce" class="form-control"
                                                           placeholder="<?= $data['nom_annonce'] ?>" id="nom_annonce"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="description_annonce">Description de l'annonce :</label>
                                                    <textarea name="description_annonce" class="form-control"
                                                              placeholder="<?= $data['description_annonce'] ?>"
                                                              id="description_annonce" required></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="prix_annonce">Prix de l'annonce :</label>
                                                    <input type="number" step="any" name="prix_annonce"
                                                           class="form-control" placeholder="<?= $data['prix_annonce'] ?>"
                                                           id="prix_annonce" required/>
                                                </div>

                                                <div class="form-group">
                                                    <label for="date_depot">Date de depot de l'annonce :</label>
                                                    <input type="date" name="date_depot" value="<?= date("Y-m-d") ?>"
                                                           class="form-control" id="date_depot" required/>
                                                </div>


                                                <div class="form-group">
                                                    <label for="categorie_id">Catégorie de l'annonce :</label>
                                                    <select name="categorie_id" class="form-control">
                                                        <?php
                                                        afficherToutesCatégories();
                                                        ?>
                                                    </select>
                                                </div>
                                                <input type="hidden" value="<?= $_SESSION['id_utilisateur'] ?>"
                                                       name="id_utilisateur">


                                                <div class="form-group">
                                                    <label for="regions_id">Région de l'annonce :</label>
                                                    <select name="regions_id" class="form-control">
                                                        <?php
                                                        listerRegions()
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="photo_annonce">Photos de l'annonce :</label>
                                                    <span class="d-flex justify-content-center">
                                            <input type="file" name="photo_annonce" class="form-control-file"
                                                   accept="image/gif, image/png, image/jpeg, image/svg, image/bmp, image/webp "
                                                   placeholder="Photos 1 de votre annonce" id="photo_annonce1"
                                                   required/>
                                        </span>
                                                </div>

                                                <div class="form-group">
                                                    <button name="btn_editer_annonce" class="btn btn-info">Mettre à jour votre
                                                        annonce
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                        <?php
                                        //Upload de la photo
                                        if (isset($_FILES['photo_annonce'])) {
                                            $repertoire = "../public/img/";
                                            $photo_annonce = $repertoire . basename($_FILES['photo_annonce']['name']);
                                            $_POST['photo_annonce'] = $photo_annonce;
                                            if (move_uploaded_file($_FILES['photo_annonce']['tmp_name'], $photo_annonce)) {
                                                echo "<p class='alert alert-success'>Le fichier est valide et téléchargé avec succès !</p>";
                                            } else {
                                                echo "<p class='alert alert-danger'>Erreur lors du téléchargement de votre fichier !</p>";
                                            }
                                        } else {
                                            echo "<p class='alert alert-danger'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler
                                        </button>
                                        <a href="editer_annonce&id_suppr=<?= $data['id_annonce'] ?>" type="button"
                                           class="btn btn-success">Appliquer la mise a jour</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal SUPPRIMER ANNONCES-->
                        <div class="modal fade" id="supprimer_annonce&id_suppr=<?= $data['id_annonce'] ?>" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="text-center text-danger">ATTENTION</h1>
                                        <h2 class="text-warning text-center">Vous allez supprimer ce produit !</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <h3 class="modal-title text-info text-center"
                                                    id="exampleModalLabel"><?= $data['nom_annonce'] ?></h3>
                                            </li>
                                            <li class="list-group-item text-center">
                                                <img src="~/<?= $data['photo_annonce'] ?>"
                                                     alt="<?= $data['nom_annonce'] ?>"
                                                     title="<?= $data['nom_annonce'] ?>" width="50%" class="img-fluid">
                                            </li>
                                            <li class="list-group-item">
                                                <p><b>Description : </b></p>
                                                <p><?= $data['description_annonce'] ?></p>
                                            </li>
                                            <li class="list-group-item">
                                                <p><b>Prix : <?= $data['prix_annonce'] ?> €</b></p>
                                            </li>
                                            <li class="list-group-item">
                                                <p><b>Catégorie : </b><?= $data['type_categorie'] ?></p>
                                            </li>
                                            <li class="list-group-item">
                                                <p><b>Région : </b><?= $data['nom_region'] ?></p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler
                                        </button>
                                        <a href="supprimer_annonce&id_suppr=<?= $data['id_annonce'] ?>" type="button"
                                           class="btn btn-primary">Confirmer la suppression</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

        }
        ?>
            </div>
        <?php


        } else {
            header("Location: connexion_utilisateur");
        }

        ?>

