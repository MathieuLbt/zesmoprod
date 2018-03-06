<?php

//on charge un fichier de parametrage
include('config/settings.php');

//on cree la requete pour recuperer les informations du contenue
$contenue = $db->prepare('SELECT * FROM contenue');

//on execute la requete
$contenue->execute();

//on cree la requete pour recuperer les informations des reseaux
$reseaux = $db->prepare('SELECT * FROM reseaux');

//on execute la requete
$reseaux->execute();

//on cree la requete pour recuperer les informations cv
$cv = $db->prepare('SELECT * FROM cv');

//on execute la requete
$cv->execute();


?><!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/main.js"></script> <!-- Resource jQuery -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

	<link rel="stylesheet" href="css/reset.css">  <!-- CSS reset -->
    <link rel="stylesheet" href="css/main.css">  <!-- Resource main -->
    <link rel="stylesheet" href="css/frise.css"> <!-- Resource frise -->

	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
    <link rel="icon" href="img/favicon.ico"/>
	<title>zesmoprod.com</title>
</head>
<body class="divwrapper">
    
	<?php include('includes/header.php'); ?> 
    

    <p class="intro">Bonjour et bienvenue sur mon site.<br> Je m'apelle François Bénard et suis un passioné de musique depuis très longtemps. <br> Je me spécialise dans le mixe audio en studio ainsi que la captation audio sur des plateaux de tournage. <br>Je suis polyvalent au niveau des rôles à exercer sur un tournage, dans un studio ou encore une émission radio.<br> Je vous souhaite une bonne navigation.
        
        <?php while($data = $cv->fetch(PDO::FETCH_ASSOC)) { ?>
        
        
        <a href="<?= $data['lien'] ?>" target="_blank"><button type="button">Télécharger mon CV</button></a></p> 
    	 <?php } ?> 
    <div class="frise">
	<section id="cd-timeline" class="cd-container">
        
        <?php while($data = $contenue->fetch(PDO::FETCH_ASSOC)) { ?>
        
                        <!-- BULLE ET BLOCK 1 -->
        
        <div class="cd-timeline-block"> <!-- PHP POUR RAJOUTER DES SECTIONS -->
			<div class="cd-timeline-img cd-picture">
                <p id="txtBulle"><?= $data['titre'] ?></p>
			</div> <!-- Texte Bulle 1 -->

			<div class="cd-timeline-content">
				<h2><?= $data['titre'] ?></h2> <!-- INSERT PHP HERE -->
				<p><?= $data['texte'] ?></p> <!-- INSERT PHP HERE -->
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
        <?php } ?> 
	</section> <!-- cd-timeline -->
    </div>
 <footer>
        <p><a href="mentions.php">Mentions légales</a> - Copyright Zesmo 2017. All rights reserved - Oblivion IESA</p>
            <?php while($data = $reseaux->fetch(PDO::FETCH_ASSOC)) { ?>
              
                <a href="<?php echo $data['lien'] ?>" target="_blank"><img src="<?php echo cover($data['logo']) ?>" alt="<?= $data['name'] ?>"/></a>
        <?php } ?>            
    </footer>         
</body>
</html>