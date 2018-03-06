<?php  //fichier core/addFilm.php

include('../config/settings.php');


// si l'utilisateur n'est pas connecte
if(empty($_SESSION['user']))	
	//on va vers la page de login
	redirect('../back/login.php');

//si on a recu un formulaire
if(!empty($_POST)){
	//on cree une variable qui indique s'il y a une erreur
	$error = false;

	//si le titre est vide
	if(empty($_POST['titre'])){
		$error = true;
		//on cree un message d'erreur
		flash_in('error', 'Le titre est obligatoire.');
	}

	//on verifie les elements du fichier
	//si un fichier a ete envoyé
	if(!empty($_FILES['pochette']['name'] != 0)){

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
    }else{
        $error = true;
        flash_in('error', 'Le fichier stp');
        redirect('../back/addPlaylist.php');
    }

	//si on a trouve une erreur
	if($error)
		//on redirige vers le formulaire
		redirect('../back/addPlaylist.php');
	//sinon
	else{
		

		$pochette = null;
		//si on a recu un fichier
		if(!empty($_FILES['pochette']['name'])){
			//on cree le nouveau nom du fichier
			$pochette = 'cover-'.time().'.'.$extensionFichier;
			//on deplace le fichier au bon endroit
			move_uploaded_file($_FILES['pochette']['tmp_name'], '../data/pochette/'.$pochette);{
                
                }else{
				echo "...";
				die;
			}

        }
        
        //on ajoute un lien pour la vidéo

		//on prepare la requete pour enregistrer
		$add = $db->prepare('INSERT INTO playlist (created, updated, titre, description, pochette) VALUES ( NOW(), NOW(), :t, :d, :pochette)');
		
		//on ajoute les donnees
		if(empty($_POST['description']))
			$_POST['description'] = null;


		$add->bindParam(':t', $_POST['titre'], PDO::PARAM_STR);
		$add->bindParam(':d', $_POST['description'], PDO::PARAM_STR);
		$add->bindParam(':pochette', $pochette, PDO::PARAM_STR);

		//on execute la requete
		$add->execute();
        //die;
		//on cree un message de validation
		flash_in('success', 'La playlist a été créée.');

		//on redirige vers la page detail du livre qu'on vient d'ajouter (on recupere l'id qui vient d'etre cree)
		redirect('../back/playlist.php?id='.$db->lastInsertId());
	} //fin du else

} //fin test formulaire

//on redirige vers le formulaire
redirect('../back/addplaylist.php');
