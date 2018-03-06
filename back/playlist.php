<?php //fichier /back/Playlist.php

//on charge un fichier de parametrage
include('../config/settings.php');

//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user']))
	//on le vire vers la page de login
	redirect('login.php');

//on prepare une requete qui lit les infos
$playlist = $db->prepare('SELECT * FROM playlist WHERE id = :i');
$playlist->bindParam(':i', $_GET['id'], PDO::PARAM_INT);

//on execute la requete
$playlist->execute();


if($playlist->rowCount() == 0)
    redirect('index.php');

else
	//on lit les donnees
	$data = $playlist->fetch(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html>
<head>
	<?php include('../includes/head-back.php'); ?>
	<title>Playlist - Back-Office</title>
</head>
<body>
	<?php include('../includes/header-back.php'); ?>
	<article>
  
		<h1>Playlist - <?= $data['titre'] ?></h1>
        <p>
			<a class="btn btn-small btn-warning" href="updatePlaylist.php?id=<?= $data['id'] ?>">Modifier</a>
			<a class="btn btn-small btn-error" href="../core/deletePlaylist.php?id=<?= $data['id'] ?>">Supprimer</a>
		</p>
            
        <p><span class="label">Description</span>
            <?= $data['description'] ?></p>
        
        
        <p><span class="label">Pochette</span>  
      <figure>
				<img src="<?= backCover($data['pochette'], true) ?>" alt="<?= $data['titre'] ?>">
			</figure>
        </p>
    </article>
</body>
</html>