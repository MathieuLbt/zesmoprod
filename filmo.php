<?php

//on charge un fichier de parametrage
include('config/settings.php');

//on cree la requete pour recuperer les informations de ce livre
$movie = $db->prepare('SELECT id, lien, cover, description, titre FROM movie');

//on execute la requete
$movie->execute();

//on cree la requete pour recuperer les informations des reseaux
$reseaux = $db->prepare('SELECT id, lien, logo FROM reseaux');

//on execute la requete
$reseaux->execute()

?><!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8"/>
   <script type="text/javascript" src="script.js"></script>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" href="img/favicon.ico"/>

    <title>zesmoprod.com</title>

    </head>

    <body class="divwrapper">
        <?php include('includes/header.php') ?>
        
        <article id="filmorespo" class="row">
            <?php while($data = $movie->fetch(PDO::FETCH_ASSOC)) { ?>
            
            <div id="video" class="col-4">
                <a data-fancybox href="<?php echo $data['lien'] ?>"><img src="<?php echo cover($data['cover']) ?>" alt="Couverture de <?= $data['titre'] ?>"></a>
            </div>
            <?php } ?> 
        </article>
<footer>
        <p><a href="mentions.php">Mentions légales</a> - Copyright Zesmo 2017. All rights reserved - Oblivion IESA</p>
            <?php while($data = $reseaux->fetch(PDO::FETCH_ASSOC)) { ?>
              
                <a href="<?php echo $data['lien'] ?>" target="_blank"><img src="<?php echo cover($data['logo']) ?>" alt="<?= $data['name'] ?>"/></a>
        
        <?php } ?>            
    </footer>
    </body>
</html>