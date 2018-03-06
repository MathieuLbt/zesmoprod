<?php //fichier /back/addSon.php

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
	<title>Ajouter un son - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>

	<form method="post" action="../core/addSon.php" enctype="multipart/form-data">
		<h1>Ajouter un son</h1>
		<p>
			<label for="titre">Titre</label>
			<input required type="text" name="titre" id="titre" placeholder="Titre">
		</p>
		<p>
			<input type="file" name="son">
		</p>
  
		<p>
			<button class="btn btn-valid">Enregistrer</button>
		</p>
	</form>

</body>
</html>