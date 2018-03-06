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
	if(!empty($_FILES['cover']['name'])){

		//on verifie que le fichier ne depasse pas la taille maximale autorisee
		if($_FILES['cover']['size'] >= $maxFileSize){
			$error = true;
			flash_in('error', 'Le fichier est trop grand.');
		}
		
		//on verifie qu'il n'y a pas d'erreur avec le ficher
		if($_FILES['cover']['error'] != 0){
			$error = true;
			flash_in('error', 'Il y a eu un problème avec le fichier, veuillez recommencer.');
		}

		//on cree un tableau avec les extensions autorisees
		$extensionsValides = ['png', 'jpg', 'jpeg', 'gif'];

		//on recupere l'extension du fichier
		$name = explode('.', strtolower($_FILES['cover']['name']));
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
		$movie = $db->prepare('SELECT * FROM movie WHERE id = :i');
		$movie->bindParam(':i', $_POST['id'], PDO::PARAM_INT);
		$movie->execute();
		$data = $movie->fetch(PDO::FETCH_ASSOC);
		if(!empty($data['cover']))
			$cover = $data['cover'];


		//si on a recu un fichier
		if(!empty($_FILES['cover']['name'])){
			if(!empty($data['cover']))
				unlink('../data/covers/'.$cover);

			//on cree le nouveau nom du fichier
			$cover = 'cover-'.time().'.'.$extensionFichier;
			//on deplace le fichier au bon endroit
			move_uploaded_file($_FILES['cover']['tmp_name'], '../data/covers/'.$cover);
		}

		$update = $db->prepare('UPDATE movie SET updated = NOW(), titre = :t,  description = :d, cover = :cover, lien = :l WHERE id = :i');

		//on ajoute les parametres
		if(empty($_POST['description']))
			$_POST['description'] = null;

		$update->bindParam(':t', $_POST['titre'], PDO::PARAM_STR);
		$update->bindParam(':d', $_POST['description'], PDO::PARAM_STR);
		$update->bindParam(':cover', $cover, PDO::PARAM_STR);
		$update->bindParam(':i', $_POST['id'], PDO::PARAM_INT);
        $update->bindParam(':l', $_POST['lien'], PDO::PARAM_STR);

		//on execute la requete
		$update->execute();

		//on cree un message de validation
		flash_in('success', 'Le film a été modifiée.');

		//on redirige vers le formulaire
		redirect('../back/film.php?id='.$_POST['id']);
	
	}
}