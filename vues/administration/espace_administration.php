<?php
if (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] == true) {
    ?>
    <h1 class="text-success">ESPACE ADMINISTRATION</h1>
    <h2 class="text-secondary">BIENVENUE <?= $_SESSION['email_admin'] ?></h2>
    <a href="deconnexion" class="btn btn-outline-danger">Deconnexion espace administration</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email Admin</th>
                <th>Mot de passe Admin</th>
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
                    </tr>
                <?php
            }
        ?>
        </tbody>
    </table>

    <?php

} else {
    header("location: accueil?page=1");
}