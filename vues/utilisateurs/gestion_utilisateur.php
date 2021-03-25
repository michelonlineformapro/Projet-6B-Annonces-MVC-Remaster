<?php

?>

<h1 class="alert alert-info text-center text-warning mt-3">GESTION DE VOS ANNONCES</h1>

<div id="user-dashboard">
    <p>TETSTETSTETTSTET</p>
    <form action="file-upload.php" method="post" enctype="multipart/form-data">
        Envoyez plusieurs fichiers : <br />
        <input name="userfile[]" type="file" /><br />
        <input name="userfile[]" type="file" /><br />
        <input type="submit" value="Envoyer les fichiers" />
    </form>

</div>
