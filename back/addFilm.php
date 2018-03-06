<?php //fichier /back/addFilm.php

//on charge un fichier de parametrage
include('../config/settings.php');

//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user']))
	//on le vire vers la page de login
	redirect('login.php');


?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title>Ajouter un film - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>

	<form method="post" action="../core/addFilm.php" enctype="multipart/form-data">
		<h1>Ajouter un film</h1>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?= $maxFileSize ?>">
		<p>
			<label for="titre">Titre</label>
			<input required type="text" name="titre" id="titre" placeholder="Titre">
		</p>
		<p>
			<label for="description">Résumé</label>
			<textarea name="description" id="description" placeholder="Résumé"></textarea>
		</p>			
        <p>
			<label for="lien">lien</label>
			
            <input required type="url" name="lien" id="lien" placeholder="URL vidéo">
		</p>
		<p>
			<input type="file" name="cover">
		</p>
		<p>
			<button class="btn btn-valid">Enregistrer</button>
		</p>
	</form>

</body>
</html>