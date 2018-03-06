<?php //fichier /back/updateRS.php

include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('login.php');

if(empty($_GET['id']))
	redirect('index.php');

//on lit les infos
$reseaux = $db->prepare('SELECT * FROM reseaux WHERE id = :i');
$reseaux->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$reseaux->execute();

//si on a aucun resultat
if($reseaux->rowCount() == 0)
	redirect('index.php');

else
	$data = $reseaux->fetch(PDO::FETCH_ASSOC);


?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title>Modifier un RS - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>

	<form method="post" action="../core/updateRS.php" enctype="multipart/form-data">
		<h1>Modifier un film</h1>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?= $maxFileSize ?>">
		<input type="hidden" name="id" value="<?= $data['id'] ?>">
		<p>
			<label for="name">nom</label>
			<input required type="name" name="name" id="name" placeholder="name" value="<?= $data['name'] ?>">
		</p>
        <p>
			<label for="lien">lien</label>
			
            <input required type="url" name="lien" id="lien" placeholder="URL du réseaux" value="<?= $data['lien'] ?>">
		</p>
		
		<?php if(!empty($data['logo'])) { ?>
		<figure class="mini">
			<img src="<?= $data['logo'] ?>" alt="Couverture de <?= $data['name'] ?>">
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