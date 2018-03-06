<?php //fichier /back/addRS.php

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
	<title>Ajouter un RS - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>

	<form method="post" action="../core/addRS.php" enctype="multipart/form-data">
		<h1>Ajouter un RS</h1>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?= $maxFileSize ?>">
		<p>
			<label for="name">Nom</label>
			<input required type="name" name="name" id="name" placeholder="nom du réseau">
		</p>			
        <p>
			<label for="lien">Lien</label>
			
            <input required type="url" name="lien" id="lien" placeholder="URL du réseau">
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