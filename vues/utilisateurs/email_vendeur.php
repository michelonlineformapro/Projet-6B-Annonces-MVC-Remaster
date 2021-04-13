<h1 class="alert alert-warning text-center mt-3">CONTACTER LE VENDEUR</h1>

<div id="user-dashboard">
    <form method="post">
        <h2 class="text-success">Contacter le vendeur :  <?= $afficherUtilisateurParId['email_utilisateur'] ?></h2>

        <div class="form-group">
            <label for="email_visiteur">Votre email</label>
            <input type="text" class="form-control" name="email_visiteur" id="email_visiteur">
        </div>

        <div class="form-group">
            <label for="message_visiteur">Votre message</label>
            <textarea rows="5" type="text" class="form-control" name="message_visiteur" id="message_visiteur"></textarea>
        </div>

        <div class="form-group">

            <form method="post">
                <button type="submit" class="btn btn-danger" name="btn-email-vendeur">Envoyer</button>
            </form>

        </div>
    </form>
</div>

<?php
if(isset($_POST['btn-email-vendeur'])){

     $to      = $afficherUtilisateurParId['email_utilisateur'];
     $subject = 'Prise de contact';
     $message = $_POST['message_visiteur'];
     $headers = 'From: michel.michael38@gmail.com' . "\r\n" .
     'Reply-To: michel.michael38@gmail.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($to, $subject, $message, $headers);

    var_dump($_POST['email_visiteur']);
    var_dump($_POST['message_visiteur']);
}