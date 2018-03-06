<?php  //fichier core/addSon.php

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
	if(!empty($_FILES['son']['name'])){

		//on cree un tableau avec les extensions autorisees
		$extensionsValides = ['mp3', 'wma', 'wav', 'raw'];

		//on recupere l'extension du fichier
		$name = explode('.', strtolower($_FILES['son']['name']));
		$extensionFichier = array_pop($name);

		//si l'ext n'est pas dans le tableau des ext autorisees
		if(!in_array($extensionFichier, $extensionsValides)){
			$error = true;
			flash_in('error', 'Le fichier doit être au format mp3, wma, wav ou raw.');
		}
	
    }else{
        $error = true;
        flash_in('error', 'Le fichier stp');
        redirect('../back/addSon.php');
    }
	

	//si on a trouve une erreur
	if($error)
		//on redirige vers le formulaire
        
		redirect('../back/addSon.php');
	//sinon
	else{
		

		$son = null;
		//si on a recu un fichier
		if(!empty($_FILES['son']['name'])){
			//on cree le nouveau nom du fichier
			$son = 'son-'.time().'.'.$extensionFichier;
			//on deplace le fichier au bon endroit
			move_uploaded_file($_FILES['son']['tmp_name'], '../data/son/'.$son);
			chmod('../data/son/'.$son, 0777);
		}
        
        //on ajoute un lien pour la vidéo
        

		//on prepare la requete pour enregistrer
		$add = $db->prepare('INSERT INTO music (created, updated, titre, son) VALUES ( NOW(), NOW(), :t, :son)');
        
        $add->bindParam(':t', $_POST['titre'], PDO::PARAM_STR);
		$add->bindParam(':son', $son, PDO::PARAM_STR);
        
        //on execute la requete
        ($add->execute());
		
		//on cree un message de validation
		flash_in('success', 'Le son a bien été ajouté.');

		//on redirige vers la page detail du livre qu'on vient d'ajouter (on recupere l'id qui vient d'etre cree)
		redirect('../back/son.php?id='.$db->lastInsertId());
	} //fin du else

} //fin test formulaire

//on redirige vers le formulaire
redirect('../back/addSon.php');
