<?php //fichier son.php

//on charge un fichier de parametrage
include('../config/settings.php');

//si l'id de l'adresse est vide
if(empty($_GET['id']))
	//on redirige vers l'accueil
	redirect('index.php');

//on cree la requete pour recuperer les informations de ce film
$music = $db->prepare('SELECT * FROM music WHERE id = :i');

//on ajoute les valeurs correspondantes aux pseudo-variables
$music->bindParam(':i', $_GET['id'], PDO::PARAM_INT);

//on execute la requete
$music->execute();

//si on a aucun resultat
if($music->rowCount() == 0)
	//on va sur l'accueil
	redirect('index.php');

//sinon
else
	//on lit les donnees
	$data = $music->fetch(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title><?= $data['titre'] ?> -Son</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>
	<article>
		<h1><?= $data['titre'] ?></h1>
		<p>
			<a class="btn btn-small btn-warning" href="updateSon.php?id=<?= $data['id'] ?>">Modifier</a>
			<a class="btn btn-small btn-error" href="../core/deleteSon.php?id=<?= $data['id'] ?>">Supprimer</a>
		</p>
		<p>
			<span class="label">Son créée le</span>
			<?= dateEU($data['created'], true) ?>
		</p>
		
	</article>
</body>
</html>