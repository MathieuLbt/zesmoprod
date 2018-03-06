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
		flash_in('error', 'La date est obligatoire.');
	}


	//si on a trouve une erreur
	if($error)
		//on redirige vers le formulaire
		redirect('../back/addFrise.php');


		//on prepare la requete pour enregistrer
		$add = $db->prepare('INSERT INTO contenue (created, updated, titre, texte) VALUES ( NOW(), NOW(), :t, :te)');
		
		//on ajoute les donnees
		if(empty($_POST['texte']))
			$_POST['texte'] = null;


		$add->bindParam(':t', $_POST['titre'], PDO::PARAM_STR);
		$add->bindParam(':te', $_POST['texte'], PDO::PARAM_STR);

		//on execute la requete
		$add->execute();
        //die;
		//on cree un message de validation
		flash_in('success', 'Infos(apropos) a bien été ajouté.');

		//on redirige vers la page detail du livre qu'on vient d'ajouter (on recupere l'id qui vient d'etre cree)
		redirect('../back/frise.php?id='.$db->lastInsertId());
	} //fin du else

 //fin test formulaire

//on redirige vers le formulaire
redirect('../back/addFrise.php');
