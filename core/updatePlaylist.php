<?php //fichier /core/updateFilm.php

include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('../back/login.php');

//si on n'a pas recu de formulaire
if(empty($_POST))
	redirect('../back/index.php');

else if(empty($_POST['id']))
	redirect('../back/index.php');

else{

	$error = false;

	//si le titre est vide
	if(empty($_POST['titre'])){
		$error = true;
		//on cree un message d'erreur
		flash_in('error', 'Le titre est obligatoire.');
	}


	//on verifie les elements du fichier
	//si un fichier a ete envoyé
	if(!empty($_FILES['pochette']['name'])){

		//on verifie que le fichier ne depasse pas la taille maximale autorisee
		if($_FILES['pochette']['size'] >= $maxFileSize){
			$error = true;
			flash_in('error', 'Le fichier est trop grand.');
		}
		
		//on verifie qu'il n'y a pas d'erreur avec le ficher
		if($_FILES['pochette']['error'] != 0){
			$error = true;
			flash_in('error', 'Il y a eu un problème avec le fichier, veuillez recommencer.');
		}

		//on cree un tableau avec les extensions autorisees
		$extensionsValides = ['png', 'jpg', 'jpeg', 'gif'];

		//on recupere l'extension du fichier
		$name = explode('.', strtolower($_FILES['pochette']['name']));
		$extensionFichier = array_pop($name);

		//si l'ext n'est pas dans le tableau des ext autorisees
		if(!in_array($extensionFichier, $extensionsValides)){
			$error = true;
			flash_in('error', 'Le fichier doit être au format png, jpg ou gif.');
		}
	}


	//si on a eu une erreur
	if($error)

		//on redirige vers le formulaire
		redirect('../back/updateFilm.php?id='.$_POST['id']);

	else{
		$cover = null;

		//on recupere les infos de l'ancienne cover
		$playlist = $db->prepare('SELECT * FROM playlist WHERE id = :i');
		$playlist->bindParam(':i', $_POST['id'], PDO::PARAM_INT);
		$playlist->execute();
		$data = $playlist->fetch(PDO::FETCH_ASSOC);
		if(!empty($data['pochette']))
			$cover = $data['pochette'];


		//si on a recu un fichier
		if(!empty($_FILES['pochette']['name'])){
			if(!empty($data['pochette']))
				unlink('../data/pochette'.$data['pochette']);

			$cover = 'data/pochette/pochette-' .time().'.'.$extensionFichier;
			//on deplace le fichier au bon endroit
			move_uploaded_file($_FILES['pochette']['tmp_name'], '../'.$cover);
        }

		$update = $db->prepare('UPDATE playlist SET updated = NOW(), titre = :t,  description = :d, pochette = :pochette, WHERE id = :i');

		//on ajoute les parametres
		if(empty($_POST['description']))
			$_POST['description'] = null;

		$update->bindParam(':t', $_POST['titre'], PDO::PARAM_STR);
		$update->bindParam(':d', $_POST['description'], PDO::PARAM_STR);
		$update->bindParam(':pochette', $pochette, PDO::PARAM_STR);
		$update->bindParam(':i', $_POST['id'], PDO::PARAM_INT);

		//on execute la requete
		$update->execute();

		//on cree un message de validation
		flash_in('success', 'La playlist a été modifiée.');

		//on redirige vers le formulaire
		redirect('../back/playlist.php?id='.$_POST['id']);
	
	}
}