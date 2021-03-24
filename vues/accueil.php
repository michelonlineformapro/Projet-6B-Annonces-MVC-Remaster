<?php
echo "Bonjour page d'accueil";

foreach ($recupAnnonce as $row){
    ?>
        <h1 class="text-center text-info">Bonjour</h1>
    <br />
    <?php
    echo $row['nom_annonce'];
    ?>
    <br />
    <?php
    echo $row['description_annonce'];
    ?>
    <br />
    <?php
    echo $row['prix_annonce'] ." €";
}

