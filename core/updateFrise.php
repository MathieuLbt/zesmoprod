<?php //fichier /core/updateFrise.php

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
    //si le texte est vide
	if(empty($_POST['texte'])){
		$error = true;
		//on cree un message d'erreur
		flash_in('error', 'Le texte est obligatoire.');
	}


	//si on a eu une erreur
	if($error)

		//on redirige vers le formulaire
		redirect('../back/updateFrise.php?id='. $_POST['id']);



		$update = $db->prepare('UPDATE contenue SET updated = NOW(), titre = :t,  texte = :te WHERE id = :i');

		//on ajoute les parametres
		if(empty($_POST['texte']))
			$_POST['texte'] = null;

		$update->bindParam(':t', $_POST['titre'], PDO::PARAM_STR);
		$update->bindParam(':te', $_POST['texte'], PDO::PARAM_STR);
        $update->bindParam(':i', $_POST['id'], PDO::PARAM_INT);

		//on execute la requete
		$update->execute();

		//on cree un message de validation
		flash_in('success', 'Info modifiée.');

		//on redirige vers le formulaire
		redirect('../back/frise.php?id='.$_POST['id']);
	
	}

