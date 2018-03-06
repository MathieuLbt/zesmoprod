<?php //fichier /core/updateSon.php

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
	if(!empty($_FILES['fichier']['name'])){

		//on verifie que le fichier ne depasse pas la taille maximale autorisee
		if($_FILES['fichier']['size'] >= $maxFileSize){
			$error = true;
			flash_in('error', 'Le fichier est trop grand.');
		}
		
		//on verifie qu'il n'y a pas d'erreur avec le ficher
		if($_FILES['fichier']['error'] != 0){
			$error = true;
			flash_in('error', 'Il y a eu un problème avec le fichier, veuillez recommencer.');
		}

		//on cree un tableau avec les extensions autorisees
		$extensionsValides = ['mp3', 'wav', 'raw', 'wma'];

		//on recupere l'extension du fichier
		$name = explode('.', strtolower($_FILES['fichier']['name']));
		$extensionFichier = array_pop($name);

		//si l'ext n'est pas dans le tableau des ext autorisees
		if(!in_array($extensionFichier, $extensionsValides)){
			$error = true;
			flash_in('error', 'Le fichier doit être au format mp3, wav, raw ou wma');
		}
	}


	//si on a eu une erreur
	if($error)

		//on redirige vers le formulaire
		redirect('../back/updateMesenregistrements.php?id='.$_POST['id']);

	else{
		$son = "";

		//on recupere les infos de l'ancienne cover
		$enregistrements = $db->prepare('SELECT * FROM mesenregistrements WHERE id = :i');
		$enregistrements->bindParam(':i', $_POST['id'], PDO::PARAM_INT);
		$enregistrements->execute();
		$data = $enregistrements->fetch(PDO::FETCH_ASSOC);
		if(!empty($data['fichier']))
			$son = $data['fichier'];


		//si on a recu un fichier
		if(!empty($_FILES['fichier']['name'])){
			if(!empty($data['fichier']))
				unlink('../data/audio/'. $son);

            $name = explode('.', strtolower($_FILES['fichier']['name']));
		    $extensionFichier = array_pop($name);
            
			//on cree le nouveau nom du fichier
			$son = 'son-'.time().'.'.$extensionFichier;
			//on deplace le fichier au bon endroit
			move_uploaded_file($_FILES['fichier']['tmp_name'], '../data/audio/'.$son);
		}

		$update = $db->prepare('UPDATE mesenregistrements SET updated = NOW(), titre = :t, fichier = :f WHERE id = :i');

        
        
		//on ajoute les parametres
		$update->bindParam(':t', $_POST['titre'], PDO::PARAM_STR);
        $update->bindParam(':f', $_POST['fichier'], PDO::PARAM_STR);
		$update->bindParam(':i', $_POST['id'], PDO::PARAM_INT);


		//on execute la requete
		$update->execute();
        //die;

		//on cree un message de validation
		flash_in('success', 'Le son a été modifiée.');

		//on redirige vers le formulaire
		//redirect('../back/son.php?id='.$_POST['id']);
        redirect('../back/index.php');
	
	}
}