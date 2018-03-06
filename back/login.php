<?php //fichier /back/login.php

//on charge un fichier de parametrage
include('../config/settings.php');


?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title>Se connecter - Back-Office</title>
</head>
<body>
	<form action="../core/login.php" method="post">
		<h1>Se connecter</h1>
		<p>
			<input type="text" name="pseudo" placeholder="Votre pseudo">
		</p>
		<p>
			<input type="password" name="pass" placeholder="Votre mot de passe">
		</p>
		<p>
			<button type="submit" class="btn btn-valid">Se connecter</button>
		</p>
	</form>
</body>
</html>