<?php //fichier /core/updateSocials.php

include('../config/settings.php');

//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user']))
	//on le vire vers la page de login
	redirect('login.php');

//si on n'a pas recu de formulaire
if(empty($_POST))
	redirect('../back/updateCV.php');

else if(empty($_POST['id']))
	redirect('../back/updateCV.php');

else{

	$error = false;

	//si le link est vide
	if(empty($_POST['lien'])){
		//on declenche une erreur et on cree un message d'erreur
		$error = true;
		flash_in('error', 'Le lien est obligatoire.');
	}
	//si on a eu une erreur
	if($error)

		//on redirige vers le formulaire
		redirect('../back/updateCV.php?id='.$_POST['id']);

	else{	

		$cv = null;

		//on recupere les infos de l'ancienne cover
		$cv = $db->prepare('SELECT * FROM cv WHERE id = :i');
		$cv->bindParam(':i', $_POST['id'], PDO::PARAM_INT);
		$cv->execute();
		$data = $cv->fetch(PDO::FETCH_ASSOC);


		$cv = $db->prepare('UPDATE cv SET updated = NOW(), lien = :l WHERE id = :i');

		//on ajoute les parametres
		$cv->bindParam(':l', $_POST['lien'], PDO::PARAM_STR);
		$cv->bindParam(':i', $_POST['id'], PDO::PARAM_INT);

		//on execute la requete
		$cv->execute();

		//on cree un message de validation
		flash_in('success', 'Le cv a été modifié.');

		//on redirige vers le formulaire
		redirect('../back/index.php');
	
	}
}