<?php //fichier back/film.php

//on charge un fichier de parametrage
include('../config/settings.php');

//si l'id de l'adresse est vide
if(empty($_GET['id']))
	//on redirige vers l'accueil
	redirect('index.php');

//on cree la requete pour recuperer les informations de ce film
$movie = $db->prepare('SELECT * FROM movie WHERE id = :i');

//on ajoute les valeurs correspondantes aux pseudo-variables
$movie->bindParam(':i', $_GET['id'], PDO::PARAM_INT);

//on execute la requete
$movie->execute();

//si on a aucun resultat
if($movie->rowCount() == 0)
	//on va sur l'accueil
	redirect('index.php');

//sinon
else
	//on lit les donnees
	$data = $movie->fetch(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title><?= $data['titre'] ?> -Film</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>
	<article>
		<h1><?= $data['titre'] ?></h1>
		<p>
			<a class="btn btn-small btn-warning" href="updateFilm.php?id=<?= $data['id'] ?>">Modifier</a>
			<a class="btn btn-small btn-error" href="../core/deleteFilm.php?id=<?= $data['id'] ?>">Supprimer</a>
		</p>
		<p>
			<span class="label">Résumé</span>
			<?= $data['description'] ?>
		</p>
		<p>
			<span class="label">Fiche créée le</span>
			<?= dateEU($data['created'], true) ?>
		</p>
		<p>
			<span class="label">Fiche modifiée le</span>
			<?= dateEU($data['updated'], true) ?>
		</p>
		<figure>
			<img src="<?= Backcover($data['cover'], true) ?>" alt="Couverture de <?= $data['titre'] ?>">
		</figure>
		
	</article>
</body>
</html>