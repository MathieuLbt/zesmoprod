<?php //fichier /back/updateSon.php

include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('login.php');

if(empty($_GET['id']))
	redirect('index.php');

//on lit les infos
$music = $db->prepare('SELECT * FROM music WHERE id = :i');
$music->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$music->execute();

//si on a aucun resultat
if($music->rowCount() == 0)
	redirect('index.php');

else
	$data = $music->fetch(PDO::FETCH_ASSOC);


?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title>Modifier un son - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>

	<form method="post" action="../core/updateSon.php" enctype="multipart/form-data">
		<h1>Modifier un son</h1>

		<input type="hidden" name="id" value="<?= $data['id'] ?>">
		<p>
			<label for="titre">Titre</label>
			<input required type="text" name="titre" id="titre" placeholder="Titre" value="<?= $data['titre'] ?>">
		</p>

		
		<?php if(!empty($data['son'])) { ?>

		<?php }else
			echo '<p>Aucun son actuellement</p>'; ?>
		<p>
			<input type="file" name="son">
		</p>
		<p>
			<button class="btn btn-valid">Enregistrer</button>
		</p>
	</form>
</body>
</html>