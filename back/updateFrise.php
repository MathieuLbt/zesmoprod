<?php //fichier /back/updateFrise.php

include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('login.php');

if(empty($_GET['id']))
	redirect('index.php');

//on lit les infos
$zesmoprod = $db->prepare('SELECT * FROM contenue WHERE id = :i');
$zesmoprod->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$zesmoprod->execute();

//si on a aucun resultat
if($zesmoprod->rowCount() == 0)
	redirect('index.php');

else
	$data = $zesmoprod->fetch(PDO::FETCH_ASSOC);


?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title>Modifier une info frise - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>

	<form method="post" action="../core/updateFrise.php" enctype="multipart/form-data">
		<h1>Modifier une info de la frise</h1>
		<input type="hidden" name="id" value="<?= $data['id'] ?>">
		<p>
			<label for="titre">Date</label>
			<input required type="text" name="titre" id="titre" placeholder="Date" value="<?= $data['titre'] ?>">
		</p>
		<p>
			<label for="texte">Résumé</label>
			<textarea name="texte" id="texte" placeholder="Infos"><?= $data['texte'] ?></textarea>
		</p>
		<p>
			<button class="btn btn-valid">Enregistrer</button>
		</p>
	</form>
</body>
</html>