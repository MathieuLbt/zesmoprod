<?php  //fichier core/login.php

include('../config/settings.php');

//si on n'a pas recu de formulaire
if(empty($_POST))
	//on va directement vers le back/login
	redirect('../back/login.php');

//On cherche tous les utilisateurs dans la base de données qui correspondent au couple login/password
$user = $db->prepare('SELECT * FROM user WHERE username = :name AND password = :password');
$user->bindParam(':name', $_POST['pseudo'], PDO::PARAM_STR);

//on crypte le mot de passe
$pass = cryptPassword($_POST['pass']);
$user->bindParam(':password', $pass, PDO::PARAM_STR);

$user->execute();

//si on trouve une ligne
if($user->rowCount() == 1){
	
	//on connecte l'utilisateur
	$data = $user->fetch(PDO::FETCH_ASSOC);
	$_SESSION['user'] = $data['username'];
	$_SESSION['user_id'] = $data['id'];

	//on cree un message de validation
	flash_in('success', 'Welcome back !'. $data['name']);

	//on redirige vers l'accueil
	redirect('../back/son.php');

}else { //sinon
	
	//on cree un message d'erreur
	flash_in('error', 'Le pseudo et le mot de passe ne correspondent pas.');
	
    die;
	//on redirige vers back/login
	redirect('../back/login.php');
} //fin du test