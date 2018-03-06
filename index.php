<?php

//on charge un fichier de parametrage
include('config/settings.php');

//on cree la requete pour recuperer les informations de ce livre
$reseaux = $db->prepare('SELECT id, lien, logo FROM reseaux');

//on execute la requete
$reseaux->execute();

?><!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="icon" href="img/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>zesmoprod.com</title>
    </head>
    
<body class="divwrapper">
    <header>
        <h1><a href="index.php"><img id="logo" src="img/logofrancois/logofrancois.png" alt="logo"/></a></h1>  
    </header>
    
    
    
    
    
    
        <section id="index" class="row">
            <a href="disco.php">
            <article class="col-4" id="disco">
                        <h1>Discographie</h1>
            </article></a>
            <a href="frise.php">
             <article class="col-8" id="perso">
                    <h1>Persographie</h1>
            </article></a>
            <a href="filmo.php">
            <article class="col-12" id="filmo">
                    <h1>Filmographie</h1>
            </article></a>
        </section>
            <footer>
        <p><a href="mentions.php">Mentions légales</a> - Copyright Zesmo 2017. All rights reserved - Oblivion IESA</p>
            <?php while($data = $reseaux->fetch(PDO::FETCH_ASSOC)) { ?>
              
                <a href="<?php echo $data['lien'] ?>" target="_blank"><img src="<?php echo cover($data['logo']) ?>" alt="<?= $data['name'] ?>"/></a>
        
        <?php } ?>            
    </footer>
    </body>
</html>