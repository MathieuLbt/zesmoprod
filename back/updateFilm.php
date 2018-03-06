<?php //fichier /back/updateFilm.php

include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('login.php');

if(empty($_GET['id']))
	redirect('index.php');

//on lit les infos
$movie = $db->prepare('SELECT * FROM movie WHERE id = :i');
$movie->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$movie->execute();

//si on a aucun resultat
if($movie->rowCount() == 0)
	redirect('index.php');

else
	$data = $movie->fetch(PDO::FETCH_ASSOC);


?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title>Modifier un film - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>

	<form method="post" action="../core/updateFilm.php" enctype="multipart/form-data">
		<h1>Modifier un film</h1>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?= $maxFileSize ?>">
		<input type="hidden" name="id" value="<?= $data['id'] ?>">
		<p>
			<label for="titre">Titre</label>
			<input required type="text" name="titre" id="titre" placeholder="Titre" value="<?= $data['titre'] ?>">
		</p>
		<p>
			<label for="description">Résumé</label>
			<textarea name="description" id="description" placeholder="Résumé"><?= $data['description'] ?></textarea>
		</p>
		<p>
			<label for="lien">lien</label>
			
            <input required type="url" name="lien" id="lien" placeholder="URL vidéo" value="<?= $data['lien'] ?>">
		</p>
		<?php if(!empty($data['cover'])) { ?>
		<figure class="mini">
			<img src="<?= cover($data['cover'], true) ?>" alt="Couverture de <?= $data['titre'] ?>">
		</figure>
		<?php }else
			echo '<p>Aucune image actuellement</p>'; ?>
		<p>
			<input type="file" name="cover">
		</p>
		<p>
			<button class="btn btn-valid">Enregistrer</button>
		</p>
	</form>
</body>
</html>