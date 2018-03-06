<?php //fichier back/RS.php

//on charge un fichier de parametrage
include('../config/settings.php');

//si l'id de l'adresse est vide
if(empty($_GET['id']))
	//on redirige vers l'accueil
	redirect('index.php');

//on cree la requete pour recuperer les informations de ce film
$reseaux = $db->prepare('SELECT * FROM reseaux WHERE id = :i');

//on ajoute les valeurs correspondantes aux pseudo-variables
$reseaux->bindParam(':i', $_GET['id'], PDO::PARAM_INT);

//on execute la requete
$reseaux->execute();

//si on a aucun resultat
if($reseaux->rowCount() == 0)
	//on va sur l'accueil
	redirect('index.php');

//sinon
else
	//on lit les donnees
	$data = $reseaux->fetch(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title><?= $data['name'] ?> reseaux</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>
	<article>
		<h1><?= $data['name'] ?></h1>
		<p>
			<a class="btn btn-small btn-warning" href="updateRS.php?id=<?= $data['id'] ?>">Modifier</a>
			<a class="btn btn-small btn-error" href="../core/deleteRS.php?id=<?= $data['id'] ?>">Supprimer</a>
		</p>
		<p>
			<span class="label">Nom</span>
			<?= $data['name'] ?>
		</p>
		<p>
			<span class="label">RS créée le</span>
			<?= dateEU($data['created'], true) ?>
		</p>
		<figure>
			<img src="<?= $data['logo'] ?>" alt="Logo de <?= $data['name'] ?>">
		</figure>
	</article>
</body>
</html>