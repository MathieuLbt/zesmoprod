<?php //fichier /back/updateCategory.php

//on charge un fichier de parametrage
include('../config/settings.php');

//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user']))
	//on le vire vers la page de login
	redirect('login.php');

//si l'id de l'adresse est vide
if(empty($_GET['id']))
	//on redirige vers la liste des categories
	redirect('categories.php');

//on prepare une requete qui lit les infos
$play = $db->prepare('SELECT * FROM playlist WHERE id = :i');
$play->bindParam(':i', $_GET['id'], PDO::PARAM_INT);

//on execute la requete
$play->execute();

//si on a aucun resultat
if($play->rowCount() == 0)
	//on va sur l'accueil
	redirect('playlist.php');

//sinon
else
	//on lit les donnees
	$data = $play->fetch(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title>Modifier une playlist - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>

	<form method="post" action="../core/updatePlaylist.php" enctype="multipart/form-data">
		<h1>Modifier une playlist</h1>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?= $maxFileSize ?>">
		<input type="hidden" name="id" value="<?= $data['id'] ?>">
        
		<p>
			<label for="titre">Nom</label>
			<input required type="text" name="titre" id="titre" value="<?= $data['titre'] ?>">
		</p>
        <p>
			<label for="description">Description</label>
			<textarea required type="text" name="description" id="description" value="<?= $data['description'] ?>">
		</textarea>
        <?php if(!empty($data['pochette'])) { ?>
		<figure class="mini">
			<img src="<?= backCover($data['pochette']) ?>" alt="Couverture de <?= $data['pochette'] ?>">
		</figure>
		<?php }else
			echo '<p>Aucune image actuellement</p>'; ?>
		<p>
			<input type="file" name="pochette">
		</p>
		<p>
		<p>
			<button class="btn btn-valid">Modifier</button>
		</p>
	</form>
</body>
</html>