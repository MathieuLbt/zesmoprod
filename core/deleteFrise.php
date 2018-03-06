<?php //fichier core/deleteFilm.php

include('../config/settings.php');

if(empty($_SESSION['user']))
	redirect('../back/login.php');

if(empty($_GET['id']))
	redirect('../back/index.php');

//on recupere le livre
$frise = $db->prepare('SELECT * FROM contenue WHERE id = :i');
$frise->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$frise->execute();

//si on ne trouve pas le film
if($frise->rowCount() == 0)
	//on va sur l'accueil
	redirect('../back/index.php');

//on lit les donnees
$data = $frise->fetch(PDO::FETCH_ASSOC);

//on cree une requete pour supprimer la ligne de la base
$deleteFrise = $db->prepare('DELETE FROM contenue WHERE id = :i');
$deleteFrise->bindParam(':i', $_GET['id'], PDO::PARAM_INT);
$deleteFrise->execute();

//on cree un message de validation
flash_in('success', 'info supprimée.');

//on redirige vers la page des films
redirect('../back/index.php');