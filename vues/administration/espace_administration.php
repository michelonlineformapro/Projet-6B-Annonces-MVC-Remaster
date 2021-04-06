<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/>
</head>

<?php
if (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] == true) {
    ?>
    <h1 class="text-success">ESPACE ADMINISTRATION</h1>
    <h2 class="text-secondary">BIENVENUE <?= $_SESSION['email_admin'] ?></h2>
    <a href="deconnexion" class="btn btn-outline-danger mt-3">Deconnexion espace administration</a>
    <div class="jumbotron mt-3">
        <h3 class="text-warning">TABLE DES ADMINISTRATEURS :</h3>
        <a href="ajouter_admin" class="btn btn-outline-success">Ajouter un administrateur</a>
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email Admin</th>
                <th>Mot de passe Admin</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tableAdmin as $admin){
                ?>
                <tr>
                    <td><?= $admin['id_admin'] ?></td>
                    <td><?= $admin['email_admin'] ?></td>
                    <td><?= $admin['password_admin'] ?></td>
                    <!-- MODAL SUPPRIMER -->
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#supprimer_admin&id_suppr=<?= $admin['id_admin'] ?>">
                            Supprimer
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="supprimer_admin&id_suppr=<?= $admin['id_admin'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>ID = <?= $admin['id_admin'] ?></p>
                                        <p>Email = <?= $admin['email_admin'] ?></p>
                                        <p>Mot de passe = <?= $admin['password_admin'] ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <a href="supprimer_admin&id_suppr=<?= $admin['id_admin'] ?>" type="button"
                                            class="btn btn-primary">Confirmer la suppression</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="jumbotron mt-3">

            <h3 class="text-warning">TABLE DES ANNONCES :</h3>
            <table id="tableAnnonce" class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom annonce</th>
                    <th>Description annonce</th>
                    <th>Prix annonce</th>
                    <th>Photo annonce</th>
                    <th>Date dépot annonce</th>
                    <th>Catégorie annonce</th>
                    <th>Propriétaire annonce</th>
                    <th>Région annonce</th>
                    <th>Supprimer annonce</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($tableAnnonce as $admin){
                    ?>
                    <tr>
                        <td><?= $admin['id_annonce'] ?></td>
                        <td><?= $admin['nom_annonce'] ?></td>
                        <td><?= $admin['description_annonce'] ?></td>
                        <td><?= $admin['prix_annonce'] ?></td>
                        <td><img width="100%" src="~/<?= $admin['photo_annonce'] ?>" alt="<?= $admin['nom_annonce'] ?>" title="<?= $admin['nom_annonce'] ?>"/></td>
                        <td><?= $admin['date_depot'] ?></td>
                        <td><?= $admin['type_categorie'] ?></td>
                        <td><?= $admin['email_utilisateur'] ?></td>
                        <td><?= $admin['nom_region'] ?></td>
                        <!-- MODAL SUPPRIMER -->
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#supprimer_annonce_admin&id_suppr=<?= $admin['id_annonce'] ?>">
                                Supprimer
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="supprimer_annonce_admin&id_suppr=<?= $admin['id_annonce'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>ID = <?= $admin['id_annonce'] ?></p>
                                            <p>Nom = <?= $admin['nom_annonce'] ?></p>
                                            <p>Description = <?= $admin['description_annonce'] ?></p>
                                            <p>Prix = <?= $admin['prix_annonce'] ?></p>
                                            <p><img width="25%" src="~/<?= $admin['photo_annonce'] ?>"/></p>
                                            <p>Date de depot = <?= $admin['date_depot'] ?></p>
                                            <p>Catégorie = <?= $admin['type_categorie'] ?></p>
                                            <p>Propriétaire = <?= $admin['email_utilisateur'] ?></p>
                                            <p>Région = <?= $admin['nom_region'] ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <a href="supprimer_annonce_admin&id_suppr=<?= $admin['id_annonce'] ?>" type="button"
                                               class="btn btn-primary">Confirmer la suppression</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>

            $('#tableAnnonce').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });
    </script>


    <?php

} else {
    header("location: accueil?page=1");
}