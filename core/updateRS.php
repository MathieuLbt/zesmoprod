<?php //fichier /core/updateRS.php

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
	if(empty($_POST['name'])){
		$error = true;
		//on cree un message d'erreur
		flash_in('error', 'Le nom est obligatoire.');
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
		redirect('../back/updateRS.php?id='.$_POST['id']);

	else{
		$cover = null;

		//on recupere les infos de l'ancien logo
		$reseaux = $db->prepare('SELECT * FROM reseaux WHERE id = :i');
		$reseaux->bindParam(':i', $_POST['id'], PDO::PARAM_INT);
		$reseaux->execute();
		$data = $reseaux->fetch(PDO::FETCH_ASSOC);
		if(!empty($data['cover']))
			$cover = $data['cover'];

		//si on a recu un fichier
		if(!empty($_FILES['cover']['name'])){
			if(!empty($data['cover']))
				unlink('../data/reseaux/'.$cover);

			//on cree le nouveau nom du fichier
			$logo = 'logo-'.time().'.'.$extensionFichier;
			//on deplace le fichier au bon endroit
			move_uploaded_file($_FILES['logo']['tmp_name'], '../data/reseaux/'.$cover);
		}

		$update = $db->prepare('UPDATE reseaux SET updated = NOW(), name = :n,  lien = :l, logo = :logo WHERE id = :i');

		//on ajoute les parametres
		if(empty($_POST['name']))
			$_POST['name'] = null;

		$update->bindParam(':n', $_POST['name'], PDO::PARAM_STR);
		$update->bindParam(':l', $_POST['lien'], PDO::PARAM_STR);
		$update->bindParam(':logo', $logo, PDO::PARAM_STR);
		$update->bindParam(':i', $_POST['id'], PDO::PARAM_INT);

		//on execute la requete
		$update->execute();

		//on cree un message de validation
		flash_in('success', 'Le RS a été modifiée.');

		//on redirige vers le formulaire
		redirect('../back/RS.php?id='.$_POST['id']);
	
	}
}