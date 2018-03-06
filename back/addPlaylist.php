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
	<title>Ajouter une Playlist - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>

	<form method="post" action="../core/addPlaylist.php" enctype="multipart/form-data">
		<h1>Ajouter une Playlist</h1>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?= $maxFileSize ?>">
		<p>
			<label for="titre">Titre Playlist</label>
			<input required type="text" name="titre" id="titre" placeholder="Titre">
		</p>
		<p>
			<label for="description">Description</label>
			<textarea name="description" id="description" placeholder="Description"></textarea>
		</p>		
		<p>
            <label>Pochette</label>
			<input type="file" name="pochette">
		</p>
		<p>
			<button class="btn btn-valid">Enregistrer</button>
		</p>
	</form>

</body>
</html>