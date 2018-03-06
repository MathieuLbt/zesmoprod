<?php //fichier /back/updateCategory.php

//on charge un fichier de parametrage
include('../config/settings.php');

//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user']))
	//on le vire vers la page de login
	redirect('login.php');

//on prepare une requete qui lit les infos
$play = $db->prepare('SELECT * FROM mesenregistrements WHERE id = :i');
$play->bindParam(':i', $_GET['id'], PDO::PARAM_INT);

//on execute la requete
$play->execute();

//si on a aucun resultat
if($play->rowCount() == 0)
	//on va sur l'accueil
	redirect('index.php');

//sinon
else
	//on lit les donnees
	$data = $play->fetch(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title>Modifier - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>

	
	<form method="post" action="../core/updateMesenregistrements.php" enctype="multipart/form-data">
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