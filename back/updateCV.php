<?php //fichier /back/updateRS.php

include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('login.php');

if(empty($_GET['id']))
	redirect('index.php');

//on lit les infos
$cv = $db->prepare('SELECT * FROM cv WHERE id = :i');
$cv->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$cv->execute();

//si on a aucun resultat
if($cv->rowCount() == 0)
	redirect('index.php');

else
	$data = $cv->fetch(PDO::FETCH_ASSOC);


?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title>Modifier le CV - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>

	<form method="post" action="../core/updateCV.php" enctype="multipart/form-data">
		<h1>Modifier un film</h1>
		<input type="hidden" name="id" value="<?= $data['id'] ?>">
        <p>
            <label for="lien">lien</label>
            <input required type="url" name="lien" id="lien" placeholder="URL du cv" value="<?= $data['lien'] ?>">
		</p>

		<p>
			<button class="btn btn-valid">Enregistrer</button>
		</p>
	</form>
</body>
</html>