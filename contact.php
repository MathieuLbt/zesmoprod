<?php

//on charge un fichier de parametrage
include('config/settings.php');

//on cree la requete pour recuperer les informations des reseaux
$reseaux = $db->prepare('SELECT id, lien, logo FROM reseaux');

//on execute la requete
$reseaux->execute();

$msg = '';
//Don't run this unless we're handling a form submission
if (array_key_exists('email', $_POST)) {
    date_default_timezone_set('Etc/UTC');

    require 'PHPMailerAutoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP - requires a local mail server
    //Faster and safer than using mail()
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->Username = "francoisbnd92@hotmail.fr";
    $mail->Password = "Jmxjfben92";
    $mail->SMTPSecure = "STARTTLS";
    $mail->Port = 587;

    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->setFrom('francoisbnd92@hotmail.fr', 'Zesmoprod.com');
    //Send the message to yourself, or whoever should receive contact for submissions
    $mail->addAddress('francoisbnd92@hotmail.fr', '');
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = 'Prise de contact sur zesmoprod.com';
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Message: {$_POST['message']}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but you shouldn't display errors to users - process the error, log it on your server.
            $msg = 'Désolé, une erreur est survenue. Veuillez réessayer plus tard';
        } else {
            $msg = 'Message envoyé!';
        }
    } else {
        $msg = 'Adresse email invalide, message ignoré.';
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="css/contact.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/favicon.ico"/>
    <title>zesmoprod.com</title>
</head>
<body class="divwrapper">

<?php include('includes/header.php'); ?>
    
    
<!-- Début du contenu de la page -->
    
    <div class="col-12 row">
        <figure class="figuImage">  
        <img src="img/contact/photo_francoisbenard_contact2.jpg" alt=" Photo de François BENARD"/>
        <figcaption class="figContact">Zesmo<br>aka François BENARD <br> francoisbnd92@hotmail.fr</figcaption>
        </figure>
       
        <form id="contact" class="col-8" method="POST">
            <h1>N'hésitez pas à me contacter</h1>
            
      <?php if (!empty($msg)) {
                echo'<h2 id="message">'.$msg.'</h2>';
            } ?>
            
        <p class="names"><input type="text" id="name" name="name" placeholder="Prénom et Nom" required/></p>
            
        <p class="mail"><input type="text" name="email" id="email" placeholder="email@exemple.com" required/></p>
            
        <p class="message"><textarea type="text"  id="message" name="message" placeholder="Message" required></textarea></p>
            
        <p><button type="submit" name="envoi">Envoyer</button></p>
            
        </form>
    </div>
    
    <!-- Fin du contenu de la page -->
    
   <footer>
        <p>Copyright Zesmo 2017. All rights reserved - Oblivion IESA</p>
        
            <?php while($data = $reseaux->fetch(PDO::FETCH_ASSOC)) { ?>
              
                <a href="<?php echo $data['lien'] ?>" target="_blank"><img src="<?php echo cover($data['logo']) ?>" alt="<?= $data['name'] ?>"/></a>
        
        <?php } ?>            
    </footer>
</body>
</html>
    
    