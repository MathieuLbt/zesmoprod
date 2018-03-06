<?php  //fichiercore/addSon.php

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
	if(!empty($_FILES['fichier']['name'])){

		//on cree un tableau avec les extensions autorisees
		$extensionsValides = ['mp3', 'wma', 'wav', 'raw'];

		//on recupere l'extension du fichier
		$name = explode('.', strtolower($_FILES['fichier']['name']));
		$extensionFichier = array_pop($name);

		//si l'ext n'est pas dans le tableau des ext autorisees
		if(!in_array($extensionFichier, $extensionsValides)){
			$error = true;
			flash_in('error', 'Le fichier doit être au format mp3, wma, wav ou raw.');
		}
	
  }else{
      $error = true;
      flash_in('error', 'Le fichier stp');
      redirect('../back/addMesenregistrements.php');
  }
	

	//si on a trouve une erreur
	if($error)
		//on redirige vers le formulaire
        
		redirect('../back/addMesenregistrements.php');
	//sinon
	else{
		

		$son = null;
		//si on a recu un fichier
		if(!empty($_FILES['fichier']['name'])){
			//on cree le nouveau nom du fichier
			$son = 'son-'.time().'.'.$extensionFichier;
			//on deplace le fichier au bon endroit
			move_uploaded_file($_FILES['fichier']['tmp_name'], '../data/audio/'.$son);
			chmod('../data/audio/'.$son, 0777);
		}
        
        //on ajoute un lien pour la vidéo
        

		//on prepare la requete pour enregistrer
		$add = $db->prepare('INSERT INTO mesenregistrements (created, updated, titre, fichier) VALUES ( NOW(), NOW(), :t, :fichier)');
        
        $add->bindParam(':t', $_POST['titre'], PDO::PARAM_STR);
		$add->bindParam(':fichier', $_POST['fichier'], PDO::PARAM_STR);
        
        //on execute la requete
        ($add->execute());
		
		//on cree un message de validation
		flash_in('success', 'Le son a bien été ajouté.');
    }
  }
//on redirige vers le formulaire
redirect('../back/index.php');
